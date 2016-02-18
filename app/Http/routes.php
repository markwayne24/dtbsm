<?php

/*
|--------------------------------------------------------------------------
| Routes File
|--------------------------------------------------------------------------
|
| Here is where you will register all of the routes in an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| This route group applies the "web" middleware group to every route
| it contains. The "web" middleware group is defined in your HTTP
| kernel and includes session state, CSRF protection, and more.
|
*/

Route::group(['middleware' => 'web'], function () {

    //Login
    // Authentication Routes...
    Route::get('/', 'Auth\AuthController@showLoginForm');
    Route::get('/login', 'Auth\AuthController@showLoginForm');
    Route::post('/login', 'Auth\AuthController@login');

        Route::get('/login/verify','Auth\VerifyController@index');
        Route::post('/login/verify','Auth\VerifyController@verify');

        Route::get('logout', 'Auth\AuthController@logout');

        //Admin dashboard if verified
        Route::group(['prefix' => 'admin/dashboard','middleware'=>'admin'], function(){
            //admin dashboard
            Route::get('/','Dashboard\DashboardController@index');
            //User's list and Registration
            Route::group(['prefix' => 'users'], function() {
                Route::get('/', 'User\UsersController@index');
                Route::post('/', 'User\UsersController@store');
                Route::post('/{userId}','User\UsersController@update');
                Route::post('/{userId}/delete','User\UsersController@destroy');
            });
        });
        //User's page
        Route::group(['prefix' => '/user'], function(){
            return "User's page";
    });
});
