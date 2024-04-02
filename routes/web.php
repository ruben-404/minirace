<?php

use App\Http\Middleware\AdminAuthMiddleware;
use App\Http\Middleware\CorredorMiddleware;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CarreraController;
use App\Http\Controllers\AsseguradoraController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\SponsorController;
use App\Http\Controllers\CarreraAsseguradaController;
use App\Http\Controllers\CorredorController;
use App\Http\Controllers\InscritoController;


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

Route::get('/', [CarreraController::class, 'showHomePage']);


//Parte login admin
Route::get('/admin', [AdminController::class, 'login'])->name('admin.login');
//Comprobacion login
Route::post('/admin/ProcesarLogin', [AdminController::class, 'ProcesarLogin'])->name('ProcesarLogin');
//logout admin
Route::get('/admin/logOut', [AdminController::class, 'logOut'])->name('admin.logout');
//Navegacion pagina princiapl
//Route::get('/home/carreras', [CarreraController::class, 'paginaCarreras'])->name('paginaCarreras');
Route::get('/home/carreras', function () {
    return app()->make(CarreraController::class)->getCarrerasClient();
});
//login Usuario
Route::get('/home/login', [CorredorController::class, 'paginaLogin'])->name('login');
Route::post('/home/ProcesarLogin', [CorredorController::class, 'ProcesarLogin'])->name('HomeLogin');
Route::post('/home/logOut', [CorredorController::class, 'logOut'])->name('logout');
//pagina principal
Route::get('/buscar-carreras-principal', [CarreraController::class, 'buscarCarrerasPrincipal'])->name('buscar-carreras-principal');
Route::get('/home/carreras/{id}', [CarreraController::class, 'infoCarrera'])->name('infoCarrera');

//register Usuario socio
Route::get('/home/register', [CorredorController::class, 'paginaRegister'])->name('register');
//Procesar registro socio
Route::post('/home/procesarRegistro', [CorredorController::class, 'procesarRegistro'])->name('procesarRegistro');


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
    //PDF corredores
    Route::get('/admin/carreras/{id}/corredorespdf', [CarreraController::class, 'getCorredoresInscritospdf'])->name('corredores.inscritosPDF');



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
    Route::put('/admin/asseguradoras/{cif}/toggle', [AsseguradoraController::class, 'toggleHabilitado'])->name('toggleHabilitadoAseguradora');
    //Carreras aseguradas 
    Route::get('/admin/asseguradoras/{cif}/carreras/aseguradas', [AsseguradoraController::class, 'getCarrerasAseguradas'])->name('carreras.aseguradas');

    //Mostrar carreras para añadir
    Route::get('/admin/asseguradoras/{cif}/carreras/asegurar', [CarreraAsseguradaController::class, 'getCarrerasSinAsegurar'])->name('mostrarAseguracionCarreras');
    //Guardar carrera asegurada
    Route::post('/admin/asseguradoras/carreras/guardarAseguración', [CarreraAsseguradaController::class, 'saveCarreraAsegurada'])->name('guardarCarreraAsegurada');
    //Carreras aseguradas PDF:
    Route::post('/admin/asseguradoras/carreras/facturaAseguración', [CarreraAsseguradaController::class, 'mostrarFacturaAseguradasPDF'])->name('carreras.aseguradasPDF');
    
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

    //buscadores 
    //-Carrera
    Route::get('/buscar-carreras', [CarreraController::class, 'buscarCarreras'])->name('buscar-carreras');
    Route::get('/buscar-asseguradoras', [AsseguradoraController::class, 'buscarAsseguradores'])->name('buscar-asseguradoras');
    Route::get('/buscar-sponsors', [CarreraController::class, 'buscarSponsors'])->name('buscar-sponsors');



});


// //rutas usuario validado no va
// Route::middleware('auth')->group(function () {
//     // Aquí van las rutas que requieren autenticación
//     Route::post('/apuntarse-carrera', [CarreraController::class, 'apuntraseCarreraValidado'])->name('apuntarse.carrera');
// });


//rutas no validado
Route::get('/apuntarse-carrera-no-validado/{idCarrera}', [CarreraController::class, 'datosUsuarioNovalidado'])->name('apuntarse.carrera.noAutenticado');

//Para PRO
Route::post('/inscribir-usuario-no-validado', [InscritoController::class, 'inscribirUsuarioNoValidado'])->name('inscribirUsuarioNoValidado');
Route::post('/gestionar-inscripcion-no-validado-pro', [InscritoController::class, 'gestionarInscripcionNovalidadoPro'])->name('gestionar.inscripcion.novalidado.pro');

//Para OPEN
Route::post('/mandar-aseguraciones-carrera-open', [InscritoController::class, 'mandarAseguracionesCarreraOpen'])->name('mandar.aseguraciones.carrera.open');
Route::post('/gestionar-inscripcion-no-validado-open', [InscritoController::class, 'gestionarInscripcionNovalidadoOpen'])->name('gestionar.inscripcion.novalidado.open');


//rutas validado
Route::get('/apuntarse-carrera/{idCarrera}', [InscritoController::class, 'apuntraseCarreraValidado'])->name('apuntarse.carrera');

//Para PRO

Route::post('/gestionar-inscripcion-socio-pro', [InscritoController::class, 'gestionarInscripcionSocioPro'])->name('gestionar.inscripcion.socio.pro');

//Para OPEN
Route::post('/pagar-carrera-open', [InscritoController::class, 'pagarCarreraOPEN'])->name('principal.formularios.pagarCarrera.open');
Route::post('/gestionar-inscripcion-socio-open', [InscritoController::class, 'gestionarInscripcionSocioOpen'])->name('gestionar.inscripcion.socio.open');