@include('layouts.adminHeader')

<script src="{{ asset('js/carreras.js') }}"></script>

<div class="container mt-4 flex-row">

    @include('layouts.adminBarra')


    <div class="row mr-5 carrerasTable">
        <div class="col">
        <div class="d-flex justify-content-between titulo">
            <h2>Participantes</h2>
            <form method="GET" action="{{ route('addCarreras') }}">
                @csrf
                <button id="btn-add" type="submit" class="btn btn-primary btn-lg rounded-circle">
                    <i class="fas fa-plus"></i>
                </button>
            </form>
        </div>


            <div class="tbodyCont" style="max-height: 700px; overflow-y: auto;">
                <a href="{{ route('corredores.inscritosPDF', ['id' => request()->route()->parameter('id')]) }}" class="btn btn-primary">Descargar Lista de Corredores</a>

                <table class="table">
                    <thead>
                        <tr class="table-row">
                            <th>Nombre</th>
                            <th>Carrera</th>
                            <th>Dorsal</th>
                        </tr>
                    </thead>
                    <tbody>
                    @foreach ($inscritos as $inscrito)
                        <tr>
                        <td>{{ $inscrito->corredor->nom }}</td>
                        <td>{{ $inscrito->carrera->nom}}</td>
                        <td>{{ $inscrito->numDorsal }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div> 
    </div>
</div>
