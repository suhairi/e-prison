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

Route::get('admin/register', 'Admin\TetapanController@getRegister');
Route::post('admin/register', 'Admin\TetapanController@postRegister');
Route::get('admin/register/delete/{id}', [
        'as'    => 'deleteRegister',
        'uses'  => 'Admin\TetapanController@deleteRegister'
]);

Route::get('admin/staff', 'Admin\TetapanController@getStaff');
Route::post('admin/staff', 'Admin\TetapanController@postStaff');
Route::get('admin/staff/delete/{id}', [
        'as'        => 'deleteStaff',
        'uses'      => 'Admin\TetapanController@deleteStaff'
]);
Route::get('admin/staff/kemaskini/{id}', [
    'as'        => 'kemaskiniStaff',
    'uses'      => 'Admin\TetapanController@kemaskiniStaff'
]);

Route::get('admin/prefix-no-kes', 'Admin\PrefixController@getNoCase');

Route::get('admin/prefix-memo-terima', 'Admin\PrefixController@getMemoTerima');
Route::post('admin/prefix-memo-terima', 'Admin\PrefixController@postMemoTerima');

Route::get('admin/prefix-memo-polis', 'Admin\PrefixController@getMemoPolis');
Route::post('admin/prefix-memo-polis', 'Admin\PrefixController@postMemoPolis');

Route::get('admin/prefix-memo-selesai', 'Admin\PrefixController@getMemoSelesai');
Route::post('admin/prefix-memo-selesai', 'Admin\PrefixController@postMemoSelesai');

Route::get('admin/penempatan', 'Admin\TetapanController@getPenempatan');
Route::post('admin/penempatan', 'Admin\TetapanController@postPenempatan');
Route::get('admin/penempatan/delete/{id}', [
    'as' => 'deletePenempatan',
    'uses' =>'Admin\TetapanController@deletePenempatan'
]);
Route::get('admin/penempatan/kemaskini/{id}', [
    'as' => 'kemaskiniPenempatan',
    'uses' =>'Admin\TetapanController@kemaskiniPenempatan'
]);

Route::post('admin/penempatan/kemaskini/{id}', [
    'as' => 'kemaskiniPenempatan',
    'uses' =>'Admin\TetapanController@postKemaskiniPenempatan'
]);


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

Route::get('clerk/laporan/test', [
    'as'    => 'testPDF',
    'uses'  => 'Clerk\MyPDFController@index'
]);

// ########################### AJAX ##########################

Route::get('clerk/laporan/ajax/', [
    'as'    => 'ajax',
    'uses'  => 'Clerk\AjaxController@ajax'
]);

Route::get('clerk/laporan/ajax/kehadiran/negeri/{id}', [
    'as'    => 'ajax-negeri',
    'uses'  => 'Clerk\AjaxController@getNegeri'
]);

Route::get('clerk/laporan/ajax/kehadiran/daerah/{id}', [
    'as'    => 'ajax-daerah',
    'uses'  => 'Clerk\AjaxController@getDaerah'
]);

Route::get('clerk/laporan/ajax/cases/tarikh/{id}', [
    'as'    => 'ajax-tarikh',
    'uses'  => 'Clerk\AjaxController@getTarikh'
]);

Route::get('clerk/laporan/ajax/cases/noDaftar/{id}', [
    'as'    => 'ajax-noDaftar',
    'uses'  => 'Clerk\AjaxController@getNoDaftar'
]);

Route::get('clerk/laporan/ajax/cases/noKes/{id}', [
    'as'    => 'ajax-noKes',
    'uses'  => 'Clerk\AjaxController@getNoKes'
]);

Route::get('clerk/laporan/ajax/officer/nama/{id}', [
    'as'    => 'ajax-pengirim',
    'uses'  => 'Clerk\AjaxController@getNamaPengirim'
]);

Route::get('clerk/laporan/ajax/officer/organisasi/{id}', [
    'as'    => 'ajax-pengirim',
    'uses'  => 'Clerk\AjaxController@getOrganisasiPengirim'
]);

Route::get('clerk/laporan/ajax/officer/alamat/{id}', [
    'as'    => 'ajax-pengirim',
    'uses'  => 'Clerk\AjaxController@getAlamatPengirim'
]);

Route::get('clerk/laporan/ajax/officer/notel/{id}', [
    'as'    => 'ajax-pengirim',
    'uses'  => 'Clerk\AjaxController@getNoTelPengirim'
]);

Route::get('clerk/laporan/ajax/penerima/organisasi/{id}', [
    'as'    => 'ajax-penerima',
    'uses'  => 'Clerk\AjaxController@getOrganisasiPenerima'
]);







// ######################## LARAVEL ##########################
// ################ BUILT IN AUTHENTICATION ##################


Route::controllers([
	'auth' => 'Auth\AuthController',
	'password' => 'Auth\PasswordController',
]);
