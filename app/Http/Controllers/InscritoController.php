<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\Carrera;
use App\Models\Corredor;
use App\Models\Inscrito;
use App\Models\Asseguradora;
use App\Models\CarreraAssegurada;
use Illuminate\Support\Facades\View;
use SimpleSoftwareIO\QrCode\Facades\QrCode;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;


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


    public function guardarTiempo($idCarrera, $idCorredor)
    {
        // Obtener el registro de inscripción
        $inscripcion = Inscrito::where('idCarrera', $idCarrera)
                                ->where('DNIcorredor', $idCorredor)
                                ->firstOrFail();

        // Obtener el sexo y la fecha de nacimiento del corredor
        $corredor = Corredor::findOrFail($idCorredor);
        $sexo = $corredor->genere;
        $fechaNacimiento = $corredor->dataNaixement;

        // Calcular la edad del corredor
        $edad = Carbon::parse($fechaNacimiento)->age;

        // Definir el rango de edad del corredor actual
        $rangoEdad = '';
        if ($edad >= 20 && $edad <= 29) {
            $rangoEdad = '20-29';
        } elseif ($edad >= 30 && $edad <= 39) {
            $rangoEdad = '30-39';
        } elseif ($edad >= 40 && $edad <= 49) {
            $rangoEdad = '40-49';
        } elseif ($edad >= 50 && $edad <= 59) {
            $rangoEdad = '50-59';
        } elseif ($edad >= 60) {
            $rangoEdad = '60-99';
        }

        // Consulta para obtener los corredores filtrados
        $corredoresFiltrados = Inscrito::where('idCarrera', $idCarrera)
                                        ->whereNotNull('temps')
                                        ->whereHas('corredor', function ($query) use ($sexo) {
                                            $query->where('genere', $sexo);
                                        })
                                        ->get();
        
        $corredoresReales = [];

        foreach ($corredoresFiltrados as $corredorFiltrado) {
            // Obtener la fecha de nacimiento del corredor filtrado
            $fechaNacimientoFiltrado = $corredorFiltrado->corredor->dataNaixement;
            
            // Calcular la edad del corredor filtrado
            $edadFiltrado = Carbon::parse($fechaNacimientoFiltrado)->age;
        
            // Definir el rango de edad del corredor filtrado
            $rangoEdadFiltrado = '';
            if ($edadFiltrado >= 20 && $edadFiltrado <= 29) {
                $rangoEdadFiltrado = '20-29';
            } elseif ($edadFiltrado >= 30 && $edadFiltrado <= 39) {
                $rangoEdadFiltrado = '30-39';
            } elseif ($edadFiltrado >= 40 && $edadFiltrado <= 49) {
                $rangoEdadFiltrado = '40-49';
            } elseif ($edadFiltrado >= 50 && $edadFiltrado <= 59) {
                $rangoEdadFiltrado = '50-59';
            } elseif ($edadFiltrado >= 60) {
                $rangoEdadFiltrado = '60-99';
            }
        
            // Si el rango de edad del corredor filtrado coincide con el del corredor original, agregarlo a corredoresReales
            if ($rangoEdadFiltrado === $rangoEdad) {
                $corredoresReales[] = $corredorFiltrado;
            }
        }

        // Calcular los puntos según la posición
        $corredoresReales = collect($corredoresReales);

        $puntos = 0;
        if ($corredoresReales->isEmpty()) {
            $puntos = 1000; // Primer lugar
        } else {
            $posicion = $corredoresReales->count() + 1; // Posición del corredor actual
            if ($posicion < 10) {
                $puntos = 1000 - (($posicion - 1) * 100); // Restar los puntos según la posición
            }
        }

        // Actualizar los puntos del corredor
        $corredor->increment('punts', $puntos);


        // Actualizar el campo de tiempo con la hora actual
        $inscripcion->update(['temps' => Carbon::now()]);

        // Imprimir un mensaje de confirmación
        return "El tiempo ha sido guardado y se han asignado $puntos puntos para el corredor con DNI $idCorredor y la carrera con ID $idCarrera.";
    }



    public function clasificarParticipantesPorEdadGenero($idCarrera)
{
    // Obtener todos los participantes de la carrera con registros en el campo temps
    $participantes = Inscrito::where('idCarrera', $idCarrera)
                                ->whereNotNull('temps')
                                ->with('corredor')
                                ->get();

    // Inicializar arrays para cada combinación de rango de edad y género
    $clasificacion = [
        '20-29-H' => [],
        '20-29-M' => [],
        '30-39-H' => [],
        '30-39-M' => [],
        '40-49-H' => [],
        '40-49-M' => [],
        '50-59-H' => [],
        '50-59-M' => [],
        '60-99-H' => [],
        '60-99-M' => [],
    ];

    // Clasificar participantes por rango de edad y género
    foreach ($participantes as $participante) {
        $fechaNacimiento = $participante->corredor->dataNaixement;
        $edad = Carbon::parse($fechaNacimiento)->age;

        // Determinar el rango de edad del participante
        if ($edad >= 20 && $edad <= 29) {
            $rangoEdad = '20-29';
        } elseif ($edad >= 30 && $edad <= 39) {
            $rangoEdad = '30-39';
        } elseif ($edad >= 40 && $edad <= 49) {
            $rangoEdad = '40-49';
        } elseif ($edad >= 50 && $edad <= 59) {
            $rangoEdad = '50-59';
        } else {
            $rangoEdad = '60-99';
        }

        // Determinar el género del participante
        $genero = $participante->corredor->genere;

        // Agregar al array correspondiente
        $claveArray = $rangoEdad . '-' . $genero;
        $clasificacion[$claveArray][] = $participante;
    }
    // dd($clasificacion);
    return $clasificacion;
}

