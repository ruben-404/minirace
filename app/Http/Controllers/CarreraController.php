<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Carrera;


class CarreraController extends Controller
{
    public function getCarreras()
    {
  
        $carreras = Carrera::all();
        return view('admin.carreras.tablaCarreras', compact('carreras'));
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
            'imagen_mapa' => 'required|string',
            'maxim_participants' => 'required|integer',
            'habilitado' => 'required|boolean',
            'km' => 'required|numeric',
            'data' => 'required|date',
            'hora' => 'required|date_format:H:i',
            'punt_sortida' => 'required|string',
            'cartell_promocio' => 'required|string',
            'preu_asseguradora' => 'required|numeric',
            'preu_patrocinio' => 'required|numeric',
            'preu_inscripcio' => 'required|numeric',
        ]);

        // Crear una nueva instancia de Carrera y asignar los valores
        $carrera = new Carrera();
        $carrera->nom = $request->nombre;
        $carrera->descripció = $request->descripcion;
        $carrera->desnivell = $request->desnivell;
        $carrera->imatgeMapa = $request->imagen_mapa;
        $carrera->maximParticipants = $request->maxim_participants;
        $carrera->habilitado = $request->habilitado;
        $carrera->km = $request->km;
        $carrera->data = $request->data;
        $carrera->hora = $request->hora;
        $carrera->puntSortida = $request->punt_sortida;
        $carrera->cartellPromoció = $request->cartell_promocio;
        $carrera->preuAsseguradora = $request->preu_asseguradora;
        $carrera->preuPatrocini = $request->preu_patrocinio;
        $carrera->preuInscripció = $request->preu_inscripcio;
        // Asigna otros valores a los otros campos si es necesario

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
        $carrera = Carrera::findOrFail($id);

        $carrera->update([
            'nom' => $request->input('nom'),
            'descripció' => $request->input('descripció'),
            'desnivell' => $request->input('desnivell'),
            'imatgeMapa' => $request->input('imatgeMapa'),
            'maximParticipants' => $request->input('maximParticipants'),
            'habilitado' => $request->input('habilitado'),
            'km' => $request->input('km'),
            'data' => $request->input('data'),
            'hora' => $request->input('hora'),
            'puntSortida' => $request->input('puntSortida'),
            'cartellPromoció' => $request->input('cartellPromoció'),
            'preuAsseguradora' => $request->input('preuAsseguradora'),
            'preuPatrocini' => $request->input('preuPatrocini'),
            'preuInscripció' => $request->input('preuInscripció'),
        ]);

        return redirect('/admin/carreras');
    }

}
