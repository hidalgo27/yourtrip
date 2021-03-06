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

//Route::get('/', function () {
//    return view('welcome');


Route::get('/', [
    'uses' => 'HomeController@index1',
    'as' => 'home_path1',
]);

Route::get('/coti/{cotizacion}-{paquete}', [
    'uses' => 'HomeController@index',
    'as' => 'home_path',
]);

Route::get('/booking_information/{cotizacion}-{paquete}-{cliente_id}-{estado}-{confirm}', [
    'uses' => 'HomeController@information',
    'as' => 'information_path',
]);
Route::get('/booking_information_full/{cotizacion}-{paquete}', [
    'uses' => 'HomeController@information_full',
    'as' => 'information_full_path',
]);
Route::get('/booking_information/edit/{cotizacion}-{paquete}', [
    'uses' => 'HomeController@information_edit',
    'as' => 'information_edit_path',
]);
Route::post('/booking_information/s_information', [
    'uses' => 'HomeController@s_information',
    'as' => 's_information_path',
]);

Route::get('/final_procedures/{cotizacion}-{paquete}', [
    'uses' => 'HomeController@final_',
    'as' => 'final_path',
]);

Route::get('/checkout/{cotizacion}-{paquete}', [
    'uses' => 'HomeController@checkout',
    'as' => 'checkout_path',
]);
Route::get('/storage/passport_photo/{paquete}', [
    'uses' => 'HomeController@getCotiArchivosImageName',
    'as' => 'storage_get_imagen_path',
]);
Route::post('/booking_information_full/ask_information', [
    'uses' => 'HomeController@ask_information',
    'as' => 'ask_information_path',
]);