<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

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

Auth::routes();

Route::get('/', '\App\Http\Controllers\PageController@index')->name('main');
Route::get('/grooming', '\App\Http\Controllers\PageController@grooming')->name('grooming');
Route::get('/hotel_dla_psów', '\App\Http\Controllers\PageController@dogHotel')->name('dog-hotel');
Route::get('/fizjoterapia_zwierząt', '\App\Http\Controllers\PageController@physiotherapy')->name('physiotherapy');
Route::get('/kontakt', '\App\Http\Controllers\PageController@contact')->name('contact');
Route::get('/handling', '\App\Http\Controllers\PageController@handling')->name('handling');
Route::get('/aktualności', '\App\Http\Controllers\PageController@news')->name('news');
Route::get('/post/{post}', '\App\Http\Controllers\PageController@post')->name('post');

Route::group(['prefix' => 'admin'], function () {
    Route::get('{any?}', function () {
        return view('admin.app');
    })->where('any', '[\s\S]*');
});