//FUNCIONES PARA INSCRIPCIONES DE NO VALIDADO OPEN
    
public function getOpenNovalidadoPrice(Request $request) {
        
    $idRace = $request->input('idCarrera');
    $carrera = Carrera::where('idCarrera', intval($idRace))->first();
    if($carrera) {
        $preuInscripcio = $carrera->preuInscripció;
    }

    $CIFaseg = $request->input('CIFaseguradora');
    $aseguradora = Asseguradora::where('CIF', $CIFaseg)->first();
    if($aseguradora) {
        $preuAseguradora = $aseguradora->preuCursa;
    }

    $preuFinal = $preuAseguradora + $preuInscripcio;

    return response()->json(['price' => $preuFinal]);
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
    $maxDorsal = Inscrito::join('corredors', 'inscritos.DNIcorredor', '=', 'corredors.DNI')
        ->where('corredors.tipus', 'OPEN')
        ->where('inscritos.idCarrera', $request->input('idCarrera'))
        ->max('inscritos.numDorsal');
    if ($maxDorsal === null) {
        $carrera = Carrera::findOrFail($request->input('idCarrera'));
        $numDorsal = $carrera->maximParticipants + 1;
    } else {
        $numDorsal = $maxDorsal + 1;
    }
    $nuevaInscripcion = new Inscrito();
    $nuevaInscripcion->DNIcorredor = $request->input('dni');
    $nuevaInscripcion->idCarrera = $request->input('idCarrera');
    $nuevaInscripcion->numDorsal = $numDorsal;
    $nuevaInscripcion->CIFasseguradora = $request->input('aseguradoraElegida');
    // Guardar la inscripcion del corredor en la base de datos
    $nuevaInscripcion->save(); 
    $datos = [
        'idCarrera' => $request->input('idCarrera'),
        'CIFaseguradora' => $request->input('aseguradoraElegida')
    ];
    return view('principal/paginas/successOpenNovalidado', ['datos' => $datos]);
}
public function generarFacturaNovalidadoOpen(Request $request) {
    $idCarrera = $request->query('idCarrera');
    $CIFaseguradora = $request->query('CIFaseguradora');

    $idCarrera = $request->input('idCarrera');
    $carrera = Carrera::where('idCarrera', intval($idCarrera))->first();
    if($carrera) {
        $preuInscripcio = $carrera->preuInscripció;
    }

    $CIFaseguradora = $request->input('CIFaseguradora');
    $aseguradora = Asseguradora::where('CIF', $CIFaseguradora)->first();
    if($aseguradora) {
        $preuAseguradora = $aseguradora->preuCursa;
    }
    $precios = [
        'carrera' => $preuInscripcio,
        'aseguradora' => $preuAseguradora
    ];
    return view('principal/PDFs/facturaOpenNovalidado', ['precios' => $precios]);
}

