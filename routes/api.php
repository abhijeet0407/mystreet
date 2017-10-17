<?php

use Illuminate\Http\Request;

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

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:api');

Route::get('/locationlist','locationController@ApiLocationList');
Route::get('/menulist','MenuController@ApiMenuList');
Route::get('/filterlist','MenuFilterController@ApiFilterList');
Route::get('/cuisinelist','CuisineController@ApiCuisineList');
Route::get('/Vendorlist','VendorController@ApiVendorList');
Route::get('/vendor','VendorController@APIVendorInner');
Route::post('/customer','CustomerLoginController@CustomerAuth');
Route::post('/register','CustomerLoginController@CustomerRegister');  
Route::get('/cartprocess','CustomerLoginController@CartProcess');
Route::post('/rsaurl','CustomerLoginController@RsaProcess');
Route::post('/redirecturl','CustomerLoginController@SuccessCart');
Route::post('/storeOrder','menuorderController@storeOrder');
