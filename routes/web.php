<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CarreraController;
use App\Http\Controllers\AdminController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});


//Route::get('/admin/carreras', [CarreraController::class, 'getCarreras']);

Route::get('/admin/carreras', function () {
    return app()->make(CarreraController::class)->getCarreras();
});
Route::get('/admin', [AdminController::class, 'login']);
Route::post('/ProcesarLogin', [AdminController::class, 'ProcesarLogin'])->name('ProcesarLogin');
