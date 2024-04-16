<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\CarreraAssegurada;
use App\Models\Empresa;
use App\Models\Carrera;

class CarreraAsseguradaController extends Controller
{
    public function getCarrerasSinAsegurar($cif)
    {
        $Carreras = Carrera::whereDoesntHave('carreres_assegurades', function ($query) use ($cif) {
            $query->where('CIFasseguradora', $cif);
        })->get();
        return view('admin.asseguradores.formularios.addCarrerasAseguradas', ['Carreras' => $Carreras, 'cif' => $cif]);
    }
    public function saveCarreraAsegurada(Request $request) {
        // Obtener todos los datos del formulario
        $datos = $request->all();

        // Acceder al valor del campo de texto
        $cif = $request->input('cif');
        //echo $cif;
        foreach($datos['carreras'] as $idCarrera) {
            // Crear una nueva instancia del modelo CarreraAssegurada
            $carreraAssegurada = new CarreraAssegurada();
            
            // Asignar los valores a los campos correspondientes
            $carreraAssegurada->CIFasseguradora = $cif;
            $carreraAssegurada->idCarrera = $idCarrera;
            
            // Guardar el nuevo registro en la base de datos
            $carreraAssegurada->save();
        }
        return view('admin.asseguradores.succesfullyCarreraAsegurada', compact('datos'));
    }
    public function mostrarFacturaAseguradasPDF(Request $request) {
        $idsCarrera = $request->input('carreras');
        $carreras = Carrera::whereIn('idCarrera', $idsCarrera)->get();
        $empresa = Empresa::first();
        $cif = $request->input('cif');
        // Ver datos

        // echo ($carreras);
        // echo($cif);

        return view('admin.asseguradores.facturaAseguradoraPDF', ['carreras' => $carreras, 'cif' => $cif, 'empresa' => $empresa]);
    }
}