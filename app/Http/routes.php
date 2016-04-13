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
            //admin
            Route::get('/','Admin\Dashboard\DashboardController@index');

            //User's list and Registration
            Route::resource('users','Admin\User\UsersController');

            //Items
            Route::resource('supplies/items','Admin\Item\ItemsController');

            //Items types
            Route::resource('supplies/item-types','Admin\ItemType\ItemTypesController');

            //Inventory
            Route::resource('supplies/inventory','Admin\Inventory\InventoryController');
/*            Route::group(['prefix' => 'supplies/inventory'], function() {
                Route::get('/', 'Admin\Inventory\InventoryController@index');
                Route::post('/', 'Admin\Inventory\InventoryController@store');
                Route::post('/{userId}','Admin\Inventory\InventoryController@update');
                Route::post('/{userId}/delete','Admin\Inventory\InventoryController@destroy');
            });*/

            //Requests
            Route::group(['prefix'=>'requests'], function(){
                Route::get('/','Admin\Request\RequestsController@index');
                Route::get('/{id}/view','Admin\Request\RequestsController@view');
                Route::put('/{request_id}/view','Admin\Request\RequestsController@update');
                Route::get('/pending', 'Admin\Request\RequestsController@pending');
                Route::get('/approved', 'Admin\Request\RequestsController@approved');
                Route::get('/declined', 'Admin\Request\RequestsController@declined');
            });

            //Budget Histories
            Route::group(['prefix'=>'budget-histories'], function(){
                Route::get('/','Admin\Budget\BudgetHistoryController@index');
            });
        });

        //Requests
        Route::group(['prefix'=>'users'], function(){
            Route::group(['prefix'=>'requests'], function() {
                Route::get('/','User\Request\RequestsController@index');
                Route::get('/add', 'User\Request\RequestsController@add');
                Route::post('/add', 'User\Request\RequestsController@send');
                Route::get('/{id}/view', 'User\Request\RequestsController@view');
                Route::put('/{request_id}/view', 'User\Request\RequestsController@update');
                Route::get('/pending', 'User\Request\RequestsController@pending');
                Route::get('/approved', 'User\Request\RequestsController@approved');
                Route::get('/declined', 'User\Request\RequestsController@declined');
            });
        });

        //User's page
        Route::resource('users','User\Profile\ProfileController');
        Route::get('/userimage/{filename}',[
            'uses' => 'User\Profile\ProfileController@getUserImage',
            'as'   => 'account.image'
        ]);
    });
});
