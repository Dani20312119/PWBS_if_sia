<?php

use App\Http\Controllers\Karyawan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

// buat route karyawan
// route view data karyawan
Route::get('/view',[karyawan::class,'view']);
// route detail data karyawan
Route::get('/detail/{parameter}',[karyawan::class,'detail']);
// route untuk hapus data
Route::delete('delete/{parameter}', [Karyawan::class, 'delete']);
// route untuk inser data
Route::post('/insert', [Karyawan::class, 'insert']);
// route untuk ubah data
Route::put('/update/{parameter}', [Karyawan::class, 'update']);