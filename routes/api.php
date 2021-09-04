<?php


Route::group([

    'middleware' => 'api',
    'namespace' => 'App\Http\Controllers',
    'prefix' => 'auth'

], function ($router) {

    Route::post('/login', 'AuthController@login');
    Route::post('/signup', 'AuthController@signup');
    Route::post('/logout', 'AuthController@logout');
    Route::post('/refresh', 'AuthController@refresh');
    Route::post('/me', 'AuthController@me');

});

Route::ApiResource('/employee', 'App\Http\Controllers\Api\EmployeeController');
Route::ApiResource('/supplier', 'App\Http\Controllers\Api\SupplierController');
Route::ApiResource('/category', 'App\Http\Controllers\Api\CategoryController');
Route::ApiResource('/product', 'App\Http\Controllers\Api\ProductController');
