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
//});

Route::get('/coti/{cotizacion}-{paquete}', [
    'uses' => 'HomeController@index',
    'as' => 'home_path',
]);

Route::get('/booking_information/{cotizacion}-{paquete}', [
    'uses' => 'HomeController@information',
    'as' => 'information_path',
]);