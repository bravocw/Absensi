<?php

use Illuminate\Support\Facades\Route;

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

Route::get('/', function () {
    return view('auth.login');
});

Route::group(['prefix' => 'auth'], function () {
    Auth::routes();
});


Route::group(['prefix' => 'absensi', 'middleware' => 'auth'], function () {
    Route::group(['prefix' => 'barang', 'as' => 'barang.'], function () {
        Route::get('/print', 'Absens\PdfController@generatePdf')->name('print');
    });
    Route::get('/data', 'HomeController@index')->name('home');
    Route::resource('/data', 'Absens\AbsenController');
    Route::resource('/pengurus', 'Penguruss\PengurusController');
    Route::resource('/barangs/json', 'Absens\Ajax\AbsenAjaxController');
    Route::resource('/penguruss/json', 'Penguruss\Ajax\PengurusAjaxController');
});

// Route::group(['prefix' => 'commodities', 'as' => 'commodities.'], function () {
// });
