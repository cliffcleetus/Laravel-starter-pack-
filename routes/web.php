<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

use Carbon\Carbon;

Route::get('/', function () {
	/*$user_logs = App\User_logs::find(1)->user;

	dd($user_logs);

	foreach ($user_logs as $user_log) {
		dd($user_log);
    }*/
    
    return view('welcome');
});

Auth::routes();

//Route::get('/', 'PostController@index')->name('home');
Route::get('/home', function () {
    return view('welcome');
});

/*Route::get( 'dashboard' ,'Dashboard@index' )->middleware('checklogin');
*/
Route::get( 'dashboard' ,'DashboardController@index' );
Route::get('admin', 'Auth\LoginController@showAdminLoginForm')->name('adminlogin');
Route::get('/users/customer', 'UserController@customer')->name('customer');

Route::resource('users', 'UserController');



Route::resource('roles', 'RoleController');

Route::resource('permissions', 'PermissionController');

Route::resource('posts', 'PostController');

Route::resource('pages', 'PagesController');

Route::resource('settings', 'SettingsController');

Route::resource('faq', 'FAQController');

Route::resource('emailcontents', 'EmailcontentsController');

Route::resource('helps', 'HelpsController');

Route::resource('emailqueues', 'EmailQueuesController');

Route::resource('customer', 'CustomerController');

Route::get('/emailqueues/resend/{id}', 'EmailQueuesController@resend')->name('resend');

Route::get('/helps/active/{id}', 'HelpsController@active')->name('active');

Route::get('/helps/deactive/{id}', 'HelpsController@deactive')->name('deactive');

Route::get('/faq/active/{id}', 'FAQController@active')->name('faq_active');

Route::get('/faq/deactive/{id}', 'FAQController@deactive')->name('faq_deactive');

Route::get('/customer/active/{id}', 'CustomerController@active')->name('user_active');

Route::get('/customer/deactive/{id}', 'CustomerController@deactive')->name('user_deactive');

