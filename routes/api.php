<?php

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Validation\ValidationException;


Route::post('/login', 'Api\AuthController@login');

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

//Route::get('categories', 'Api\CategoryController@index');
//Route::get('categories/{category}', 'Api\CategoryController@show');
//Route::post('categories', 'Api\CategoryController@store');
//Route::put('categories/{category}', 'Api\CategoryController@update');
//Route::delete('categories/{category}', 'Api\CategoryController@destroy');

// Route::resource('categories', 'Api\CategoryController'); // Has 7 methods (create form, edit form)

Route::group(['middleware' => ['auth:sanctum']], function () {
    Route::apiResource('categories', 'Api\CategoryController'); // Has 5 methods
    Route::get('products', 'Api\ProductController@index');
});
