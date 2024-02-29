<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Carrera;


class CarreraController extends Controller
{
    public function getCarreras()
    {
         $carreras = [
            [
                'nom' => 'Carrera de Montaña',
                'descripció' => 'Una emocionante carrera a través de las montañas.',
                'desnivell' => 500,
                'imatgeMapa' => 'ruta-a-la-imagen-1.jpg',
                'maximParticipants' => 100,
                'habilitado' => true,
                'km' => 10,
                'data' => '2024-03-15',
                'hora' => '09:00:00',
                'puntSortida' => 'Plaza Mayor',
                'cartellPromoció' => 'ruta-al-cartell-1.jpg',
                'preuAsseguradora' => 10,
                'preuPatrocini' => 500,
                'preuInscripció' => 20,
            ],
            [
                'nom' => 'Carrera de Ciclismo',
                'descripció' => 'Una desafiante carrera de ciclismo por el campo.',
                'desnivell' => 300,
                'imatgeMapa' => 'ruta-a-la-imagen-2.jpg',
                'maximParticipants' => 50,
                'habilitado' => true,
                'km' => 20,
                'data' => '2024-04-10',
                'hora' => '10:30:00',
                'puntSortida' => 'Parque Central',
                'cartellPromoció' => 'ruta-al-cartell-2.jpg',
                'preuAsseguradora' => 15,
                'preuPatrocini' => 600,
                'preuInscripció' => 25,
            ],
        ];
        // $carreras = Carrera::all();
        return view('admin.carreras.tablaCarreras', compact('carreras'));
    }
}
