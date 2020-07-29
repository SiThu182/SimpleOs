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

// Route::middleware('auth:api')->get('/user', function (Request $request) {
//     return $request->user();
// });


Route::Apiresource('/category', 'Api\CategoryController');

Route::Apiresource('/brand','Api\BrandController');

Route::Apiresource('/item','Api\ItemController');

Route::get('getCategory','Api\ItemController@getCategory');

Route::post('searchItem','Api\ItemController@searchItem');
