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
    Route::get('logout', 'Auth\AuthController@logout');
        //checked if verified
    Route::group(['middleware'=>'verify'], function(){

        Route::get('/login/verify','Auth\VerifyController@index');
        Route::post('/login/verify','Auth\VerifyController@verify');

        //Admin dashboard if verified
        Route::group(['prefix' => 'admin/dashboard','middleware'=>'admin'], function(){
            //admin dashboard
            Route::get('/','Admin\Dashboard\DashboardController@index');
            //User's list and Registration
/*            Route::resource('users','Admin\User\UsersController');*/
            Route::resource('users','Admin\User\UsersController');
  /*          Route::group(['prefix' => 'users'], function() {
              Route::get('/', 'Admin\User\UsersController@index');
                Route::post('/', 'Admin\User\UsersController@store');
                Route::get('/{userId}/edit', 'Admin\User\UsersController@edit');
                Route::post('/{userId}','Admin\User\UsersController@update');
                Route::post('/{userId}/delete','Admin\User\UsersController@destroy');
            });*/

            //Items
            Route::resource('supplies/items','Admin\Item\ItemsController');
/*            Route::group(['prefix' => 'supplies/items'], function() {
                Route::get('/', 'Admin\Item\ItemsController@index');
                Route::post('/', 'Admin\Item\ItemsController@store');
                Route::get('/{itemId}', 'Admin\Item\ItemsController@edit');
                Route::post('/{itemId}','Admin\Item\ItemsController@update');
                Route::delete('/{itemId}','Admin\Item\ItemsController@destroy');
            });*/

            //Items types
            Route::resource('supplies/item-types','Admin\ItemType\ItemTypesController');
/*            Route::group(['prefix' => 'supplies/item-types'], function() {
                Route::get('/', 'Admin\ItemType\ItemTypesController@index');
                Route::post('/', 'Admin\ItemType\ItemTypesController@store');
                Route::post('/{item-typesId}','Admin\ItemType\ItemTypesController@update');
                Route::post('/{item-typesId}/delete','Admin\ItemType\ItemTypesController@destroy');
            });*/

            //Inventory
            Route::resource('supplies/inventory','Admin\Inventory\InventoryController');
/*            Route::group(['prefix' => 'supplies/inventory'], function() {
                Route::get('/', 'Admin\Inventory\InventoryController@index');
                Route::post('/', 'Admin\Inventory\InventoryController@store');
                Route::post('/{userId}','Admin\Inventory\InventoryController@update');
                Route::post('/{userId}/delete','Admin\Inventory\InventoryController@destroy');
            });*/
        });

        //User's page
        Route::group(['prefix' => '/user'], function(){
            return "User's page";
        });
    });
});