//FUNCIONES PARA INSCRIPCIONES DE NO VALIDADO PRO

    public function getProNovalidadoPrice(Request $request) {
            
        $idRace = $request->input('idCarrera');
        $carrera = Carrera::where('idCarrera', intval($idRace))->first();
        if($carrera) {
            $preuInscripcio = $carrera->preuInscripció;
        }

        $preuFinal = $preuInscripcio;

        return response()->json(['price' => $preuFinal]);
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
        $maxDorsal = Inscrito::join('corredors', 'inscritos.DNIcorredor', '=', 'corredors.DNI')
            ->where('corredors.tipus', 'PRO')
            ->where('inscritos.idCarrera', $request->input('idCarrera'))
            ->max('inscritos.numDorsal');
        if ($maxDorsal === null) {
            $numDorsal = 1;
        } else {
            $numDorsal = $maxDorsal + 1;
        }
        $nuevaInscripcion = new Inscrito();
        $nuevaInscripcion->DNIcorredor = $request->input('dni');
        $nuevaInscripcion->idCarrera = $request->input('idCarrera');
        $nuevaInscripcion->numDorsal = $numDorsal;
        // Guardar la inscripcion del corredor en la base de datos
        $nuevaInscripcion->save();
        $datos = [
            'idCarrera' => $request->input('idCarrera')
        ];
        return view('principal/paginas/successProNovalidado', ['datos' => $datos]);
    }
    public function generarFacturaNovalidadoPro(Request $request) {
        $idCarrera = $request->query('idCarrera');

        $idCarrera = $request->input('idCarrera');
        $carrera = Carrera::where('idCarrera', intval($idCarrera))->first();
        if($carrera) {
            $preuInscripcio = $carrera->preuInscripció;
        }

        $precios = [
            'carrera' => $preuInscripcio
        ];

        return view('principal/PDFs/facturaProNovalidado', ['precios' => $precios]);
    }
    


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
    

//FUNCIONES PARA INSCRIPCIONES DE SOCIO VALIDADO OPEN

    public function getOpenPrice(Request $request) {
            
        $idRace = $request->input('idCarrera');
        $carrera = Carrera::where('idCarrera', intval($idRace))->first();
        if($carrera) {
            $preuInscripcio = $carrera->preuInscripció;
            $preuInscripcio = $preuInscripcio * 0.8;
        }

        $CIFaseg = $request->input('CIFaseguradora');
        $aseguradora = Asseguradora::where('CIF', $CIFaseg)->first();
        if($aseguradora) {
            $preuAseguradora = $aseguradora->preuCursa;
        }

        $preuFinal = $preuAseguradora + $preuInscripcio;

        return response()->json(['price' => $preuFinal]);
    }
    public function pagarCarreraOPEN(Request $request)
    {
        $user = auth()->user();
        $dni = $user['DNI'];
        $formData = $request->all();
        return view('principal.formularios.pagarCarreraOPEN')->with('formData', $formData)->with('dni', $dni);
    }

    public function gestionarInscripcionSocioOpen(Request $request) {
        $maxDorsal = Inscrito::join('corredors', 'inscritos.DNIcorredor', '=', 'corredors.DNI')
            ->where('corredors.tipus', 'OPEN')
            ->where('inscritos.idCarrera', $request->input('idCarrera'))
            ->max('inscritos.numDorsal');
        if ($maxDorsal === null) {
            $carrera = Carrera::findOrFail($request->input('idCarrera'));
            $numDorsal = $carrera->maximParticipants + 1;
        } else {
            $numDorsal = $maxDorsal + 1;
        }
        $nuevaInscripcion = new Inscrito();
        $nuevaInscripcion->DNIcorredor = $request->input('dni');
        $nuevaInscripcion->idCarrera = $request->input('idCarrera');
        $nuevaInscripcion->numDorsal = $numDorsal;
        $nuevaInscripcion->CIFasseguradora = $request->input('aseguradoraElegida');
        // Guardar la inscripcion del corredor en la base de datos
        $nuevaInscripcion->save();
        $datos = [
            'idCarrera' => $request->input('idCarrera'),
            'CIFaseguradora' => $request->input('aseguradoraElegida')
        ];
        return view('principal/paginas/successOpen', ['datos' => $datos]);
    }
    public function generarFacturaOpen(Request $request) {
        $idCarrera = $request->query('idCarrera');
        $CIFaseguradora = $request->query('CIFaseguradora');

        $idCarrera = $request->input('idCarrera');
        $carrera = Carrera::where('idCarrera', intval($idCarrera))->first();
        if($carrera) {
            $preuInscripcio = $carrera->preuInscripció;
        }

        $CIFaseguradora = $request->input('CIFaseguradora');
        $aseguradora = Asseguradora::where('CIF', $CIFaseguradora)->first();
        if($aseguradora) {
            $preuAseguradora = $aseguradora->preuCursa;
        }
        $precios = [
            'carrera' => $preuInscripcio,
            'aseguradora' => $preuAseguradora
        ];
        return view('principal/PDFs/facturaOpen', ['precios' => $precios]);
    }

