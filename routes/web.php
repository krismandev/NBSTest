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



Auth::routes();

Route::get('/', 'HomeController@index')->name('index');
Route::get('/logout', 'AuthController@logout')->name('logout');
Route::group(['prefix'=>'positions'],function(){
    Route::get('/','JabatanController@getPositions')->name('getPositions');
    Route::post('/','JabatanController@storePosition')->name('storePosition');
    Route::patch('/','JabatanController@updatePosition')->name('updatePosition');
    Route::get('/{id}/delete','JabatanController@deletePosition')->name('deletePosition');
});

Route::group(['prefix'=>'employees'],function(){
    Route::get('/','KaryawanController@getEmployees')->name('getEmployees');
    Route::post('/','KaryawanController@storeEmployee')->name('storeEmployee');
    Route::patch('/','KaryawanController@updateEmployee')->name('updateEmployee');
    Route::get('/{id}/delete','KaryawanController@deleteEmployee')->name('deleteEmployee');
});

Route::get('/submit-pagi','HomeController@submitKehadiranPagi')->name('submitKehadiranPagi');
Route::get('/submit-sore','HomeController@submitKehadiranSore')->name('submitKehadiranSore');

Route::get('/data-kehadiran','DataKehadiranController@dataKehadiran')->name('dataKehadiran');
Route::get('/data-kehadiran/{tanggal}','DataKehadiranController@dataKehadiranByDate')->name('dataKehadiranByDate');

Route::get('/rekap','DataKehadiranController@rekapAbsensi')->name('rekapAbsensi');


