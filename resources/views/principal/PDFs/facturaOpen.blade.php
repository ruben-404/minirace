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
        </style>';

$html .= '<h1>Factura inscripción</h1>';
$html .= '<table class="table">';
$html .= '<tbody>';
$html .= '<tr>';
$html .= '<th>Precio de carrera (20% de descuento)</th>';
$html .= '<td>' . $precios['carrera'] * 0.8 . ' €</td>';
$html .= '<th>Precio de aseguradora</th>';
$html .= '<td>' . $precios['aseguradora'] . ' €</td>';
$html .= '</tr>';
$precioTotal = ($precios['carrera'] * 0.8) + $precios['aseguradora'];
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
