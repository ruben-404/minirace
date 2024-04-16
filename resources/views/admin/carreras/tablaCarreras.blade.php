<div id="">
    @include('layouts.adminHeader')
    <script src="{{ asset('js/carreras.js') }}"></script>

    <div class="container mt-4 d-flex flex-row">
        @include('layouts.adminBarra')

        <div class="row mr-5 carrerasTable">
            <div class="col">
                <div class="d-flex justify-content-between titulo">
                    <h2>Carreras</h2>
                    <div class="row justify-content-center col-md-7">
                        <div class="col-md-10">
                            <div class="input-group mb-3">
                                <input type="text" class="form-control" id="busqueda" placeholder="Buscar carrera...">
                            </div>
                        </div>
                    </div>
                    <div id="buscar-carreras-url" data-url="{{ route('buscar-carreras') }}"></div>

                    <form method="GET" action="{{ route('addCarreras') }}">
                        @csrf
                        <button id="btn-add" type="submit" class="btn btn-primary btn-lg rounded-circle">
                            <i class="fas fa-plus"></i>
                        </button>
                    </form>
                </div>

                @if (session()->has('success'))
                    <li>{{session()->get('success')}}</li>
                @endif
                <div class="tbodyCont" style="max-height: 700px; overflow-y: auto;">
                    <table class="table table-responsive" id="tablaCarreras">
                        <thead>
                            <tr class="table-row">
                                <th class="text-center d-none d-md-table-cell">ID</th>
                                <th class="text-center">Nombre</th>
                                <th class="text-center d-none d-md-table-cell">Máximo Participantes</th>
                                <th class="text-center d-none d-md-table-cell">Fecha</th> 
                                <th class="text-center d-none d-md-table-cell">Hora</th>
                                <th class="text-center d-none d-md-table-cell">Precio Aseguradora</th>
                                <th class="text-center d-none d-md-table-cell">Precio Patrocinio</th> 
                                <th class="text-center d-none d-md-table-cell">Precio Inscripción</th>
                                <th class="text-center d-md-table-cell">Habilitado</th>
                                <th colspan="2" class="text-center">Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($carreras as $carrera)
                            <tr>
                                <td class="text-center align-middle d-none d-md-table-cell">{{ $carrera->idCarrera }}</td>
                                <td class="text-center align-middle">{{ $carrera->nom }}</td>
                                <td class="text-center align-middle d-none d-md-table-cell">{{ $carrera->maximParticipants }}</td>
                                <td class="text-center align-middle d-none d-md-table-cell">{{ $carrera->data }}</td>
                                <td class="text-center align-middle d-none d-md-table-cell">{{ $carrera->hora }}</td>
                                <td class="text-center align-middle d-none d-md-table-cell">{{ $carrera->preuAsseguradora }}€</td>
                                <td class="text-center align-middle d-none d-md-table-cell">{{ $carrera->preuPatrocini }}€</td>
                                <td class="text-center align-middle d-none d-md-table-cell">{{ $carrera->preuInscripció }}€</td> <!-- Oculta en móviles -->
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
                                    <button type="button" class="accionesBtn btn btn-primary btn-ver-detalles" data-url="{{ route('corredores.inscritos', ['id' => $carrera->idCarrera]) }}" data-id="{{ $carrera['idCarrera'] }}" data-desnivel="{{ $carrera['desnivell'] }}" data-imagen-mapa="{{ $carrera['imatgeMapa'] }}" data-km="{{ $carrera['km'] }}" data-punto-salida="{{ $carrera['puntSortida'] }}" data-cartel-promocion="{{ $carrera['cartellPromoció'] }}" data-descripcion="{{ $carrera->descripció }}">
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
                    <div id="cartel"></div>
                </div>
                <h5 class="modal-title text-center">Mapa</h5>
                <div class="modal-body">
                    <table class="table mx-auto">
                        <thead>
                            <tr class="table-row">
                                <th>Desnivel</th>
                                <th>Kilómetros</th>
                                <th>Punto de Salida</th>
                                <th>Participantes</th>
                            </tr>
                        </thead>
                        <tbody id="detallesCarreraBody">
                        </tbody>
                    </table>
                    <div class="accordion accordion-flush" id="mapa"></div>
                    <div class="accordion accordion-flush" id="descripcion"></div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                </div>
            </div>
        </div>
    </div>
</div>