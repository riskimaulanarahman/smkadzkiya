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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});


Route::post('/upload-berkas/{id}/{module}','BerkasController@update')->name('uploadberkas');

//master user
Route::apiResource('/master-user','masteruser\LoginUserController');

//list refrensi
Route::post('list-kelas','API\ListController@listKelas');
Route::post('list-jurusan','API\ListController@listJurusan');
Route::post('list-tahunajaran','API\ListController@listTahunajaran');