<?php

use Illuminate\Http\Request;
use App\Http\Resources\StafResource;
use App\Staff;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('API', 'ApiController@index');

Route::resource('acara', 'AcaraController');
Route::get('oauth', 'AcaraController@oauth')->name('oauthCallback');
