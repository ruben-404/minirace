<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\CarreraPatrocinada;
use App\Models\Carrera;

class CarreraPatrocinadaController extends Controller
{
    public function getCarrerasSinPatrocinar($cif)
    {
        $Carreras = Carrera::whereDoesntHave('carreres_patrocinadas', function ($query) use ($cif) {
            $query->where('cifSponsor', $cif);
        })->get();
        return view('admin.sponsors.formularios.addCarrerasPatrocinadas', ['Carreras' => $Carreras, 'cif' => $cif]);
    }
    public function saveCarreraPatrocinada(Request $request) {
        // Obtener todos los datos del formulario
        $datos = $request->all();

        // Acceder al valor del campo de texto
        $cif = $request->input('cif');
        //echo $cif;
        foreach($datos['carreras'] as $idCarrera) {
            // Crear una nueva instancia del modelo CarreraPatrocinada
            $carreraPatrocinada = new CarreraPatrocinada();
            
            // Asignar los valores a los campos correspondientes
            $carreraPatrocinada->cifSponsor = $cif;
            $carreraPatrocinada->idCarrera = $idCarrera;
            
            // Guardar el nuevo registro en la base de datos
            $carreraPatrocinada->save();
        }
        return view('admin.sponsors.succesfullyCarreraPatrocinada', compact('datos'));
    }
    public function mostrarFacturaPatrocinadasPDF(Request $request) {
        $idsCarrera = $request->input('carreras');
        $carreras = Carrera::whereIn('idCarrera', $idsCarrera)->get();
        $cif = $request->input('cif');
        // Ver datos

        // echo ($carreras);
        // echo($cif);

        return view('admin.sponsors.facturaSponsorPDF', ['carreras' => $carreras, 'cif' => $cif]);
    }
}