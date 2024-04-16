<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Carrera;
use App\Models\Inscrito;
use App\Models\FotoCarrera;
use App\Models\Corredor;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Storage;
use App\Http\Controllers\InscritoController;
use App\Models\CurseSponsor;
use App\Models\Sponsor;
use Illuminate\Support\Collection;


class CarreraController extends Controller
{
    protected $inscritoController;

    public function __construct(InscritoController $inscritoController)
    {
        $this->inscritoController = $inscritoController;
    }
    public function showHomePage() {
        $carrerasDestacadas = Carrera::orderBy('data', 'desc')->take(5)->get();
        return view('principal.paginas.home', compact('carrerasDestacadas'));
    }
    
    public function getCarreras()
    {
        $carreras = Carrera::all();
        return view('admin.carreras.tablaCarreras', compact('carreras'));
    }

    public function buscarCarreras(Request $request)
    {
        $query = $request->input('query');
        $carreras = Carrera::where('nom', 'like', "%$query%")->get();
        $tbodyHtml = View::make('admin.carreras.tablaCarreras', ['carreras' => $carreras])->render();
        
        // Buscar el contenido del div con clase .tbodyCont usando expresiones regulares
        preg_match('/<div class="tbodyCont"[^>]*>(.*?)<\/div>/s', $tbodyHtml, $matches);
        $tbodyContHtml = $matches[0] ?? '';

        return $tbodyContHtml;
    }

    public function buscarCarrerasPrincipal(Request $request)
    {
        $query = $request->input('query');

        // Obtener las carreras filtradas por el nombre
        $carreras = Carrera::where('nom', 'like', "%$query%")->get();

        // Renderizar la vista de las carreras utilizando Blade y pasarle los datos directamente
        $tbodyHtml = view('principal.componentes.carreras', ['carreras' => $carreras])->render();

        return $tbodyHtml;
    }




    public function addCarreras()
    {
  
        return view('admin.carreras.formularios.addCarreras');
    }

    public function guardar(Request $request)
    {
        $this->validarDatos($request);

        $imgMapa = $this->procesarImagen($request->file('imagen_mapa'), $request->input('nombre'), 'mapa');
        $imgCartel = $this->procesarImagen($request->file('cartell_promocio'), $request->input('nombre'), 'cartel');

        Carrera::create([
            'nom' => $request->nombre,
            'descripció' => $request->descripcion,
            'desnivell' => $request->desnivell,
            'imatgeMapa' => $imgMapa,
            'maximParticipants' => $request->maxim_participants,
            'habilitado' => $request->habilitado,
            'km' => $request->km,
            'data' => $request->data,
            'hora' => $request->hora,
            'puntSortida' => $request->punt_sortida,
            'cartellPromoció' => $imgCartel,
            'preuAsseguradora' => $request->preu_asseguradora,
            'preuPatrocini' => $request->preu_patrocinio,
            'preuInscripció' => $request->preu_inscripcio,
        ]);

        return redirect('/admin/carreras');
    }

    private function procesarImagen($imagen, $nombreCIF, $tipo)
    {
        $extension = $imagen->getClientOriginalExtension();
        $nombreArchivo = $tipo . '_' . $nombreCIF . '.' . $extension;
        $imagen->move(public_path('storage/carrerasImages'), $nombreArchivo);
        return $nombreArchivo;
    }
    private function validarDatos(Request $request)
    {
        $request->validate([
            'nombre' => 'required|string|max:255',
            'descripcion' => 'required|string',
            'desnivell' => 'required|integer',
            'imagen_mapa' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            'maxim_participants' => 'required|integer',
            'habilitado' => 'required|boolean',
            'km' => 'required|numeric',
            'data' => 'required|date',
            'hora' => 'required|date_format:H:i',
            'punt_sortida' => 'required|string',
            'cartell_promocio' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            'preu_asseguradora' => 'required|numeric',
            'preu_patrocinio' => 'required|numeric',
            'preu_inscripcio' => 'required|numeric',
        ]);
    }


