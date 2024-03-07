@include('layouts.adminHeader')
<script src="{{ asset('js/carreras.js') }}"></script>

<div class="container mt-4 d-flex flex-row">

    <!-- Contenedor de la barra lateral -->
    <div class="flex-column bg-dark align-self-start justify-content-end vertical-buttons">
        <div class="mb-30">
        <div class="container d-flex justify-content-between align-items-center d-lg-none">
                <button id="toggleSidebar1" class="btn btn-link mb-2 text-white">
                    <i class="fas fa-bars"></i> <!-- Icono de barras -->
                </button>
            </div>
            <div class="btn-group-vertical">
                <a href="{{ route('carreras') }}" class="btn btn-link mb-2 text-white text-decoration-none">Carreras</a>
                <a href="{{ route('asseguradoras') }}" class="btn btn-link mb-2 text-white text-decoration-none">Asseguradoras</a>
                <a href="{{ route('sponsors') }}" class="btn btn-link mb-2 text-white text-decoration-none">Sponsors</a>
            </div>
        </div>
    </div>
    <div class="row mr-5 carrerasTable">
        <div class="col">
        <div class="d-flex justify-content-between titulo">
            <h2>Aseguradoras</h2> 
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
                            <th colspan="2" class="text-center">Acciones</th>
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
                            <td class="text-center align-middle">
                                <form method="GET" action="{{ route('editarSponsor', $sponsor->CIF) }}">
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
