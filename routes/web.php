<?php

use App\Http\Controllers\CsrfController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|x
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which    
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return ['Absensi Global' => app()->version()];
});

Route::get('/csrf-token', [CsrfController::class, 'getToken']);

require __DIR__.'/auth.php';