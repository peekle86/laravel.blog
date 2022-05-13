<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreLogin;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{

    /**
     * Page with login form
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function loginForm()
    {
        return view('admin.login');
    }

    /**
     * Trying to authenticate
     *
     * Redirect to admin home page if logged successful, and redirects back to page with login form otherwise
     *
     * @param StoreLogin $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function login(StoreLogin $request)
    {
        if (Auth::attempt([
            'email' => $request->email,
            'password' => $request->password
        ])) {
            session()->flash('success', 'You are logged in');
            return redirect()->route('admin.index');
        }

        return redirect()->back()->with('error', 'Incorrect login or password');
    }

    /**
     * Logging out user
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function logout()
    {
        Auth::logout();
        return redirect()->route('login.create');
    }
}