    public function editar($id)
    {
        // Obtener la carrera por su ID
        $carrera = Carrera::findOrFail($id);

        // Devolver la vista de edición con los datos de la carrera
        return view('admin.carreras.formularios.editarCarreras', compact('carrera'));
    }

   
    public function actualizar(Request $request, $id)
    {
        $carrera = Carrera::findOrFail($id);
        $request->validate([
            'nom' => 'required|string|max:255',
            'descripció' => 'required|string',
            'desnivell' => 'required|integer',
            'imatgeMapa' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
            'maximParticipants' => 'required|integer',
            'habilitado' => 'required|boolean',
            'km' => 'required|numeric',
            'data' => 'required|date',
            'hora' => 'required|date_format:H:i',
            'puntSortida' => 'required|string',
            'cartellPromoció' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
            'preuAsseguradora' => 'required|numeric',
            'preuPatrocini' => 'required|numeric',
            'preuInscripció' => 'required|numeric',
        ]);

        //fotos
        // Procesar la imagen del mapa si se proporcionó en el formulario
        if ($request->hasFile('imatgeMapa')) {
            $imagenMapa = $request->file('imatgeMapa');
            $imgMapa = 'mapa_' . $request->input('nom') . '.' . $imagenMapa->getClientOriginalExtension();
            $imagenMapa->move(public_path('storage/carrerasImages'), $imgMapa);
        } else {
            // Si no se proporcionó una nueva imagen, mantener la imagen existente
            $imgMapa = $carrera->imatgeMapa;
        }

        //añadir campo cartel
        if ($request->hasFile('cartellPromoció')) {
            $imgCartel = $request->file('cartellPromoció');
            $imCartel = 'cartel_' . $request->input('nom') . '.' . $imgCartel->getClientOriginalExtension();
            $imgCartel->move(public_path('storage/carrerasImages'), $imCartel);

        } else {
            // Si no se proporcionó una nueva imagen, mantener la imagen existente
            $imCartel = $carrera->cartellPromoció;
        }

        // Procesar la imagen del cartel si se proporcionó en el formulario
        if ($request->hasFile('imgCarrera')) {
            $imagenes = $request->file('imgCarrera');
            $nombresImagenes = [];
            
            foreach ($imagenes as $key => $imagen) {
                $nombreImagen = 'carrusel_' . $request->input('nom') . '_' . $carrera->idCarrera . '_imagen_' . $key . '.' . $imagen->getClientOriginalExtension();
                $imagen->move(public_path('storage/carrerasImages'), $nombreImagen);
                $nombresImagenes[] = $nombreImagen;

                $fotoCarrera = new FotoCarrera();
                $fotoCarrera->idCarrera = $carrera->idCarrera;
                $fotoCarrera->ruta = $nombreImagen;
                $fotoCarrera->save();

            }
        }
        




        try {
            $carrera->nom = $request->nom;
            $carrera->descripció = $request->descripció;
            $carrera->desnivell = $request->desnivell;
            $carrera->imatgeMapa = $imgMapa;
            $carrera->maximParticipants = $request->maximParticipants;
            $carrera->habilitado = $request->habilitado;
            $carrera->km = $request->km;
            $carrera->data = $request->data;
            $carrera->hora = $request->hora;
            $carrera->puntSortida = $request->puntSortida;
            $carrera->cartellPromoció = $imCartel;
            $carrera->preuAsseguradora = $request->preuAsseguradora;
            $carrera->preuPatrocini = $request->preuPatrocini;
            
            $carrera->preuInscripció = $request->preuInscripció;


            $carrera->update();
            // Redireccionar después de la actualización exitosa
            return redirect('/admin/carreras')->with('success', 'Carrera actualizada correctamente.');

        } catch (\Exception $e) {
            // Manejar la excepción y proporcionar una respuesta adecuada

            return redirect()->back()->withInput()->with('error', $e->getMessage());
        }
    }


    public function toggleHabilitado(Request $request, $id)
    {
        $carrera = Carrera::findOrFail($id);
        $carrera->habilitado = !$carrera->habilitado; // Cambia el estado
        $carrera->save();

        return redirect('/admin/carreras');

    }

    public function getCorredoresInscritos($idCarrera)
    {
        // Buscar los inscritos para la carrera específica con la relación corredor cargada
        
        $inscritos = Inscrito::with('corredor')->where('idCarrera', $idCarrera)->get();

        return view('admin.carreras.participantes', compact('inscritos'));
    }

