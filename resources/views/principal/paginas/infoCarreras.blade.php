@include('principal.componentes.header')
@php
// Obtener la fecha actual
$fechaActual = date('Y-m-d');
echo($sponsors);

@endphp
<div class="container mt-5">
    <div class="row text-white contInfo">
        <h2>{{ $carrera->nom }}</h2>

        <div class="col-md-4">
            <img src="{{ asset('storage/carrerasImages/' . $carrera->cartellPromoció) }}" alt="Cartel de la carrera" class="img-fluid">
        </div>
        <div class="col-md-4 mx-auto descricioCont">
            <!-- Oculto en dispositivos móviles -->
            <p class="d-none d-md-block">{{ $carrera->descripció }}</p>
            <div class="mt-5">
                <div class="text-center">
                    @auth
                        <!-- Si el usuario está autenticado -->
                        @if ($estaInscrito)
                            <!-- Si el usuario ya está inscrito -->
                            <button type="button" class="btn btn-outline-primary" disabled>Ya estás inscrito</button>
                        @elseif ($carrera->data >= $fechaActual)
                            <!-- Si la carrera aún no ha pasado y no está llena -->
                            @if (!$llena)
                                <form action="{{ route('apuntarse.carrera', $carrera->idCarrera) }}">
                                    @csrf
                                    <button type="submit" class="btn btn-primary">Apuntarse a la carrera</button>
                                </form>
                            @else
                                <!-- Si la carrera está llena -->
                                <button type="button" class="btn btn-outline-primary" disabled>Carrera llena</button>
                            @endif
                        @else
                            <!-- Si la carrera ya ha pasado -->
                            <button type="button" class="btn btn-outline-primary" disabled>Apuntarse (Carrera pasada)</button>
                        @endif
                    @else
                        <!-- Si el usuario no está autenticado -->
                        @if ($carrera->data >= $fechaActual)
                            <!-- Si la carrera aún no ha pasado y no está llena -->
                            @if (!$llena)
                                <form action="{{ route('apuntarse.carrera.noAutenticado', $carrera->idCarrera) }}">
                                    @csrf
                                    <button type="submit" class="btn btn-primary">Apuntarse a la carrera</button>
                                </form>
                            @else
                                <!-- Si la carrera está llena -->
                                <button type="button" class="btn btn-outline-primary" disabled>Carrera llena</button>
                            @endif
                        @else
                            <!-- Si la carrera ya ha pasado -->
                            <button type="button" class="btn btn-outline-primary" disabled>Apuntarse (Carrera pasada)</button>
                        @endif
                    @endauth
                </div>
            </div>
            
            

        </div>

        
        <div class="accordion mt-5" id="accordionExample">
            <div class="accordion-item desplegableCont text-white">
                <h2 class="accordion-header" id="headingOne">
                    <button class="accordion-button collapsed desplegableInfo text-white" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="false" aria-controls="collapseOne">
                        Mapa
                    </button>
                </h2>
                <div id="collapseOne" class="accordion-collapse collapse desplegableInfo" aria-labelledby="headingOne" data-bs-parent="#accordionExample">
                    <div class="accordion-body text-white d-flex justify-content-center align-items-center">
                        <img src="{{ asset('storage/carrerasImages/' . $carrera->imatgeMapa) }}" alt="Mapa de la carrera" class="img-fluid imgMapaInfo">
                    </div>
                </div>
            </div>
            <div class="accordion-item desplegableCont">
                <h2 class="accordion-header" id="headingTwo">
                    <button class="accordion-button collapsed desplegableInfo text-white" type="button" data-bs-toggle="collapse" data-bs-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                        Desnivel
                    </button>
                </h2>
                <div id="collapseTwo" class="accordion-collapse collapse desplegableInfo" aria-labelledby="headingTwo" data-bs-parent="#accordionExample">
                    <div class="accordion-body text-white">
                        <p>{{ $carrera->desnivell }}</p>

                    </div>
                </div>
            </div>
            <div class="accordion-item desplegableCont">
                <h2 class="accordion-header" id="headingThree">
                    <button class="accordion-button collapsed desplegableInfo text-white" type="button" data-bs-toggle="collapse" data-bs-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                        Horario
                    </button>
                </h2>
                <div id="collapseThree" class="accordion-collapse collapse desplegableInfo" aria-labelledby="headingThree" data-bs-parent="#accordionExample">
                    <div class="accordion-body text-white">
                        <p>Hora: {{ $carrera->hora }}</p>
                        <p>Fecha: {{ \Carbon\Carbon::parse($carrera->data)->format('d/m/Y') }}</p>


                    </div>
                </div>
            </div>
            <!-- Visible solo en dispositivos móviles -->
            <div class="accordion-item desplegableCont d-block d-md-none">
                <h2 class="accordion-header" id="headingDescription">
                    <button class="accordion-button collapsed desplegableInfo text-white" type="button" data-bs-toggle="collapse" data-bs-target="#collapseDescription" aria-expanded="false" aria-controls="collapseDescription">
                        Descripción
                    </button>
                </h2>
                <div id="collapseDescription" class="accordion-collapse collapse desplegableInfo" aria-labelledby="headingDescription" data-bs-parent="#accordionExample">
                    <div class="accordion-body text-white">
                        <p>{{ $carrera->descripció }}</p>
                    </div>
                </div>
            </div>
        </div>
        @if(strtotime($carrera->data) < strtotime(now()))

            @include('principal.componentes.carrusel')

            <div class="container">
            @if(isset($registrosTerminados) && count($registrosTerminados) > 0)
            <div class="row">
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
                        <tbody>
                            @foreach($registrosTerminados as $registro)
                                <tr class="text-white">
                                    <td class="text-white">{{ $registro->corredor->nom }}</td>
                                    <td class="text-white">{{ $registro->temps }}</td>
                                    @php
                                        $horaCarrera = new DateTime($carrera->hora);
                                        $tiempoParticipante = new DateTime($registro->temps);
                                        $diferencia = $horaCarrera->diff($tiempoParticipante);
                                        $tiempoLlegada = $diferencia->format('%H:%I:%S');
                                    @endphp
                                    <td class="text-white">{{ $tiempoLlegada }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        @endif

                @if(isset($clasificacionParticipantes) && count($clasificacionParticipantes) > 0)
                    @foreach($clasificacionParticipantes as $clave => $participantes)
                        @if(count($participantes) > 0)
                            <div class="row">
                                <div class="col-md-12">
                                    <h2 class="text-white">Master {{ $clave }}</h2>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <table class="table table-striped">
                                        <thead>
                                            <tr class="text-white">
                                                <th>Nombre</th>
                                                <th>Hora de Llegada</th>
                                                <th>Tiempo de Llegada</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach($participantes as $participante)
                                            <tr>
                                                <td class="text-white">{{ $participante->corredor->nom }}</td>
                                                <td class="text-white">{{ $participante->temps }}</td>
                                                @php
                                                    $horaCarrera = new DateTime($carrera->hora);
                                                    $tiempoParticipante = new DateTime($participante->temps);

                                                    $diferencia = $horaCarrera->diff($tiempoParticipante);
                                                    $tiempoLlegada = $diferencia->format('%H:%I:%S');
                                                @endphp
                                                <td class="text-white">{{ $tiempoLlegada }}</td>
                                            </tr>
                                        @endforeach

                                        </tbody>
                                    </table>
                                </div>
                            </div>
                          
                            
                        @endif
                    @endforeach
                    <div class="container mt-5">
                        <div class="row text-white contInfo">
                            <!-- Otras partes del contenido -->
                    
                            <!-- Condición para mostrar el botón si hay registros terminados o clasificación de participantes -->
                            @if(!empty($registrosTerminados) || !empty($clasificacionParticipantes))
                            <div class="col-md-12">
                                <a href="{{ route('generar.pdf.clasificacion', ['idCarrera' => $carrera->idCarrera]) }}" class="btn btn-primary">Generar Clasificación en PDF</a>
                            </div>
                            @endif
                        </div>
                    </div>
                    
                    

                @else
                    <div class="row">
                        <div class="col-md-12">
                            <p class="text-white">No hay registros disponibles.</p>
                        </div>
                    </div>
                @endif



            

        @else
            
        @endif

    </div>
    @if(!$sponsors->isEmpty())
        <h2 class="mt-5">Sponsors</h2>
    @endif

    <div class="container mt-5">
        <div class="row">
            @foreach($sponsors as $sponsor)
            <div class="col-md-3 mb-3">
                <div class="card">
                    <img src="{{ asset('storage/sponsorsImages/' . $sponsor->logo) }}" class="card-img-top" alt="Logo del sponsor">
                    <div class="card-body">
                        <h5 class="card-title text-black">{{ $sponsor->nom }}</h5>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</div>

@include('principal.componentes.footer')
