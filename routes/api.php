<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

/*Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});*/

// php artisan scribe:generate

Route::group(['prefix' => 'v1', 'namespace' => 'API\V1'], function(){
    // Route::post('login', 'AUTH\OwnerController@Login')->name('Api.OwnerLogin');


    // Route::post('register', 'AUTH\AuthController@Register')->name('Api.Register');
    // Route::post('register/otp-verify', 'AUTH\AuthController@otpVerify')->name('Api.Register.Otp.Verify');

    Route::post('login', 'AUTH\AuthController@Login')->name('Api.Login');
    Route::post('forgot-password', 'AUTH\AuthController@ForgotPassword');
    Route::post('forgot/otp-verify', 'AUTH\AuthController@otpVerify')->name('Api.Forgot.Otp.Verify');


    //Route::post('forgot-password', 'AUTH\AuthController@Register')->name('forgot.password');

    Route::group([ 'middleware' => 'auth:api'], function(){

        Route::post('change-password', 'AppDataController@changePassword');
        Route::post('update-profile', 'AppDataController@UpdateProfile');
        Route::post('update-image-profile', 'AppDataController@UpdateImageProfile');




        Route::post('userinfo', 'AppDataController@userinfo');
        Route::post('events_list', 'AppDataController@events_list');
        Route::post('event_detail', 'AppDataController@event_detail');
        Route::post('banner', 'AppDataController@banner');
         Route::post('social_connects', 'AppDataController@socialconnects');
        Route::post('visitors', 'AppDataController@visitors');
        Route::post('mydues', 'AppDataController@mydues');
        Route::post('service', 'AppDataController@service');
        Route::post('notice', 'AppDataController@notice');
        Route::post('member', 'AppDataController@member');
        Route::post('memberDetail', 'AppDataController@memberDetail');


    });



});






