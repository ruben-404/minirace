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
            <h2>Aseguradoras</h2> 
            <form method="GET" action="{{ route('addAseguradora') }}">
                <button id="btn-add" class="btn btn-primary rounded-circle"><i class="fas fa-plus"></i></button>
            </form>
            <div style="max-height: 800px; overflow-y: auto;">
                <table class="table">
                    <thead>
                        <tr>
                            <th class="text-center">Logo</th>
                            <th class="text-center">CIF</th>
                            <th class="text-center">Nombre</th>
                            <th class="text-center">Dirección</th>
                            <th class="text-center">Precio</th>
                            <th class="text-center">Habilitado</th>
                            <th colspan="2" class="text-center">Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($asseguradoras as $asseguradora)
                        <tr>
                            <td class="text-center align-middle"><img width="80" height="80" src="{{asset('storage/asseguradoresImages/'.$asseguradora->logo)}}" alt="Logo asseguradora"></td>
                            <td class="text-center align-middle">{{ $asseguradora->CIF }}</td>
                            <td class="text-center align-middle">{{ $asseguradora->nom }}</td>
                            <td class="text-center align-middle">{{ $asseguradora->adreça }}</td>
                            <td class="text-center align-middle">{{ $asseguradora->preuCursa }}€</td>
                            <td class="text-center align-middle">{{ $asseguradora->habilitado ? 'Sí' : 'No' }}</td>
                            <td class="text-center align-middle">
                                <form method="GET" action="{{ route('editarAsseguradora', $asseguradora->CIF) }}">
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

<!-- Modal -->

<script>
    /*$(document).ready(function() {
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
    });*/
</script>
