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
Route::ApiResource('/expense', 'App\Http\Controllers\Api\ExpenseController');
Route::ApiResource('/customer', 'App\Http\Controllers\Api\CustomerController');
Route::get('/salary', 'App\Http\Controllers\Api\SalaryController@index');
Route::post('/salary/paid/{id}', 'App\Http\Controllers\Api\SalaryController@paid');
Route::post('/view/salary/{month}', 'App\Http\Controllers\Api\SalaryController@view');
Route::get('/edit/salary/{id}', 'App\Http\Controllers\Api\SalaryController@edit');
Route::post('/update/salary/{id}', 'App\Http\Controllers\Api\SalaryController@update');
Route::post('/stock-update/{id}', 'App\Http\Controllers\Api\ProductController@stockUpdate');
Route::get('/getting/product/{id}', 'App\Http\Controllers\Api\PosController@GetProduct');

Route::get('/addToCart/{id}', 'App\Http\Controllers\Api\CartController@addToCart');
Route::get('/removeToCart/{id}', 'App\Http\Controllers\Api\CartController@removeToCart');
Route::get('/incrementToCart/{id}', 'App\Http\Controllers\Api\CartController@incrementItem');
Route::get('/decrementToCart/{id}', 'App\Http\Controllers\Api\CartController@decrementItem');
Route::get('/cart/product', 'App\Http\Controllers\Api\CartController@cartProduct');
Route::get('/vats', 'App\Http\Controllers\Api\CartController@vat');

