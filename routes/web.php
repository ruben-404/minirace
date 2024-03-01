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
//ver tabla carreas
Route::get('/admin/carreras', function () {
    return app()->make(CarreraController::class)->getCarreras();
});
//add carreras formulario
Route::get('/admin/add-carreras', [CarreraController::class, 'addCarreras'])->name('addCarreras');
// save  carreras
Route::post('/admin/carreras/guardar', [CarreraController::class, 'guardar'])->name('guardarCarrera');



//parte login admin
Route::get('/admin', [AdminController::class, 'login']);
Route::post('/ProcesarLogin', [AdminController::class, 'ProcesarLogin'])->name('ProcesarLogin');
