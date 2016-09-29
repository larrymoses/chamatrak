<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/
Route::auth();
Route::get('user/activation/{token}', 'Auth\AuthController@activateUser')->name('user.activate');


Route::get('/', 'HomeController@index');


Route::get('test/{id}', 'MembersController@sendEmailReminder');
Route::get('late_contribution', 'MembersController@sendLateContEmailReminder');
Route::get('get_late_contribution', 'MembersController@getLateMembersContributions');
Route::get('/members/getall/{status}', 'MembersController@getMembers');
Route::get('importExport', 'MembersController@importExport');
Route::get('downloadExcel/{type}', 'MembersController@downloadExcel');
Route::post('importExcel', 'MembersController@importExcel');
Route::get('getmemberbyid/{id}', 'MembersController@getmemberbyid');
Route::get('getmembercont/{id}', 'MembersController@getmembercontbyid');
Route::put('updatemember/', 'MembersController@ApproveMembers');
Route::get('getMembersContributions', 'ContributionsController@getMembersContributions');
Route::get('getAssets', 'AssetsController@getAssets');
Route::resource('members','MembersController');
Route::resource('asset','AssetsController');
Route::post('contributions/{id}','ContributionsController@updates');
Route::resource('contributions','ContributionsController');
Route::resource('loans','LoansController');
Route::resource('notifications','NotificationsController');

Route::get('client/apply','ClientController@applyloan');
Route::get('client/contribute','ClientController@contribute');
Route::get('client/contributions','ClientController@contributions');
Route::get('getMyContributions','ClientController@getMyContributions');
Route::get('client/get_loans','LoansController@getAppliedLoans');
Route::post('post_set_contribution','SettingsController@postSetContributions');
Route::get('set_contribution','SettingsController@setContributions');
Route::get('getContributionSettings','SettingsController@getContributionSettings');
Route::resource('client','ClientController');

Route::get('payPremium', ['as'=>'payPremium','uses'=>'PaypalController@payPremium']);

Route::post('getCheckout', ['as'=>'getCheckout','uses'=>'PaypalController@getCheckout']);

Route::get('getDone', ['as'=>'getDone','uses'=>'PaypalController@getDone']);

Route::get('getCancel', ['as'=>'getCancel','uses'=>'PaypalController@getCancel']);