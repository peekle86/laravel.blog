<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class ImageController extends Controller
{

    /**
     * Sends a request to paxibay and return a photo or error
     *
     * Processes the request by searching for photos with received query.
     * Returns image object in json format if everything went well.
     * Otherwise returns error with message what went wrong
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function search(Request $request)
    {
        if (!$request->ajax()) { // only ajax
            abort(404);   // if not ajax throw 404
        }

        if ($request->ignore) // if request has defined photo id that needs to ignore
            $this->addToIgnore($request->ignore); // add that photo id to ignore list in session

        // take a result of processing query
        $result = $this->getPhoto(str_replace('q=', '', $request->q));

        return response()->json($result); // send response as json
    }

    /**
     * Adds the specified photo id to the ignore list in session
     *
     * @param $photoId
     */
    private function addToIgnore($photoId)
    {
        $ignoring = session('ignorePhotos'); // get session data
        if (is_array($ignoring)) { // if ignore list already have records
            if (!in_array($photoId, $ignoring)) { // and if specified photo id has not been recorded before
                $ignoring[] = $photoId; // add photo id to list
            }
        } else {
            $ignoring = [$photoId]; // if the list does not already exist, then make one with photo id
        }

        session(['ignorePhotos' => $ignoring]); // set list to session
    }

    /**
     * Manages the whole process of obtaining a photo
     *
     * Returns an array of the photo object or an array with error text
     *
     * @param $q
     * @return array
     */
    private function getPhoto($q)
    {
        $photo = null;
        $page = 1;

        do {
            $response = $this->sendRequest(urlencode($q), $page); // sending a request
            if (is_array($response) && $response['error']) { // if request has error
                return $response;                           // return error
            }
            $rawData = json_decode($response, true); // decoding json from response
            if ($rawData['totalHits'] < 1) { // if response dont have any images
                return [                    // return error
                    'error' => true,
                    'message' => 'There are no results by that title'
                ];
            }
            $photos = $this->cleanUpData($rawData); // clean up photos list
            if ($photos) { // if at least some photos remains
                $i = array_rand($photos); // take a random key
                $photo = $photos[$i]; // take an array element by this key
            } else {
                $page++; // if there are no photos, go to the next page
            }
        } while(!$photo); // do it while $photo will not be filled

        return $photo;
    }

    /**
     * Sends a request
     *
     * Checks for errors at the request level, and returns an array with error message in this case
     *
     * @param $q
     * @param $page
     * @return array|string
     */
    private function sendRequest($q, $page)
    {
        $response = Http::acceptJson()->get('https://pixabay.com/api/?', [
            'key' => env('PIXABAY_API_KEY'),
            'q' => $q,
            'page' => $page,
            'lang' => 'en',
            'image_type' => 'photo',
            'orientation' => 'horizontal',
        ]);
        if (strpos($response->body(), 'ERROR') !== false) { // if response have error
            return [ // returns the array with message of the error
                'error' => true,
                'message' => $response->body()
            ];
        }
        return $response->body();
    }

    /**
     * Clears the data array from those to be ignored
     *
     * Returns array with photos which remained after cleaning
     *
     * @param $data
     * @return array
     */
    private function cleanUpData($data)
    {
        $skipPhotos = session('ignorePhotos'); // get ignore list from session
        if (is_array($skipPhotos) && $skipPhotos) { // if ignore list not empty
            foreach ($data['hits'] as $k => $photo) { // iterate all photos
                if (in_array($photo['id'], $skipPhotos)) // if photo id listed as ignore
                    unset($data['hits'][$k]); // removes it from there
            }
        }
        return $data['hits']; // return a cleared photos
    }
}
