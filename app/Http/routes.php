<?php

use App\Task;
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
Route::get('/', 'ShopController@index');
Route::post('/shops', 'ShopController@store');
Route::get('/shops/{shop_id?}', 'ShopController@show');
Route::put('/shops/{shop_id?}', 'ShopController@update');
Route::delete('/shops/{shop_id?}', 'ShopController@destroy');
// download data
Route::get('/download', 'ShopController@download');
Route::post('/upload', 'ShopController@upload');


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

Route::group(['middleware' => ['web']], function () {
    //
});
