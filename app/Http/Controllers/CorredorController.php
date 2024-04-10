<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\Corredor;
use App\Models\Carrera;
use App\Models\Inscrito;

use Dompdf\Dompdf;
use Dompdf\Options;
use SimpleSoftwareIO\QrCode\Facades\QrCode;



class CorredorController extends Controller
{
    public function paginaCarreras()
    {
        return view('principal.paginas.paginaCarreras');
    }

    // SECCIÓN LOGIN

    public function paginaLogin()
    {
        return view('principal.formularios.login');
    }

    public function logOut(Request $request) {
        
        $request->session()->flush();

        return redirect('/home/login');
    }

    public function ProcesarLogin(Request $request) {
        $credentials = [
            "DNI" => $request->DNI,
            "password" => $request->password
        ];

        if (Auth::guard('web')->attempt($credentials)) {

            $request->session()->put('DNI', $credentials['DNI']);

            return redirect('/');

        } else {

            return redirect('/home/login');

        }

    }

    // SECCION REGISTER
    public function paginaRegister()
    {
        return view('principal.formularios.register');
    }

    public function procesarRegistro(Request $request) {
        $request->validate([
            'dni' => 'required|string|max:255',
            'password' => 'required|string|max:50',
            'direccion' => 'required|string|max:50',
            'nombre' => 'required|string|max:50',
            'apellidos' => 'required|string|max:50',
            'genere' => 'required|string',
            'fechanacimiento' => 'required|date',
            'numerofederado' => 'nullable|string|max:50',
        ]);
        try{
            $dni = $request->input('dni');

            $existingCorredor = Corredor::where('dni', $dni)->first();

            if ($existingCorredor) {
                return redirect()->back()->withInput()->withErrors(['dni' => 'Ya existe un corredor con este DNI']);
            }
            $nuevoCorredor = new Corredor();
            $nuevoCorredor->DNI = $dni;
            $nuevoCorredor->password = Hash::make($request->password);
            $nuevoCorredor->direccio = $request->input('direccion');
            $nuevoCorredor->nom = $request->input('nombre');
            $nuevoCorredor->cognoms = $request->input('apellidos');
            $nuevoCorredor->dataNaixement = $request->input('fechanacimiento');

            if ($request->filled('numerofederado')) {
                $nuevoCorredor->numeroFederat = $request->input('numerofederado');
                $nuevoCorredor->tipus = 'PRO';
            } else {
                $nuevoCorredor->numeroFederat = null;
                $nuevoCorredor->tipus = 'OPEN';
            }

            $nuevoCorredor->genere = $request->input('genere');
            $nuevoCorredor->soci = 1;
            $nuevoCorredor->punts = 0;

            // Guardar el nuevo corredor en la base de datos
            $nuevoCorredor->save();

            // Redirigir a la página de lista de aseguradoras u otra página según sea necesario
            return redirect('/home/login')->with('success', 'Socio registrado correctamente.');
        } catch (\Exception $e) {
            // Manejar la excepción y proporcionar una respuesta adecuada
            return redirect()->back()->withInput()->with('error', $e->getMessage());
        }


    }

    
    
    public function generarPDFConQR($idCarrera, $idCorredor, $numDorsal)
    {
        // Obtener la información necesaria para generar el QR
        $corredor = Corredor::findOrFail($idCorredor);
        $carrera = Carrera::findOrFail($idCarrera);
    
        // Crear los datos para el código QR
        // $qrData = "Nombre: " . $idCorredor . ", Carrera: " . $idCarrera;
        $url = route('inscrito.guardar.tiempo', ['idCarrera' => $idCarrera, 'idCorredor' => $idCorredor]);
        $qrData = "URL: " . $url;

    
        // Generar el código QR como un objeto QrCode
        $qrCode = QrCode::size(300)->generate($qrData);
    
        // Generar el contenido HTML para el PDF con el QR en el medio
        $html = '<h1 style="text-align: center;">' . $carrera->nom . '</h1>';
        $html .= '<h1 style="text-align: center;">' . $numDorsal . '</h1>';

        $html .= '<div style="text-align: center;">';
        $html .= '<img src="data:image/png;base64,' . base64_encode($qrCode) . '" alt="QR Code">';
        $html .= '</div>';


        $html .= '<h1 style="text-align: center;">' . $corredor->nom . ' ' . $corredor->cognoms . '</h1>';
        


        // Configurar Dompdf
        $options = new Options();
        $options->set('isHtml5ParserEnabled', true);
        $dompdf = new Dompdf($options);
    
        // Cargar el contenido HTML en Dompdf
        $dompdf->loadHtml($html);
    
        // Renderizar el PDF
        $dompdf->render();
    
        // Devolver el PDF generado
        return $dompdf->stream('qr_corredor.pdf');
    }


    public function generarPDFConQRParaTodos($idCarrera)
{
    // Obtener todos los inscritos para la carrera
    $inscritos = Inscrito::where('idCarrera', $idCarrera)->get();

    // Configurar Dompdf
    $options = new Options();
    $options->set('isHtml5ParserEnabled', true);
    $dompdf = new Dompdf($options);

    // Inicializar el contenido HTML del PDF
    $html = '';

    // Iterar sobre cada inscrito
    foreach ($inscritos as $inscrito) {
        // Obtener información del corredor y la carrera
        $corredor = Corredor::findOrFail($inscrito->DNIcorredor);
        $carrera = Carrera::findOrFail($idCarrera);

        // Crear la URL para el inscrito
        $url = route('inscrito.guardar.tiempo', ['idCarrera' => $idCarrera, 'idCorredor' => $inscrito->DNIcorredor]);
        
        // Crear el código QR para la URL
        $qrCode = QrCode::size(300)->generate($url);

        // Agregar la información del inscrito al HTML
        $html .= '<h1 style="text-align: center;">' . $carrera->nom . '</h1>';
        $html .= '<h1 style="text-align: center;">' . $inscrito->numDorsal . '</h1>';
        $html .= '<div style="text-align: center;">';
        $html .= '<img src="data:image/png;base64,' . base64_encode($qrCode) . '" alt="QR Code">';
        $html .= '</div>';
        $html .= '<h1 style="text-align: center;">' . $corredor->nom . ' ' . $corredor->cognoms . '</h1>';

        // Agregar un salto de página HTML después de cada inscrito
        $html .= '<div style="page-break-after: always;"></div>';
    }

    // Cargar el contenido HTML en Dompdf
    $dompdf->loadHtml($html);

    // Renderizar el PDF
    $dompdf->render();

    // Devolver el PDF generado
    return $dompdf->stream('qr_corredores.pdf');
}

    
   
    
}
