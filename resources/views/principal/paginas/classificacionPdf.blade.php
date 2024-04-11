<?php

require_once base_path('vendor/autoload.php');

use Dompdf\Dompdf;
use Dompdf\Options;

// Creamos una nueva instancia de Dompdf
$options = new Options();
$options->set('isHtml5ParserEnabled', true);
$dompdf = new Dompdf($options);


// Creamos el contenido HTML para el PDF con estilos CSS y contenido dinámico
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
            color: #fff;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>Clasificación</h2>';

// Incluir la clasificación dinámica
if (isset($clasificacionParticipantes)) {
    foreach ($clasificacionParticipantes as $clave => $participantes) {
        $html .= '<div class="row">
                    <div class="col-md-12">
                        <h2>' . $clave . '</h2>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <table>
                            <thead>
                                <tr>
                                    <th>Nombre</th>
                                    <th>Tiempo</th>
                                </tr>
                            </thead>
                            <tbody>';
        foreach ($participantes as $participante) {
            $html .= '<tr>
                        <td>' . $participante->corredor->nom . '</td>
                        <td>' . $participante->temps . '</td>
                    </tr>';
        }
        $html .= '</tbody>
                        </table>
                    </div>
                </div>';
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
