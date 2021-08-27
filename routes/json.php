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

    Route::resource('physiotherapy/post', \App\Http\Controllers\Json\Post\PhysiotherapyController::class, [
        'except' => ['edit', 'show', 'index']
    ]);

    Route::resource('grooming/post', \App\Http\Controllers\Json\Post\GroomingController::class, [
        'except' => ['edit', 'show', 'index']
    ]);

    Route::resource('handling/post', \App\Http\Controllers\Json\Post\HandlingController::class, [
        'except' => ['edit', 'show', 'index']
    ]);

    Route::resource('dog-hotel/post', \App\Http\Controllers\Json\Post\DogHotelController::class, [
        'except' => ['edit', 'show', 'index']
    ]);

    Route::get('about-company/edit', '\App\Http\Controllers\Json\AboutCompanyController@edit');
    Route::put('about-company/{about_company}', '\App\Http\Controllers\Json\AboutCompanyController@update');

    Route::get('contact/edit', '\App\Http\Controllers\Json\ContactController@edit');
    Route::put('contact/{contact}', '\App\Http\Controllers\Json\ContactController@update');

    Route::get('physiotherapy/edit', '\App\Http\Controllers\Json\PhysiotherapyController@edit');
    Route::put('physiotherapy/update', '\App\Http\Controllers\Json\PhysiotherapyController@update');

    Route::get('grooming/edit', '\App\Http\Controllers\Json\GroomingController@edit');
    Route::put('grooming/update', '\App\Http\Controllers\Json\GroomingController@update');

    Route::get('handling/edit', '\App\Http\Controllers\Json\HandlingController@edit');
    Route::put('handling/update', '\App\Http\Controllers\Json\HandlingController@update');

    Route::get('dog-hotel/edit', '\App\Http\Controllers\Json\DogHotelController@edit');
    Route::put('dog-hotel/update', '\App\Http\Controllers\Json\DogHotelController@update');

    // Images
    Route::post('grooming/image', '\App\Http\Controllers\Json\Image\GroomingController@store');
    Route::delete('grooming/image/{image}', '\App\Http\Controllers\Json\Image\GroomingController@destroy');
});

Route::get('grooming-image/{grooming_image}', '\App\Http\Controllers\Json\GroomingImageController@show');

Route::get('physiotherapy', '\App\Http\Controllers\Json\PhysiotherapyController@show');

Route::get('grooming', '\App\Http\Controllers\Json\GroomingController@show');

Route::get('handling', '\App\Http\Controllers\Json\HandlingController@show');

Route::get('dog-hotel', '\App\Http\Controllers\Json\DogHotelController@show');

Route::get('about-company', '\App\Http\Controllers\Json\AboutCompanyController@show');

Route::get('contact', '\App\Http\Controllers\Json\ContactController@show');

/**
 * @todo to refactor
 */
Route::group(['prefix' => 'post'], function () {
    Route::resource('physiotherapy', \App\Http\Controllers\Json\Post\PhysiotherapyController::class, [
        'only' => ['index']
    ]);
    Route::resource('grooming', \App\Http\Controllers\Json\Post\GroomingController::class, [
        'only' => ['index']
    ]);
    Route::resource('handling', \App\Http\Controllers\Json\Post\HandlingController::class, [
        'only' => ['index']
    ]);
    Route::resource('dog-hotel', \App\Http\Controllers\Json\Post\DogHotelController::class, [
        'only' => ['index']
    ]);
});

Route::get('dog-hotel/post/{post}', '\App\Http\Controllers\Json\Post\DogHotelController@show');

Route::get('grooming/post/{post}', '\App\Http\Controllers\Json\Post\GroomingController@show');

Route::get('handling/post/{post}', '\App\Http\Controllers\Json\Post\HandlingController@show');

Route::get('physiotherapy/post/{post}', '\App\Http\Controllers\Json\Post\PhysiotherapyController@show');


