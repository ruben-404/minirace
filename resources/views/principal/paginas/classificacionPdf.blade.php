<?php

require_once base_path('vendor/autoload.php');

use Dompdf\Dompdf;
use Dompdf\Options;



$options = new Options();
$options->set('isHtml5ParserEnabled', true);
$dompdf = new Dompdf($options);
$html = '<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Clasificación</title>
    <!-- Estilos CSS -->
    <style>
        body {
            font-family: Arial, sans-serif;
        }
        .container {
            margin: 20px;
        }
        h2 {
            color: #333;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }
        th, td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
        }
        th {
            background-color: #f2f2f2;
        }
        .text-white {
            color: #000000;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>Clasificación</h2>';

// Incluir la clasificación general si hay registros terminados
if ($registrosTerminados->isNotEmpty()) {
    $html .= '<div class="row">
                <div class="col-md-12">
                    <h2 class="text-white">Clasificación General</h2>
                    <table class="table table-striped">
                        <thead>
                            <tr class="text-white">
                                <th>Nombre</th>
                                <th>Hora de Llegada</th>
                                <th>Tiempo de Llegada</th>
                            </tr>
                        </thead>
                        <tbody>';

    foreach ($registrosTerminados as $registro) {
        // Calcular la hora de llegada
        $horaCarrera = new DateTime($carrera->hora);
        $tiempoParticipante = new DateTime($registro->temps);
        $diferencia = $horaCarrera->diff($tiempoParticipante);
        $tiempoLlegada = $diferencia->format('%H:%I:%S');

        $html .= '<tr class="text-white">
                    <td>' . $registro->corredor->nom . '</td>
                    <td>' . $registro->temps . '</td>
                    <td>' . $tiempoLlegada . '</td>
                </tr>';
    }

    $html .= '</tbody>
        </table>
    </div>
</div>';
}

// Incluir la clasificación dinámica
if (isset($clasificacionParticipantes)) {
    foreach ($clasificacionParticipantes as $clave => $participantes) {
        if (count($participantes) > 0) {
            $html .= '<div class="row">
                        <div class="col-md-12">
                            <h2>Master ' . $clave . '</h2>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <table>
                                <thead>
                                    <tr>
                                        <th>Nombre</th>
                                        <th>Tiempo</th>
                                        <th>Tiempo de Llegada</th>
                                    </tr>
                                </thead>
                                <tbody>';
            foreach ($participantes as $participante) {
                // Calcular la hora de llegada
                $horaCarrera = new DateTime($carrera->hora);
                $tiempoParticipante = new DateTime($participante->temps);
                $diferencia = $horaCarrera->diff($tiempoParticipante);
                $tiempoLlegada = $diferencia->format('%H:%I:%S');

                $html .= '<tr>
                            <td>' . $participante->corredor->nom . '</td>
                            <td>' . $participante->temps . '</td>
                            <td>' . $tiempoLlegada . '</td>
                        </tr>';
            }
            $html .= '</tbody>
                            </table>
                        </div>
                    </div>';
        }
    }
}

$html .= '</div>
</body>
</html>';

// Cargamos el contenido HTML en Dompdf
$dompdf->loadHtml($html);

// Renderizamos el PDF
$dompdf->render();

// Generamos el PDF
$dompdf->stream('clasificacion.pdf', [
    'Attachment' => false
]);
