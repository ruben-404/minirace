@include('layouts.adminHeader')
<script src="{{ asset('js/aseguradoras.js') }}"></script>

<div class="container mt-4 d-flex flex-row">

    <!-- Contenedor de la barra lateral -->
    @include('layouts.adminBarra')

    <div class="row mr-5 carrerasTable">
        <div class="col">
            <div class="d-flex justify-content-between titulo">
                <h2>Aseguradoras</h2>
                <div class="row justify-content-center col-md-7">
                    <div class="col-md-10">
                        <div class="input-group mb-3">
                            <input type="text" class="form-control" id="busquedaA" placeholder="Buscar asseguradores...">
                        </div>
                    </div>
                </div>
                <div id="buscar-asseguradores-url" data-url="{{ route('buscar-asseguradoras') }}"></div>
                <form method="GET" action="{{ route('addAseguradora') }}">
                    @csrf
                    <button id="btn-add" type="submit" class="btn btn-primary btn-lg rounded-circle">
                        <i class="fas fa-plus"></i>
                    </button>
                </form>
            </div>
            <div class="tbodyCont" style="max-height: 700px; overflow-y: auto;">
                <div class="table-responsive">
                    <table class="table">
                        <thead>
                            <tr>
                                <th class="text-center d-none d-md-table-cell">Logo</th> <!-- Oculta en móviles -->
                                <th class="text-center">CIF</th>
                                <th class="text-center">Nombre</th>
                                <th class="text-center d-none d-md-table-cell">Dirección</th> <!-- Oculta en móviles -->
                                <th class="text-center d-none d-md-table-cell">Precio</th> <!-- Oculta en móviles -->
                                <th class="text-center d-none d-md-table-cell">Habilitado</th> <!-- Oculta en móviles -->
                                <th class="text-center">Edición</th>
                                <th class="text-center d-none d-md-table-cell">Detalles</th> <!-- Oculta en móviles -->
                                <th class="text-center">Carreras Aseguradas</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($asseguradoras as $asseguradora)
                            <tr>
                                <td class="text-center align-middle d-none d-md-table-cell"><img width="80" height="80" src="{{asset('storage/asseguradoresImages/'.$asseguradora->logo)}}" alt="Logo asseguradora"></td> <!-- Oculta en móviles -->
                                <td class="text-center align-middle">{{ $asseguradora->CIF }}</td>
                                <td class="text-center align-middle">{{ $asseguradora->nom }}</td>
                                <td class="text-center align-middle d-none d-md-table-cell">{{ $asseguradora->adreça }}</td> <!-- Oculta en móviles -->
                                <td class="text-center align-middle d-none d-md-table-cell">{{ $asseguradora->preuCursa }}€</td> <!-- Oculta en móviles -->
                                <td class="text-center align-middle d-none d-md-table-cell">
                                    <form method="POST" action="{{ route('toggleHabilitadoAseguradora', $asseguradora->CIF) }}">
                                        @csrf
                                        @method('PUT')
                                        <button type="submit" class="activarBtn btn btn-{{ $asseguradora->habilitado ? 'success' : 'danger' }} ">
                                            {{ $asseguradora->habilitado ? ' SÍ ' : 'NO' }}
                                        </button>
                                    </form>
                                </td>
                                <td class="text-center align-middle">
                                    <form method="GET" action="{{ route('editarAsseguradora', $asseguradora->CIF) }}">
                                        @csrf
                                        <button type="submit" class="btn btn-info btn-editar">Editar</button>
                                    </form>
                                </td>
                                <td class="text-center align-middle d-none d-md-table-cell">
                                    <button type="button" class="accionesBtn btn btn-primary btn-ver-detalles-aseguradora" data-cif="{{$asseguradora->CIF}}" data-nom="{{$asseguradora->nom}}" data-direccion="{{ $asseguradora->adreça }}" data-preucursa="{{ $asseguradora->preuCursa }}" data-logo="{{ $asseguradora->logo }}">
                                        Detalles
                                    </button>
                                </td>
                                <td class="text-center align-middle">
                                    <form method="GET" action="{{ route('carreras.aseguradas', $asseguradora->CIF) }}">
                                        @csrf
                                        <button type="submit" class="btn btn-info btn-aseguradas">Carreras</button>
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
</div>

<!-- Modal -->
<div class="modal fade" id="tablaModalAseguradora" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header modalAseguradora" id="modalAseguradora">
            </div>
            <div id="carrerasAseguradas"></div> 
        </div>
    </div>
</div>