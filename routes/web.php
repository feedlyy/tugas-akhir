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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();


Route::get('/home', 'HomeController@index')->name('home');
Route::get('/home2', 'AdminViewHandleController@tes')->name('home2');



Route::prefix('admin')->group(function (){
   Route::middleware('auth')->group(function (){
    Route::get('', 'AdminViewHandleController@tampilan')->name('tampilan');
    Route::resources([
       'gedung' => 'GedungController',
        'ruangan' => 'RuanganController',
        'admin' => 'AdminController',
        'staff' => 'StaffController',
        'acara' => 'AcaraController'
    ]);
    Route::get('kalender', 'KalenderController@kalender')->name('kalender');
   });
});




