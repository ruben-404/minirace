<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Corredor;
use App\Models\Empresa;
use Illuminate\Support\Facades\View;

class EmpresaController extends Controller
{
    public function getPrecioSocio()
    {
        $empresa = Empresa::first();
        if ($empresa) {
            $preuSociAnual = $empresa->preuSociAnual;
            return response()->json(['price' => $preuSociAnual]);
        }
    }
    public function generarFacturaSocio(Request $request) {
        $DNIcorredor = $request->query('DNIcorredor');
        $empresa = Empresa::first();
        $corredor = Corredor::where('DNI', $DNIcorredor)->first();
        $datos = [
            'corredor' => $corredor,
            'empresa' => $empresa
        ];
        return view('principal/PDFs/facturaSocio', ['datos' => $datos]);
    }
}
