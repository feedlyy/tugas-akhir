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


//Route::prefix('admin')->group(function (){
//    Route::middleware(['auth', 'fakultas'])->group(function (){
//        Route::get('', 'AdminViewHandleController@tampilan');
//    });
//    Route::middleware(['auth', 'departemen'])->group(function (){
//        Route::get('', 'AdminViewHandleController@tampilan');
//    });
//    Route::middleware(['auth', 'prodi'])->group(function (){
//        Route::get('', 'AdminViewHandleController@tampilan');
//    });
//});

Route::prefix('admin')->group(function (){
   Route::middleware('auth')->group(function (){
    Route::get('', 'AdminViewHandleController@tampilan')->name('tampilan');
    Route::resource('gedung', 'GedungController');
    Route::resource('ruangan', 'RuanganController');
    Route::get('kalender', 'KalenderController@kalender')->name('kalender');
   });
});



////ini buat fakultas
//Route::prefix('fakultas')->group(function (){
//    Route::middleware(['auth', 'fakultas'])->group(function (){
//        Route::get('', 'AdminViewHandleController@fakultas')->name('fakultas');
//        Route::get('kalender', 'KalenderController@kalender')->name('kalenderFakultas');
//        Route::prefix('gedung')->group(function (){
//            Route::resource('', 'GedungController', ['names' => [
//                'index' => 'Gedung1'
//            ]]);
//            Route::resource('tambahgedung', 'GedungController', ['names' => [
//                'index' => 'tambahGedung1'
//            ]]);
//        });
//        Route::resource('tambahruangan', 'RuanganController', ['names' => [
//            'index' => 'tambahRuangan1'
//        ]]);
//    });
//
//});
//
////ini buat departemen
//Route::prefix('departemen')->group(function (){
//    Route::middleware(['auth', 'departemen'])->group(function (){
//        Route::get('', 'AdminViewHandleController@departemen')->name('departemen');
//        Route::get('kalender', 'KalenderController@kalender')->name('kalenderDepartemen');
//        Route::prefix('gedung')->group(function (){
//            Route::resource('', 'GedungController', ['names' => [
//                'index' => 'Gedung2'
//            ]]);
//            Route::resource('tambahgedung', 'GedungController', ['names' => [
//                'index' => 'tambahGedung2'
//            ]]);
//        });
//        Route::resource('tambahruangan', 'RuanganController', ['names' => [
//            'index' => 'tambahRuangan2'
//        ]]);
//    });
//});
//
//
////ini buat prodi
//Route::prefix('prodi')->group(function (){
//    Route::middleware(['auth', 'prodi'])->group(function (){
//        Route::get('', 'AdminViewHandleController@prodi')->name('prodi');
//        Route::get('kalender', 'KalenderController@kalender')->name('kalenderProdi');
//        Route::prefix('gedung')->group(function (){
//            Route::resource('', 'GedungController', ['names' => [
//                'index' => 'Gedung3'
//            ]]);
//            Route::resource('tambahgedung', 'GedungController', ['names' => [
//                'index' => 'tambahGedung3'
//            ]]);
//        });
//        Route::resource('tambahruangan', 'RuanganController', ['names' => [
//            'index' => 'tambahRuangan3'
//        ]]);
//    });
//});



