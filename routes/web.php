<?php

use App\Http\Middleware\AdminAuthMiddleware;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CarreraController;
use App\Http\Controllers\AsseguradoraController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\SponsorController;
use App\Http\Controllers\HomeController;

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
    //activar/desactivar carreras
    Route::put('/admin/carreras/{id}/toggle', [CarreraController::class, 'toggleHabilitado'])->name('toggleHabilitado');
    //corredores
    Route::get('/admin/carreras/{id}/corredores', [CarreraController::class, 'getCorredoresInscritos'])->name('corredores.inscritos');



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
    //activar/desacctivar aseguradoras
    Route::put('/admin/asseguradoras/{cif}/toggle', [AsseguradoraController::class, 'toggleHabilitado'])->name('toggleHabilitado');

    
    //Ver tabla sponsors
    Route::get('/admin/sponsors', function () {
        return app()->make(SponsorController::class)->getSponsors();
    });
    //Formulario añadir sponsor
    Route::get('/admin/add-sponsors', [SponsorController::class, 'addSponsor'])->name('addSponsor');
    //Guardar sponsor
    Route::post('/admin/sponsors/guardar', [SponsorController::class, 'guardar'])->name('guardarSponsor');
    //Editar sponsor
    Route::get('/admin/sponsors/{cif}', [SponsorController::class, 'editar'])->name('editarSponsor');
    //Actualizar sponsor
    Route::put('/admin/sponsors/{cif}', [SponsorController::class, 'actualizar'])->name('actualizarSponsor');

    //navegacion
    Route::get('/admin/carreras', [CarreraController::class, 'getCarreras'])->name('carreras');
    Route::get('/admin/asseguradoras', [AsseguradoraController::class, 'getAsseguradoras'])->name('asseguradoras');
    Route::get('/admin/sponsors', [SponsorController::class, 'getSponsors'])->name('sponsors');

    //Home

    Route::get('/home', 'HomeController@myHome');
    Route::get('/detalles', 'HomeController@myDetalles');

});
