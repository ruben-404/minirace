@include('layouts.adminHeader')
<script src="{{ asset('js/carreras.js') }}"></script>

<div class="container mt-4 flex-row">
<div class="flex-column bg-dark align-self-start justify-content-end vertical-buttons">
    <div class="mb-30">
        <div class="btn-group-vertical">
            <a href="{{ route('carreras') }}" class="btn btn-link mb-2">Carreras</a>
            <a href="{{ route('asseguradoras') }}" class="btn btn-link mb-2">asseguradoras</a>
            <a href="#" class="btn btn-link mb-2 d-none d-lg-block">Sponsors</a>
        </div>
    </div>
</div>

    <div class="row mr-5 carrerasTable">
        <div class="col">
        <div class="d-flex justify-content-between titulo">
            <h2>Carreras</h2>
            <form method="GET" action="{{ route('addCarreras') }}">
                @csrf
                <button id="btn-add" type="submit" class="btn btn-primary btn-lg rounded-circle">
                    <i class="fas fa-plus"></i>
                </button>
            </form>
        </div>


            <div class="tbodyCont" style="max-height: 700px; overflow-y: auto;">
                <table class="table">
                    <thead>
                        <tr class="table-row">
                            <th>Nombre</th>
                        </tr>
                    </thead>
                    <tbody>
                    @foreach ($inscritos as $inscrito)
                        <tr>

                        <td>{{ $inscrito->corredor->nom }}</td>
                        <td>{{ $inscrito->carrera->nom }}</td>



                            
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div> 
    </div>
</div>
