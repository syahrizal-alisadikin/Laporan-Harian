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
    return view('barang');
});

Route::resource('barang', 'BarangController');
Route::resource('penjualan', 'PenjualanController');
Route::get('getBarang/{id}', 'PenjualanController@getBarang');
Route::get('cetak_pdf', 'PenjualanController@cetak_pdf')->name('cetak_pdf');
