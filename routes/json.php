<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Resources\UserResource;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth')->get('/user', function (Request $request) {
    return UserResource::make($request->user());
});
Route::group(['prefix' => 'admin'], function () {
    Route::resource('user', \App\Http\Controllers\Json\Admin\UserController::class, [
        'only' => ['update']
    ]);

    Route::resource('grooming-image', \App\Http\Controllers\Json\GroomingImageController::class, [
        'only' => ['index', 'store']
    ]);

    // Section posts
    Route::resource('physiotherapy/post', \App\Http\Controllers\Json\Post\PhysiotherapyController::class, [
        'only' => ['show', 'store', 'update']
    ]);

    Route::resource('grooming/post', \App\Http\Controllers\Json\Post\GroomingController::class, [
        'only' => ['show', 'store', 'update']
    ]);

    Route::resource('handling/post', \App\Http\Controllers\Json\Post\HandlingController::class, [
        'only' => ['show', 'store', 'update']
    ]);

    Route::resource('dog-hotel/post', \App\Http\Controllers\Json\Post\DogHotelController::class, [
        'only' => ['show', 'store', 'update']
    ]);

    // Sections
    Route::get('about-company/edit', '\App\Http\Controllers\Json\AboutCompanyController@edit');
    Route::put('about-company/{about_company}', '\App\Http\Controllers\Json\AboutCompanyController@update');

    Route::get('contact/edit', '\App\Http\Controllers\Json\ContactController@edit');
    Route::put('contact/{contact}', '\App\Http\Controllers\Json\ContactController@update');

    Route::get('dog-hotel', '\App\Http\Controllers\Json\DogHotelController@show');
    Route::get('dog-hotel/edit', '\App\Http\Controllers\Json\DogHotelController@edit');
    Route::put('dog-hotel/update', '\App\Http\Controllers\Json\DogHotelController@update');

    Route::get('grooming', '\App\Http\Controllers\Json\GroomingController@show');
    Route::get('grooming/edit', '\App\Http\Controllers\Json\GroomingController@edit');
    Route::put('grooming/update', '\App\Http\Controllers\Json\GroomingController@update');

    Route::get('handling', '\App\Http\Controllers\Json\HandlingController@show');
    Route::get('handling/edit', '\App\Http\Controllers\Json\HandlingController@edit');
    Route::put('handling/update', '\App\Http\Controllers\Json\HandlingController@update');

    Route::get('physiotherapy', '\App\Http\Controllers\Json\PhysiotherapyController@show');
    Route::get('physiotherapy/edit', '\App\Http\Controllers\Json\PhysiotherapyController@edit');
    Route::put('physiotherapy/update', '\App\Http\Controllers\Json\PhysiotherapyController@update');

    // Images
    Route::post('dog-hotel/image', '\App\Http\Controllers\Json\Image\DogHotelController@store');
    Route::delete('dog-hotel/image/{image}', '\App\Http\Controllers\Json\Image\DogHotelController@destroy');

    Route::post('grooming/image', '\App\Http\Controllers\Json\Image\GroomingController@store');
    Route::delete('grooming/image/{image}', '\App\Http\Controllers\Json\Image\GroomingController@destroy');

    Route::post('handling/image', '\App\Http\Controllers\Json\Image\HandlingController@store');
    Route::delete('handling/image/{image}', '\App\Http\Controllers\Json\Image\HandlingController@destroy');

    Route::post('physiotherapy/image', '\App\Http\Controllers\Json\Image\PhysiotherapyController@store');
    Route::delete('physiotherapy/image/{image}', '\App\Http\Controllers\Json\Image\PhysiotherapyController@destroy');
});

Route::get('grooming-image/{grooming_image}', '\App\Http\Controllers\Json\GroomingImageController@show');
