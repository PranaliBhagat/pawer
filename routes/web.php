<?php

Route::get('/', function () {
    return view('auth/login');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
Auth::routes();
Route::get('/home', 'HomeController@index')->name('home');
Route::post('/home/user/{id}','ReguserController@changepassword');
Route::get('/changepassword/user/{id}','ReguserController@changepwd');
Route::get('/changepassword','ReguserController@adminpassword');
Route::post('/home/changepassword','ReguserController@adminpwd');
Route::get('/edit/user/{id}','ReguserController@edit');
//Route::post('/destroy/user/{id}','ReguserController@destroy');

Route::post('/update/user/{id}','ReguserController@update');
Route::post('/delete/user/{id}','ReguserController@destroy');
Route::any('home/user/search','ReguserController@search');
Route::get('/getuser/{status}','ReguserController@getUsers');
Route::get('home/user/approve','ReguserController@approve');
//Route::get('home/user/approve','ReguserController@approve');

//Route::post('/home/user/{email}','ReguserController@changestatus');
Route::get('/statusaccept/user/{id}','ReguserController@statusaccept');
Route::get('/statusreject/user/{id}','ReguserController@statusreject');

Route::get('/main','MainController@index');
Route::get('/category','CategoryController@index');
Route::get('/notification','NotificationController@index');
Route::post('/category/{id}/edit','CategoryController@edit');
Route::get('/notification/{id}/destroynotification','CategoryController@destroynotification');


Route::get('/create/category/{id}','NotificationController@create');
//Route::get('mail/send', 'ReguserMailController@send');

Route::resource('user','ReguserController')->middleware('auth');
Route::resource('category','CategoryController')->middleware('auth');
Route::resource('notification','NotificationController')->middleware('auth');



Route::get('sendbasicemail','MailController@basic_email');
Route::get('sendhtmlemail','MailController@html_email');
Route::get('sendattachmentemail','MailController@attachment_email');

