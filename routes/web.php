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
Route::get('/', 'HomeController@index');
// Route::auth();
// Auth::routes();

// Route::group( ['prefix' => 'admin','as' => 'admin.','middleware' => ['auth']], function() {
Route::group( ['as' => 'admin.','middleware' => ['auth']], function() {

    Route::get('/', 'HomeController@index')->name('index');

    Route::get('/daftar-ulang','DaftarUlangController@show')->name('daftarulang');
    Route::get('/pengajuan-daftarulang/{id}','DaftarUlangController@pengajuan')->name('pengajuan');
    Route::get('/checkstatus/{id}','DaftarUlangController@checkstatus')->name('checkstatus');
    Route::get('/printpdf/{id}','DaftarUlangController@printpdf')->name('printpdf');

    // master data
    Route::get('/master-kelas','KelasController@show')->name('kelas');
    Route::get('/master-jurusan','JurusanController@show')->name('jurusan');
    Route::get('/master-tahunajaran','TahunAjaranController@show')->name('tahunajaran');

    //master user
    Route::get('/master-user','masteruser\LoginUserController@show')->name('masteruser');

    //api
    Route::apiResource('/api/daftar-ulang','DaftarUlangController');
    Route::apiResource('/api/master-kelas','KelasController');
    Route::apiResource('/api/master-jurusan','JurusanController');
    Route::apiResource('/api/master-tahunajaran','TahunAjaranController');

    
});

require __DIR__.'/auth.php';
