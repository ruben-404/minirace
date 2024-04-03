<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\Corredor;
use App\Models\Inscrito;
use App\Models\Asseguradora;
use App\Models\CarreraAssegurada;
use Illuminate\Support\Facades\View;

class InscritoController extends Controller
{
    //PARTE NO VALIDADO

    public function inscribirUsuarioNoValidado(Request $request) {
        $request->validate([
            'dni' => 'required|string|max:255',
            'direccion' => 'required|string|max:50',
            'nombre' => 'required|string|max:50',
            'apellidos' => 'required|string|max:50',
            'genere' => 'required|string',
            'fechanacimiento' => 'required|date',
            'numerofederado' => 'nullable|string|max:50',
        ]);
        try{

            $dni = $request->input('dni');
            $idCarrera = $request->input('idCarrera');

            $existingCorredorInscrito = Inscrito::where('DNIcorredor', $dni)->where('idCarrera', $idCarrera)->first();

            if ($existingCorredorInscrito) {
                return redirect()->route('apuntarse.carrera.noAutenticado', ['idCarrera' => $request->input('idCarrera')])->withErrors(['dni' => 'Ya existe un corredor inscrito con este DNI']);
            }

            $formData = $request->all();
            
            if (!$request->filled('numerofederado')) {
                
                $carrerasAsseguradas = CarreraAssegurada::where('idCarrera', $idCarrera)->get();

                return view('principal.formularios.elegiraseguradora')->with('formData', $formData)->with('carrerasAsseguradas', $carrerasAsseguradas);
            
            } else {
                
                return view('principal.formularios.inscribirPRO')->with('formData', $formData);

            }
        } catch (\Exception $e) {
            // Manejar la excepción y proporcionar una respuesta adecuada
            return redirect()->back()->withInput()->with('error', $e->getMessage());
        }
    }

    public function mandarAseguracionesCarreraOpen(Request $request) {

        $formData = $request->all();
        return view('principal.formularios.inscribirOPEN')->with('formData', $formData); 

    }

    public function gestionarInscripcionNovalidadoOpen(Request $request) {
        //Si ya existe un corredor con ese DNI...
        $existingCorredor = Corredor::where('DNI', $request->input('dni'))->first();
        if(!$existingCorredor) {
            //Crear un nuevo corredor para poder inscribirlo
            $nuevoCorredor = new Corredor();
            $nuevoCorredor->DNI = $request->input('dni');
            $nuevoCorredor->password = 'notavailable';
            $nuevoCorredor->direccio = $request->input('direccion');
            $nuevoCorredor->nom = $request->input('nombre');
            $nuevoCorredor->cognoms = $request->input('apellidos');
            $nuevoCorredor->dataNaixement = $request->input('fechanacimiento');
            $nuevoCorredor->genere = $request->input('genere');
            $nuevoCorredor->numeroFederat = null;
            $nuevoCorredor->tipus = 'OPEN'; 
            $nuevoCorredor->soci = 0;
            $nuevoCorredor->punts = 0;
            // Guardar el nuevo corredor en la base de datos
            $nuevoCorredor->save();
        }
        else if($existingCorredor->tipus === 'PRO') {
            $existingCorredor->tipus = 'OPEN';
            $existingCorredor->numeroFederat = null;
            $existingCorredor->update();
        }
        $numDorsal = Inscrito::where('idCarrera', $request->input('idCarrera'))->max('numDorsal');
        $numDorsal = $numDorsal + 1;
        $nuevaInscripcion = new Inscrito();
        $nuevaInscripcion->DNIcorredor = $request->input('dni');
        $nuevaInscripcion->idCarrera = $request->input('idCarrera');
        $nuevaInscripcion->numDorsal = $numDorsal;
        $nuevaInscripcion->CIFasseguradora = $request->input('aseguradoraElegida');
        // Guardar la inscripcion del corredor en la base de datos
        $nuevaInscripcion->save();
        return  redirect()->route('infoCarrera', ['id' => $request->input('idCarrera')]);
    }

