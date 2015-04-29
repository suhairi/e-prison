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

Route::get('/', 'WelcomeController@index');

Route::get('home', 'HomeController@index');

Route::get('admin', 'Admin\AdminController@index');
Route::post('admin', 'Clerk\ClerkController@carian');

// ######################## ADMIN ##########################
// ################## LEVEL ONE ACCESS #####################

Route::get('admin/register', 'Admin\AdminController@getRegister');
Route::post('admin/register', 'Admin\AdminController@postRegister');

Route::get('admin/staff', 'Admin\AdminController@getStaff');
Route::post('admin/staff', 'Admin\AdminController@postStaff');

Route::get('admin/prefix-no-kes', 'Admin\TetapanController@getNoCase');

Route::get('admin/prefix-memo-terima', 'Admin\TetapanController@getMemoTerima');
Route::post('admin/prefix-memo-terima', 'Admin\TetapanController@postMemoTerima');

Route::get('admin/prefix-memo-polis', 'Admin\TetapanController@getMemoPolis');
Route::post('admin/prefix-memo-polis', 'Admin\TetapanController@postMemoPolis');

Route::get('admin/prefix-memo-selesai', 'Admin\TetapanController@getMemoSelesai');
Route::post('admin/prefix-memo-selesai', 'Admin\TetapanController@postMemoSelesai');


// ######################## CLERK ##########################
// ################## LEVEL TWO ACCESS #####################


// ####################### Daftar PKW ######################

Route::get('clerk/profile', 'Clerk\ClerkController@getProfile');
Route::post('clerk/profile', 'Clerk\ClerkController@postProfile');

Route::get('clerk/profileExt', 'Clerk\ClerkController@getProfileExt');
Route::post('clerk/profileExt', 'Clerk\ClerkController@postProfileExt');

Route::get('clerk/case', 'Clerk\ClerkController@getCase');
Route::post('clerk/case', 'Clerk\ClerkController@postCase');

Route::get('clerk/remitance', 'Clerk\ClerkController@getRemitance');
Route::post('clerk/remitance', 'Clerk\ClerkController@postRemitance');

Route::get('clerk/parent', 'Clerk\ClerkController@getParent');
Route::post('clerk/parent', 'Clerk\ClerkController@postParent');

// ######################## Laporan #######################

Route::get('clerk/laporan/1', 'Clerk\LaporanController@getOne');
Route::post('clerk/laporan/1', 'Clerk\LaporanController@postOne');






// ######################## LARAVEL ##########################
// ################ BUILT IN AUTHENTICATION ##################


Route::controllers([
	'auth' => 'Auth\AuthController',
	'password' => 'Auth\PasswordController',
]);
