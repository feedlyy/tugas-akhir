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
    return view('homepage');
});

Auth::routes();

Route::get('jadwal', 'HomePageController@jadwal');
Route::get('visi', 'HomePageController@visi');


/*Route::get('/home', 'HomeController@index')->name('home');
Route::get('/home2', 'AdminViewHandleController@tes')->name('home2');*/


Route::prefix('admin')->group(function (){
   Route::middleware('auth')->group(function (){    
    Route::get('', 'AdminViewHandleController@tampilan')->name('tampilan');
    Route::resources([
       'gedung' => 'GedungController',
        'ruangan' => 'RuanganController',
        'admin' => 'AdminController',
        'staff' => 'StaffController',
        'acara' => 'AcaraController',
        'fakultas' => 'FakultasController',
        'departemen' => 'DepartemenController',
        'prodi' => 'ProdiController'
    ]);
    Route::get('create', 'AddAdmin@create');
    Route::post('addDepartemen', 'AddAdmin@store')->name('addDepartemen');
    Route::get('kalender', 'KalenderController@kalender')->name('kalender');

    /*ini untuk post data dari import excel*/
    Route::post('importExcel', 'ImportExcelController@importExcel')->name('import');
   });
});

/*ini untuk fungsi ajax yg select nama ruang*/
Route::get('nama/{id_gedung}', 'GetNamaController@getNamaRuang');

/*fungsi ajax untuk select prodi*/
Route::get('prodi/{departemen}', 'GetProdiController@GetProdi');

/*fungsi ajax untuk get semua email vokasi*/
Route::get('getFakultas/{fakultas}', 'GetNamaController@getSummary');

/*fungsi ajax untuk get semua email departemen*/
Route::get('getDepartemen/{departemen}', 'GetNamaController@getSummary2');

/*fungsi ajax untuk get semua email prodi*/
Route::get('getProdi/{prodi}', 'GetNamaController@getSummary3');

