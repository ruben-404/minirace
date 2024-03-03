@include('layouts.adminHeader')
<script src="{{ asset('js/carreras.js') }}"></script>



<!-- datos carrera : imagen mapa, punto salida , km , desnivel, catel proocion -->

       <!-- Columna adicional con los botones -->
       <!-- <div class="d-flex flex-column bg-dark align-self-start mb-30 justify-content-end">

            <div class="mb-30">

                <div class="btn-group-vertical">
                    <button type="button" class="btn btn-primary mb-2">Carreras</button>
                    <button type="button" class="btn btn-primary mb-2">Aseguradores</button>
                    <button type="button" class="btn btn-primary mb-2">Sponsors</button>
                </div>
            </div>
        </div> -->
<div class="container mt-4 d-flex flex-row">
    <div class="row">
        <div class="col">
            <h2>Carreras</h2>
            <div style="max-height: 800px; overflow-y: auto;">
                <table class="table">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Nombre</th>
                            <th>Descripción</th>
                            <th>Máximo Participantes</th>
                            <th>Habilitado</th>
                            <th>Fecha</th>
                            <th>Hora</th>
                            <th>Precio Aseguradora</th>
                            <th>Precio Patrocinio</th>
                            <th>Precio Inscripción</th>
                            <th colspan="2" class="text-center">Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($carreras as $carrera)
                        <tr>
                            <td>{{ $carrera['idCarrera'] }}</td>
                            <td>{{ $carrera['nom'] }}</td>
                            <td>{{ $carrera['descripció'] }}</td>
                            <td>{{ $carrera['maximParticipants'] }}</td>
                            <td>
                                <form method="POST" action="{{ route('toggleHabilitado', $carrera->idCarrera) }}">
                                    @csrf
                                    @method('PUT')
                                    <button type="submit" class="btn btn-{{ $carrera->habilitado ? 'success' : 'danger' }}">
                                        {{ $carrera->habilitado ? 'SÍ' : 'NO' }}
                                    </button>
                                </form>
                            </td>
                            
                            <td>{{ $carrera['data'] }}</td>
                            <td>{{ $carrera['hora'] }}</td>
                            <td>{{ $carrera['preuAsseguradora'] }}€</td>
                            <td>{{ $carrera['preuPatrocini'] }}€</td>
                            <td>{{ $carrera['preuInscripció'] }}€</td>
                            <td>
                                <button type="button" class="btn btn-primary btn-ver-detalles" data-desnivel="{{ $carrera['desnivell'] }}" data-imagen-mapa="{{ $carrera['imatgeMapa'] }}" data-km="{{ $carrera['km'] }}" data-punto-salida="{{ $carrera['puntSortida'] }}" data-cartel-promocion="{{ $carrera['cartellPromoció'] }}">
                                    Detalles
                                </button>
                            </td>
                            <td>
                            <form method="GET" action="{{ route('editar', $carrera['idCarrera']) }}">
                                @csrf
                                <button type="submit" class="btn btn-info btn-editar">Editar</button>
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

<div class="position-fixed" style="right: 55px; bottom: 10px;">
    <form method="GET" action="{{ route('addCarreras') }}">
        @csrf
        <button id="btn-add" type="submit" class="btn btn-primary btn-lg rounded-circle">
        <i class="fas fa-plus"></i>
    </button>
    </form>
</div>

<!-- Modal -->
<div class="modal fade" id="tablaModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Detalles de la Carrera</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <table class="table">
                    <thead>
                        <tr>
                            <th>Desnivel</th>
                            <th>Imagen Mapa</th>
                            <th>Kilómetros</th>
                            <th>Punto de Salida</th>
                            <th>Cartel de Promoción</th>
                        </tr>
                    </thead>
                    <tbody id="detallesCarreraBody">
                        <!-- Aquí se llenarán los datos de la carrera -->
                    </tbody>
                </table>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
            </div>
        </div>
    </div>
</div>
