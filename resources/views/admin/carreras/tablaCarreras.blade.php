@include('layouts.adminHeader')


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
                            <td>{{ $carrera['habilitado'] ? 'Sí' : 'No' }}</td>
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
    <button id="btn-add" class="btn btn-primary rounded-circle">
        <i class="fas fa-plus"></i>
    </button>
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

<script>
    $(document).ready(function() {
        document.getElementById('btn-add').addEventListener('click', function() {
            window.location.href = "{{ route('addCarreras') }}";
        });
        // Evento de clic en el botón que carga los detalles de la carrera en el modal
        $('.btn-ver-detalles').click(function() {
            // Obtener los datos de la carrera del botón que fue clicado
            var desnivel = $(this).data('desnivel');
            var imagenMapa = $(this).data('imagen-mapa');
            var km = $(this).data('km');
            var puntoSalida = $(this).data('punto-salida');
            var cartelPromocion = $(this).data('cartel-promocion');

            // Llenar la tabla del modal con los datos de la carrera
            $('#detallesCarreraBody').html('');
            $('#detallesCarreraBody').append('<tr><td>' + desnivel + '</td><td>' + imagenMapa + '</td><td>' + km + '</td><td>' + puntoSalida + '</td><td>' + cartelPromocion + '</td></tr>');

            // Mostrar el modal
            $('#tablaModal').modal('show');
        });
    });
</script>
