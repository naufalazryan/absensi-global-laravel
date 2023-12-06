<?php

use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\CsrfController;
use App\Http\Controllers\KegiatanController;
use App\Http\Controllers\KehadiranController;
use App\Http\Controllers\KelasController;
use App\Http\Controllers\SiswaController;
use App\Models\Kehadiran;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

Route::middleware(['auth:sanctum'])->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('/csrf-token', [CsrfController::class, 'getToken']);

Route::middleware('auth:sanctum')->get('/check-role', function (Request $request) {
    $user = $request->user();
    
    $role = $user->role->name;
    
    return response()->json(['role' => $role]);
});

Route::get('/csrf-token', function () {
    return response()->json(['csrfToken' => csrf_token()]);
});

Route::get('/kegiatan', [KegiatanController::class, 'index']);
Route::post('/kegiatan/add', [KegiatanController::class, 'store']);
Route::get('/kegiatan/{id}/edit', [KegiatanController::class, 'edit']);
Route::post('/kegiatan/{id}/update', [KegiatanController::class, 'update']);
Route::delete('/kegiatan/{id}', [KegiatanController::class, 'destroy']);

Route::get('/kehadiran', [KehadiranController::class, 'index']);
Route::post('/kehadiran/add', [KehadiranController::class, 'store']);
Route::get('/kehadiran/{id}', [KehadiranController::class, 'show']);

Route::get('/siswa', [SiswaController::class, 'index']);
Route::get('/kelas', [KelasController::class, 'index']);
Route::get('/kelas/{id}', [KelasController::class, 'getKelasById']);

Route::post('/login', [AuthenticatedSessionController::class, 'store']);
Route::post('/logout', [AuthenticatedSessionController::class, 'destroy']);