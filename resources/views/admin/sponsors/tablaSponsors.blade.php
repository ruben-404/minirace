@include('layouts.adminHeader')
<script src="{{ asset('js/sponsors.js') }}"></script>

<div class="container mt-4 d-flex flex-row">

    @include('layouts.adminBarra')

    <div class="row mr-5 carrerasTable">
        <div class="col">
        <div class="d-flex justify-content-between titulo">
            <h2>Sponsors</h2> 
                <form method="GET" action="{{ route('addSponsor') }}">
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
                            <th class="text-center">Nombre</th>
                            <th class="text-center">CIF</th>
                            <th class="text-center">Dirección</th>
                            <th class="text-center">Destacado</th>
                            <th class="text-center">Patrocinar</th>
                            <th colspan="1" class="text-center">Acciones</th>
                            <th colspan="2" class="text-center">Carreras Patrocinadas</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($sponsors as $sponsor)
                        <tr>
                            <td class="text-center align-middle"><img width="80" height="80" src="{{asset('storage/sponsorsImages/'.$sponsor->logo)}}" alt="Logo Sponsor"></td>
                            <td class="text-center align-middle">{{ $sponsor->CIF }}</td>
                            <td class="text-center align-middle">{{ $sponsor->nom }}</td>
                            <td class="text-center align-middle">{{ $sponsor->adreça }}</td>
                            <td class="text-center align-middle">{{ $sponsor->destacado ? 'Sí' : 'No' }}</td>
                            <!-- L -->
                            <td class="text-center align-middle">
                                <form method="GET" action="{{ route('mostrarPatrocinioCarreras', $sponsor->CIF) }}">
                                    @csrf
                                    <button type="submit" class="btn btn-info btn-editar">Carreras</button>
                                </form>
                            </td>
                            <td class="text-center align-middle">
                                <form method="POST" action="{{ route('toggleHabilitadoSponsor', $sponsor->CIF) }}">
                                    @csrf
                                    @method('PUT')
                                    <button type="submit" class="activarBtn btn btn-{{ $sponsor->destacat ? 'success' : 'danger' }} ">
                                        {{ $sponsor->destacat ? ' SÍ ' : 'NO' }}
                                    </button>
                                </form>
                            </td>
                            
                            <td class="text-center align-middle">
                                <form method="GET" action="{{ route('editarSponsor', $sponsor->CIF) }}">
                                    @csrf
                                    <button type="submit" class="btn btn-info btn-editar">Editar</button>
                                </form>
                            </td>
                            <td class="text-center align-middle">
                                <button type="button" class="accionesBtn btn btn-primary btn-ver-detalles-aseguradora" data-cif="{{$sponsor->CIF}}" data-nom="{{$sponsor->nom}}" data-direccion="{{ $sponsor->adreça }}" data-preucursa="{{ $sponsor->preuCursa }}" data-logo="{{ $sponsor->logo }}">
                                    Detalles
                                </button>
                            </td>
                            <td class="text-center align-middle">
                                <form method="GET" action="{{ route('carreras.patrocinadas', $sponsor->CIF) }}">
                                    @csrf
                                    <button type="submit" class="btn btn-info btn-patrocinadas">Ver</button>
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