    public function getCorredoresInscritospdf($idCarrera)
    {
        // Buscar los inscritos para la carrera específica con la relación corredor cargada
        
        $inscritos = Inscrito::with('corredor')->where('idCarrera', $idCarrera)->get();


        return view('admin.carreras.participantesPDF', compact('inscritos'));
    }

    //carreras cliente

    public function getCarrerasClient()
    {
        $carreras = Carrera::all();
        return view('principal.paginas.paginaCarreras', compact('carreras'));
    }

public function infoCarrera($idCarrera)
{
    // Obtener la carrera
    $carrera = Carrera::findOrFail($idCarrera);
    
    // Verificar si el usuario está autenticado y obtener su ID
    $userId = null;
    if (auth()->check()) {
        $user = auth()->user();
        $userId = $user['DNI'];
    }

    // Verificar si el usuario está inscrito en esta carrera
    $estaInscrito = false;
    if ($userId) {
        $estaInscrito = $carrera->inscritos()->where('DNIcorredor', $userId)->exists();
    }

    // Obtener las fotos de la carrera
    $fotos = $carrera->fotos;

    // Obtener la clasificación de participantes por edad y género
    $inscritoController = new InscritoController();
    $clasificacionParticipantes = $inscritoController->clasificarParticipantesPorEdadGenero($idCarrera);

    $llena = ($carrera->maximParticipants == $carrera->inscritos->count());

    // Obtener todos los registros de inscritos que hayan terminado la carrera
    $registrosTerminados = $carrera->inscritos()
        ->whereNotNull('temps')
        ->with('corredor') // Cargar la relación con el corredor
        ->get();

    // Obtener los patrocinadores de la carrera
    // Obtener los patrocinadores de la carrera
    $curseSponsors = CurseSponsor::where('idCarrera', $idCarrera)->get();
    $sponsors = new Collection();
    foreach ($curseSponsors as $curseSponsor) {
        $sponsor = Sponsor::where('CIF', $curseSponsor->cifSponsor)->first();
        if ($sponsor) {
            $sponsors->push($sponsor);
        }
    }
    // Pasar los datos a la vista
    return view('principal.paginas.infoCarreras', compact('carrera', 'fotos', 'estaInscrito', 'clasificacionParticipantes', 'registrosTerminados', 'sponsors','llena'));
}



    public function datosUsuarioNovalidado($id)
    {
        return view('principal.formularios.datosUsuarioNoValidado', ['id' => $id]);
    }

    public function pagarCarrera()
    {
        return view('principal.formularios.pagarCarrera');
    }


    public function apuntraseCarreraValidado()
    {
        $user = auth()->user(); // Obtener el usuario autenticado
        $tipus = $user['tipus'];
        

        if ($tipus === 'pro') {
            return view('principal.formularios.pagarCarrera'); // Redirigir a la vista de pagar carrera
        } else {
            return view('principal.formularios.pagarAsseguradora'); // Redirigir a la vista de pagar asseguradora
        }
    }


    public function carrusel($id){


        $carrera = Carrera::find($id);
        $fotos = $carrera->fotos;

        return view('principal.componentes.carrusel', compact('fotos'));


    }

    public function updateDorsalesCorredores(Request $request) {
        $dorsales = $request->input('numDorsales');
        $idcarrera = $request->input('carreraid');
        $inscritosEncontrados = [];
    
        foreach ($dorsales as $dorsal) {
            $inscrito = Inscrito::where('DNIcorredor', $dorsal['dni'])
                ->where('idCarrera', intval($idcarrera))
                ->first();
    
            if ($inscrito) {
                try {
                    $inscrito->numDorsal = intval($dorsal['dorsalnum']);
                    $inscrito->save();
                    $inscritosEncontrados[] = $inscrito;
                } catch(Exception $e) {
                    return response()->json(['error' => 'Error al procesar la solicitud: ' . $e->getMessage()], 500);
                }
            }
        }
        return response()->json(['message' => 'Dorsales actualizados correctamente', 'inscritos' => $inscritosEncontrados]);
    }



}
