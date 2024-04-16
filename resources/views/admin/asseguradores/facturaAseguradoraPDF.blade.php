<?php

// Incluimos el autoload de Composer
require_once base_path('vendor/autoload.php');

use Dompdf\Dompdf;
use Dompdf\Options;

// Creamos una nueva instancia de Dompdf
$options = new Options();
$options->set('isHtml5ParserEnabled', true);
$dompdf = new Dompdf($options);

// Creamos el contenido HTML para el PDF con estilos CSS
$html = '<style>
            .table {
                width: 100%;
                border-collapse: collapse;
            }
            .table th, .table td {
                border: 1px solid #999;
                padding: 8px;
                text-align: center; /* Centra el contenido de las celdas */
            }
            .table th {
                background-color: #f2f2f2;
                color: #333;
            }
            .table tr:nth-child(even) td {
                background-color: #f9f9f9;
            }
            .table tr:nth-child(odd) td {
                background-color: #e6e6e6;
            }
            .datos {
                margin-top: 20px;
                margin-bottom: 20px;
                padding: 10px;
                border-radius: 5px;
                margin-right: 20px;
            }
        </style>';

$html .= '<h1>Factura aseguradora ' . $cif .'</h1>';
$html .= '<div class="datos">';
$html .= '<h2>'. $empresa->nom .'</h2>'; 
$html .= '<p>'. $empresa->CIF .'</p>'; 
$html .= '<p>'. $empresa->email .'</p>'; 
$html .= '<p>'. $empresa->direccion .'</p>'; 
$html .= '</div>';
$html .= '<table class="table">';
$html .= '<thead>';
$html .= '<tr>';
$html .= '<th>ID carrera</th>';
$html .= '<th>Nombre carrera</th>';
$html .= '<th>Precio</th>';
$html .= '</tr>';
$html .= '</thead>';
$html .= '<tbody>';
$precioTotal = 0;
foreach ($carreras as $carrera) {
    //$inscrito = json_decode($inscrito); // Decodificamos el JSON
    $html .= '<tr>';
    $html .= '<td>' . $carrera->idCarrera . '</td>';
    $html .= '<td>' . $carrera->nom . '</td>';
    $html .= '<td>' . $carrera->preuAsseguradora . '€</td>';
    $html .= '</tr>';
    $precioTotal += $carrera->preuAsseguradora;
}
$html .= '</tbody>';
$html .= '</table>';
$html .= '<h2>Precio total: ' . $precioTotal . '€</h2>';

// Cargamos el contenido HTML en Dompdf
$dompdf->loadHtml($html);

// Renderizamos el PDF
$dompdf->render();

// Generamos el PDF
$dompdf->stream('lista_personas.pdf', [
    'Attachment' => false
]);
