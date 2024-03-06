@include('layouts.adminHeader')
<script src="{{ asset('js/carreras.js') }}"></script>

<div class="container mt-4 flex-row">
    <div class="flex-column bg-dark align-self-start mb-30 justify-content-end vertical-buttons">
        <div class="mb-30">
            <div class="btn-group-vertical">
                <a href="{{ route('carreras') }}" class="btn-link mb-2">Carreras</a>
                <a href="{{ route('sponsors') }}" class="btn-link mb-2">Sponsors</a>
                <a href="#" class="btn-link mb-2">Sponsors</a>
            </div>
        </div>
    </div>

    <div class="row mr-5 carrerasTable">
        <div class="col">
        <div class="d-flex justify-content-between titulo">
            <h2>Carreras</h2>
            <form method="GET" action="{{ route('addCarreras') }}">
                @csrf
                <button id="btn-add" type="submit" class="btn btn-primary btn-lg rounded-circle">
                    <i class="fas fa-plus"></i>
                </button>
            </form>
        </div>


            <div class="tbodyCont" style="max-height: 700px; overflow-y: auto;">
                <table class="table">
                    <thead>
                        <tr class="table-row">
                            <th>ID</th>
                            <th>Nombre</th>
                            <th>Máximo Participantes</th>
                            <th>Fecha</th>
                            <th>Hora</th>
                            <th>Precio Aseguradora</th>
                            <th>Precio Patrocinio</th>
                            <th>Precio Inscripción</th>
                            <th>Habilitado</th>
                            <th colspan="2" class="text-center">Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($carreras as $carrera)
                        <tr>
                        <td class="text-center align-middle">{{ $carrera->idCarrera }}</td>
                        <td class="text-center align-middle">{{ $carrera->nom }}</td>
                        <td class="text-center align-middle">{{ $carrera->maximParticipants }}</td>
                        <td class="text-center align-middle">{{ $carrera->data }}</td>
                        <td class="text-center align-middle">{{ $carrera->hora }}</td>
                        <td class="text-center align-middle">{{ $carrera->preuAsseguradora }}€</td>
                        <td class="text-center align-middle">{{ $carrera->preuPatrocini }}€</td>
                        <td class="text-center align-middle">{{ $carrera->preuInscripció }}€</td>

                            <td>
                                <form method="POST" action="{{ route('toggleHabilitado', $carrera->idCarrera) }}">
                                    @csrf
                                    @method('PUT')
                                    <button type="submit" class="activarBtn btn btn-{{ $carrera->habilitado ? 'success' : 'danger' }} ">
                                        {{ $carrera->habilitado ? ' SÍ ' : 'NO' }}
                                    </button>
                                </form>
                            </td>
                            <td>
                                <button type="button" class="accionesBtn btn btn-primary btn-ver-detalles" data-desnivel="{{ $carrera['desnivell'] }}" data-imagen-mapa="{{ $carrera['imatgeMapa'] }}" data-km="{{ $carrera['km'] }}" data-punto-salida="{{ $carrera['puntSortida'] }}" data-cartel-promocion="{{ $carrera['cartellPromoció'] }}" data-descripcion="{{ $carrera->descripció }}">
                                    Detalles
                                </button>
                            </td>
                            <td>
                            <form method="GET" action="{{ route('editar', $carrera['idCarrera']) }}">
                                @csrf
                                <button type="submit" class="accionesBtn btn btn-info btn-editar">Editar</button>
                            </form>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div> 
    </div>
</div>

<!-- Modal -->
<div class="modal fade" id="tablaModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header modalCarrera">
                <!-- <h5 class="modal-title" id="exampleModalLabel">Detalles de la Carrera</h5> -->
                <!-- <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button> -->
                <div id="cartel"></div>
            </div>
            <h5 class="modal-title text-center">Mapa</h5>
            <div class="modal-body">
            <div id="mapa"></div>
                <table class="table mx-auto">
                    <thead>
                        <tr class="table-row">
                            <th>Desnivel</th>
                            <th>Kilómetros</th>
                            <th>Punto de Salida</th>
                        </tr>
                    </thead>
                    <tbody id="detallesCarreraBody">
                    </tbody>
                </table>
                <div class="accordion accordion-flush" id="descripcion"></div>

                
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
            </div>
        </div>
    </div>
</div>
