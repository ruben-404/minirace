<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Carrera;
use App\Models\Inscrito;
use Illuminate\Support\Facades\View;


class CarreraController extends Controller
{
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
        // Validar los datos del formulario
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


        //fotos
        $imagenMapa = $request->file('imagen_mapa');
        $nombreCIF = $request->input('nom');
        $extension = $imagenMapa->getClientOriginalExtension();
        $imgMapa = 'mapa_' . $nombreCIF . '.' . $extension;


        $imagenCartel = $request->file('cartell_promocio');
        $extension = $imagenCartel->getClientOriginalExtension();
        $imgCartel = 'cartel_' . $nombreCIF . '.' . $extension;

        // Guardar la imagen en la carpeta 'public'
        $imagenMapa->move(public_path('storage/carrerasImages'), $imgMapa);
        $imagenCartel->move(public_path('storage/carrerasImages'), $imgCartel);


        // Crear una nueva instancia de Carrera y asignar los valores
        $carrera = new Carrera();
        $carrera->nom = $request->nombre;
        $carrera->descripció = $request->descripcion;
        $carrera->desnivell = $request->desnivell;
        $carrera->imatgeMapa = $imgMapa;
        $carrera->maximParticipants = $request->maxim_participants;
        $carrera->habilitado = $request->habilitado;
        $carrera->km = $request->km;
        $carrera->data = $request->data;
        $carrera->hora = $request->hora;
        $carrera->puntSortida = $request->punt_sortida;
        $carrera->cartellPromoció = $imgCartel;
        $carrera->preuAsseguradora = $request->preu_asseguradora;
        $carrera->preuPatrocini = $request->preu_patrocinio;
        $carrera->preuInscripció = $request->preu_inscripcio;

        // Guardar la carrera en la base de datos
        $carrera->save();

        // Redirigir a la página de lista de carreras u otra página según sea necesario
        return redirect('/admin/carreras');
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
        dd($request);

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

        // Procesar la imagen del cartel si se proporcionó en el formulario
        if ($request->hasFile('cartellPromoció')) {
            $imagenCartel = $request->file('cartellPromoció');
            $imgCartel = 'cartel_' . $request->input('nom') . '.' . $imagenCartel->getClientOriginalExtension();
            $imagenCartel->move(public_path('storage/carrerasImages'), $imgCartel);
        } else {
            // Si no se proporcionó una nueva imagen, mantener la imagen existente
            $imgCartel = $carrera->cartellPromoció;
        }


        if ($request->hasFile('imgCarrera')) {
            // Procesar la imagen nueva
            dd($request);
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
            $carrera->cartellPromoció = $imgCartel;
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
        // $inscritos = Inscrito::with('corredor')
        // ->where('idCarrera', '!=', $idCarrera)
        // ->orWhereNull('idCarrera')
        // ->get();



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
        $carrera = Carrera::findOrFail($idCarrera);

        return view('principal.paginas.infoCarreras', compact('carrera'));

    }

    public function datosUsuarioNovalidado()
    {
        return view('principal.formularios.datosUsuarioNoValidado');
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



}
