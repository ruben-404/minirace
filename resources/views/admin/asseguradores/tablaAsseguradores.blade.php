@include('layouts.adminHeader')

<div class="container mt-4 d-flex flex-row">
<div class="flex-column bg-dark align-self-start justify-content-end vertical-buttons">
    <div class="mb-30">
        <div class="btn-group-vertical">
            <a href="{{ route('carreras') }}" class="btn btn-link mb-2">Carreras</a>
            <a href="{{ route('asseguradoras') }}" class="btn btn-link mb-2">Aseguradoras</a>
            <a href="#" class="btn btn-link mb-2 d-none d-lg-block">Sponsors</a>
        </div>
    </div>
</div>
    <div class="row mr-5 carrerasTable">
        <div class="col">
        <div class="d-flex justify-content-between titulo">
            <h2>Aseguradoras</h2> 
                <form method="GET" action="{{ route('addAseguradora') }}">
                    @csrf
                    <button id="btn-add" type="submit" class="btn btn-primary btn-lg rounded-circle">
                        <i class="fas fa-plus"></i>
                    </button>
                </form>
            </div>
            <div class="tbodyCont" style="max-height: 700px; overflow-y: auto;">
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
