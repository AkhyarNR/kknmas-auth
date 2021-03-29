<?php

use RealRashid\SweetAlert\Facades\Alert;


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
Auth::routes();

Route::get('auth/logout', 'Auth\LoginController@logout');

Route::get('/pendaftar', 'MenuController@pendaftar')->middleware('auth');
Route::get('/dpl', 'MenuController@dpl')->middleware('auth');
Route::get('/nilai', 'MenuController@nilai')->middleware('auth');
Route::get('/rekap_baju', 'MenuController@rekap_baju')->middleware('auth');
Route::get('/kelompok', 'MenuController@kelompok')->middleware('auth');
Route::get('/lokasi', 'MenuController@lokasi')->middleware('auth');
Route::get('/perijinan', 'MenuController@perijinan')->middleware('auth');
Route::get('/periode', 'MenuController@periode')->middleware('auth');
Route::get('/universitas', 'MenuController@universitas')->middleware('auth');
Route::get('/mitra', 'MenuController@mitra')->middleware('auth');


// Beranda
Route::get('/beranda', 'MenuController@beranda')->middleware('auth');




