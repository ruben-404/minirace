@include('layouts.adminHeader')
<script src="{{ asset('js/aseguradoras.js') }}"></script>


<div class="container mt-4 d-flex flex-row">

    <!-- Contenedor de la barra lateral -->
    @include('layouts.adminBarra')

    <div class="row mr-5 carrerasTable">
        <div class="col">
        <div class="d-flex justify-content-between titulo">
            <h1>Carreras aseguradas de {{ $Caseguradas[0]->CIFasseguradora }}</h1> 
                <form method="GET" action="{{ route('mostrarAseguracionCarreras', $Caseguradas[0]->CIFasseguradora) }}">
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
                            <th class="text-center">Cartel promocional</th>
                            <th class="text-center">ID</th>
                            <th class="text-center">Nombre</th>
                            <th class="text-center">Precio aseguración</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($Caseguradas as $asegurada)
                        <tr>
                            <td class="text-center align-middle"><img width="80" height="80" src="{{asset('storage/carrerasImages/'.$asegurada->carrera->cartellPromoció)}}" alt="Logo carrera"></td>
                            <td class="text-center align-middle">{{ $asegurada->carrera->idCarrera }}</td>
                            <td class="text-center align-middle">{{ $asegurada->carrera->nom }}</td>
                            <td class="text-center align-middle">{{ $asegurada->carrera->preuAsseguradora }}€</td>
                        </tr>
                        
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div> 
    </div>
</div>