    public function gestionarInscripcionNovalidadoPro(Request $request) {
        //Si ya existe un corredor con ese DNI...
        $existingCorredor = Corredor::where('DNI', $request->input('dni'))->first();
        if(!$existingCorredor) {
            //Crear un nuevo corredor para poder inscribirlo
            $nuevoCorredor = new Corredor();
            $nuevoCorredor->DNI = $request->input('dni');
            $nuevoCorredor->password = 'notavailable';
            $nuevoCorredor->direccio = $request->input('direccion');
            $nuevoCorredor->nom = $request->input('nombre');
            $nuevoCorredor->cognoms = $request->input('apellidos');
            $nuevoCorredor->dataNaixement = $request->input('fechanacimiento');
            $nuevoCorredor->genere = $request->input('genere');
            $nuevoCorredor->numeroFederat = $request->input('numerofederado');
            $nuevoCorredor->tipus = 'PRO'; 
            $nuevoCorredor->soci = 0;
            $nuevoCorredor->punts = 0;
            // Guardar el nuevo corredor en la base de datos
            $nuevoCorredor->save();
        } else if($existingCorredor->tipus === 'OPEN') {
            $existingCorredor->tipus = 'PRO';
            $existingCorredor->numeroFederat = $request->input('numerofederado');
            $existingCorredor->update();
        }
        $numDorsal = Inscrito::where('idCarrera', $request->input('idCarrera'))->max('numDorsal');
        $numDorsal = $numDorsal + 1;
        $nuevaInscripcion = new Inscrito();
        $nuevaInscripcion->DNIcorredor = $request->input('dni');
        $nuevaInscripcion->idCarrera = $request->input('idCarrera');
        $nuevaInscripcion->numDorsal = $numDorsal;
        // Guardar la inscripcion del corredor en la base de datos
        $nuevaInscripcion->save();
        return  redirect()->route('infoCarrera', ['id' => $request->input('idCarrera')]);
    }
    

    //PARTE DE SOCIO REGISTRADO

    public function apuntraseCarreraValidado($id)
    {
        $user = auth()->user(); // Obtener el usuario autenticado
        $tipus = $user['tipus'];

        if ($tipus === 'PRO') {
            $dni = $user['DNI'];
            return view('principal.formularios.pagarCarreraPRO')->with('dni', $dni)->with('id', $id); // Redirigir a la vista de pagar carrera
        } else {
            $aseguradorasDisponibles = CarreraAssegurada::where('idCarrera', $id)->get();
            return view('principal.formularios.pagarAsseguradora')->with('aseguradorasDisponibles', $aseguradorasDisponibles)->with('id', $id);
        }
    }

    public function pagarCarreraOPEN(Request $request)
    {
        $user = auth()->user();
        $dni = $user['DNI'];
        $formData = $request->all();
        return view('principal.formularios.pagarCarreraOPEN')->with('formData', $formData)->with('dni', $dni);
    }
    public function gestionarInscripcionSocioOpen(Request $request) {
        $numDorsal = Inscrito::where('idCarrera', $request->input('idCarrera'))->max('numDorsal');
        $numDorsal = $numDorsal + 1;
        $nuevaInscripcion = new Inscrito();
        $nuevaInscripcion->DNIcorredor = $request->input('dni');
        $nuevaInscripcion->idCarrera = $request->input('idCarrera');
        $nuevaInscripcion->numDorsal = $numDorsal;
        $nuevaInscripcion->CIFasseguradora = $request->input('aseguradoraElegida');
        // Guardar la inscripcion del corredor en la base de datos
        $nuevaInscripcion->save();
        return  redirect()->route('infoCarrera', ['id' => $request->input('idCarrera')]);
    }
    public function gestionarInscripcionSocioPro(Request $request) {
        $numDorsal = Inscrito::where('idCarrera', $request->input('idCarrera'))->max('numDorsal');
        $numDorsal = $numDorsal + 1;
        $nuevaInscripcion = new Inscrito();
        $nuevaInscripcion->DNIcorredor = $request->input('dni');
        $nuevaInscripcion->idCarrera = $request->input('idCarrera');
        $nuevaInscripcion->numDorsal = $numDorsal;
        // Guardar la inscripcion del corredor en la base de datos
        $nuevaInscripcion->save();
        return  redirect()->route('infoCarrera', ['id' => $request->input('idCarrera')]);
    }
}
