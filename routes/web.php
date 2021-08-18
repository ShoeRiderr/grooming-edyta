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
Route::get('/post/{post}', '\App\Http\Controllers\PageController@post')->name('post');

Route::group(['prefix' => 'admin'], function () {
    Route::get('{any?}', function () {
        return view('admin.app');
    })->where('any', '[\s\S]*');
});

Route::get('image/{image}', \App\Http\Controllers\Json\ImageController::class);
