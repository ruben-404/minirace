<?php

use App\Http\Middleware\AdminAuthMiddleware;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CarreraController;
use App\Http\Controllers\AsseguradoraController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\SponsorController;

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


//Parte login admin
Route::get('/admin', [AdminController::class, 'login'])->name('admin.login');
//Comprobacion login
Route::post('/admin/ProcesarLogin', [AdminController::class, 'ProcesarLogin'])->name('ProcesarLogin');
//logout admin
Route::get('/admin/logOut', [AdminController::class, 'logOut'])->name('admin.logout');

//ver tabla carreas
Route::middleware([AdminAuthMiddleware::class])->group(function () {
    Route::get('/admin/carreras', function () {
        return app()->make(CarreraController::class)->getCarreras();
    });
    //add carreras formulario
    Route::get('/admin/add-carreras', [CarreraController::class, 'addCarreras'])->name('addCarreras');
    // save  carreras
    Route::post('/admin/carreras/guardar', [CarreraController::class, 'guardar'])->name('guardarCarrera');
    //editar carreras
    Route::get('/admin/carreras/{id}', [CarreraController::class, 'editar'])->name('editar');
    //save edit carrera
    Route::put('/admin/carreras/{id}', [CarreraController::class, 'actualizar'])->name('actualizarCarrera');
    //activar/desacctivar carreras
    Route::put('/admin/carreras/{id}/toggle', [CarreraController::class, 'toggleHabilitado'])->name('toggleHabilitado');


    //ver tabla asseguradoras
    Route::get('/admin/asseguradoras', function () {
        return app()->make(AsseguradoraController::class)->getAsseguradoras();
    });
    //add aseguradora formulario
    Route::get('/admin/add-aseguradoras', [AsseguradoraController::class, 'addAseguradora'])->name('addAseguradora');
    // save  aseguradoras
    Route::post('/admin/asseguradoras/guardar', [AsseguradoraController::class, 'guardar'])->name('guardarAseguradora');
    //editar aseguradoras
    Route::get('/admin/asseguradoras/{cif}', [AsseguradoraController::class, 'editar'])->name('editarAsseguradora');
    //save edit aseguradoras
    Route::put('/admin/asseguradoras/{cif}', [AsseguradoraController::class, 'actualizar'])->name('actualizarAsseguradora');
});