//FUNCIONES PARA INSCRIPCIONES DE SOCIO VALIDADO PRO


    public function getProPrice(Request $request) {
                
        $idRace = $request->input('idCarrera');
        $carrera = Carrera::where('idCarrera', intval($idRace))->first();
        if($carrera) {
            $preuInscripcio = $carrera->preuInscripció;
            $preuInscripcio = $preuInscripcio * 0.8;
        }

        $preuFinal = $preuInscripcio;

        return response()->json(['price' => $preuFinal]);
    }
    public function gestionarInscripcionSocioPro(Request $request) {
        $maxDorsal = Inscrito::join('corredors', 'inscritos.DNIcorredor', '=', 'corredors.DNI')
            ->where('corredors.tipus', 'PRO')
            ->where('inscritos.idCarrera', $request->input('idCarrera'))
            ->max('inscritos.numDorsal');
        if ($maxDorsal === null) {
            $numDorsal = 1;
        } else {
            $numDorsal = $maxDorsal + 1;
        }
        $nuevaInscripcion = new Inscrito();
        $nuevaInscripcion->DNIcorredor = $request->input('dni');
        $nuevaInscripcion->idCarrera = $request->input('idCarrera');
        $nuevaInscripcion->numDorsal = $numDorsal;
        // Guardar la inscripcion del corredor en la base de datos
        $nuevaInscripcion->save();
        $datos = [
            'idCarrera' => $request->input('idCarrera')
        ];
        return view('principal/paginas/successPro', ['datos' => $datos]);
    }
    public function generarFacturaPro(Request $request) {
        $idCarrera = $request->query('idCarrera');

        $idCarrera = $request->input('idCarrera');
        $carrera = Carrera::where('idCarrera', intval($idCarrera))->first();
        if($carrera) {
            $preuInscripcio = $carrera->preuInscripció;
        }

        $precios = [
            'carrera' => $preuInscripcio
        ];

        return view('principal/PDFs/facturaPro', ['precios' => $precios]);
    }

    function generarClasificacionPDF($idCarrera) {
        // Obtener la carrera por su ID
        $carrera = Carrera::find($idCarrera);
        
        if (!$carrera) {
            // Manejar el caso donde no se encuentra la carrera con el ID proporcionado
            return response()->json(['error' => 'Carrera no encontrada'], 404);
        }
        
        // Crear una instancia del controlador de Inscrito
        $inscritoController = new InscritoController();
    
        // Obtener la clasificación de participantes por edad y género
        $clasificacionParticipantes = $inscritoController->clasificarParticipantesPorEdadGenero($idCarrera);

        $registrosTerminados = $carrera->inscritos()
        ->whereNotNull('temps')
        ->with('corredor') // Cargar la relación con el corredor
        ->get();
    
        // Pasar los datos de clasificación a la vista junto con la carrera
        return view('principal.paginas.classificacionPdf', compact('carrera', 'clasificacionParticipantes','registrosTerminados'));
    }
    
    
}
