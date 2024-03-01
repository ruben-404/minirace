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

}
