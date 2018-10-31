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
Route::post('login', 'API\UserController@login');
Route::post('register', 'API\UserController@register');
Route::post('create', 'API\PasswordResetController@create');
Route::get('find/{token}', 'API\PasswordResetController@find');
Route::post('reset', 'API\PasswordResetController@reset');
#Password reset routes
// Route::group([    
//     'namespace' => 'API',    
//     'middleware' => 'api',    
//     'prefix' => 'password'
// ], function () {    
//     Route::post('create', 'PasswordResetController@create');
//     Route::get('find/{token}', 'PasswordResetController@find');
//     Route::post('reset', 'PasswordResetController@reset');
// });

Route::post('updatetoken', 'API\UserController@updatetoken');

Route::get('getallcategory', 'API\CategoryController@getallcategory');

Route::post('addpoints', 'API\NotificationController@addpoints');
Route::post('getallnotification', 'API\NotificationController@getallnotification');



Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});
