<?php

use Illuminate\Http\Request;

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

// Route::middleware('auth:api')->get('/user', function (Request $request) {
//     return $request->user();
// });

Route::get('login','Api\UserController@login');
Route::get('register','Api\UserController@register');
Route::get('rwt_sn','Api\UserController@rwtsn');

Route::get('sn','Api\SnController@index');
Route::get('cari_sn','Api\SnController@cari_sn');
Route::get('create_his','Api\RiwayatController@create_his');
Route::put('update_user/{email}','Api\UserController@update');
Route::get('cari_pelanggan','Api\UserController@cari_pelanggan');
Route::get('totalPoin','Api\RiwayatController@TotalPoin');
Route::get('hadiahs', 'Api\HadiahController@listHadiah');
Route::get('cari_hadiah', 'Api\HadiahController@cariHadiah');
Route::get('redPoin','Api\RiwayatController@redeemPoin');
Route::get('riwred','Api\RiwayatController@riwred');

Route::post('login','Api\UserController@login');
Route::post('register','Api\UserController@register');
Route::post('cari_sn','Api\SnController@cari_sn');
Route::post('rwt_sn','Api\RiwayatController@his_sn');
Route::post('create_his','Api\RiwayatController@create_his');
// Route::post('update_user','Api\CustomerController@update');
Route::post('cari_pelanggan','Api\UserController@cari_pelanggan');
Route::post('totalPoin','Api\RiwayatController@TotalPoin');
Route::post('hadiahs', 'Api\HadiahController@listHadiah');
Route::post('cari_hadiah', 'Api\HadiahController@cariHadiah');
Route::post('redPoin','Api\RiwayatController@redeemPoin');
Route::post('riwred','Api\RiwayatController@riwred');
Route::post('totalRedPoin','Api\RiwayatController@totalHadiah');

// Push Notif
Route::post('pushNotif', 'Api\RiwayatController@pushNotif'); 

Route::post('get_fcm', 'Api\HadiahController@getAll_fcm');

//Promosi
Route::post('data_contents','Api\PromosiController@listContent');
Route::post('data_sliders','Api\PromosiController@listSlider');

