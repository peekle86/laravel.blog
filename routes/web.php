<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', 'SiteController@index')->name('home');
Route::get('/articles', 'SiteController@articles')->name('site.articles');
Route::get('/article/{slug}', 'SiteController@show')->name('site.article');
Route::get('/category/{slug}', 'CategoryController@show')->name('category.articles');
Route::get('/tag/{slug}', 'TagController@show')->name('tag.articles');
Route::get('/search', 'SearchController@index')->name('search');

Route::group(['prefix' => 'admin', 'namespace' => 'Admin', 'middleware' => 'admin'], function () {
    Route::get('/', 'MainController@index')->name('admin.index');
    Route::resource('/categories', 'CategoryController');
    Route::resource('/tags', 'TagController');
    Route::resource('/posts', 'PostController');
});

Route::group(['middleware' => 'guest', 'namespace' => 'Admin'], function () {
    Route::get('/login', 'UserController@loginForm')->name('login.create');
    Route::post('/login', 'UserController@login')->name('login');
});

Route::get('/logout', 'Admin\UserController@logout')->name('logout');
