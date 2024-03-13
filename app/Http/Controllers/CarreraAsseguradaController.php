<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\CarreraAssegurada;
use App\Models\Carrera;

class CarreraAsseguradaController extends Controller
{
    public function getMyCarrerasSinAsegurar($cif)
    {
        $carrerasIds = Carrera::pluck('idCarrera');
        $carrerasAseguradas = 0;
    }
}
