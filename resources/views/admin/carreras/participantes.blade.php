@include('layouts.adminHeader')
<script src="{{ asset('js/carreras.js') }}"></script>
<script src="{{ asset('js/draganddrop.js') }}"></script>

<div class="container mt-4 flex-row">

    @include('layouts.adminBarra')


    <div class="row mr-5 carrerasTable">
        <div class="col">
        <div class="d-flex justify-content-between titulo">
            <h2>Participantes</h2>
            <a href="{{ route('corredores.inscritosPDF', ['id' => request()->route()->parameter('id')]) }}" class="btn btn-primary">
                Descargar Lista de Corredores
            </a>
            <a href="{{ route('generar.pdf.qr.todos', ['idCarrera' => $inscritos[0]['idCarrera']]) }}" class="btn btn-primary">
                Generar PDF con QR para Todos
            </a>
            
            
        </div>


            <div class="tbodyCont" style="max-height: 700px; overflow-y: auto;">
                <table class="table">
                    <thead>
                        <tr class="table-row">
                            <th>Nombre</th>
                            <th>Carrera</th>
                            <th>Dorsal</th>
                            <th>QR</th>
                        </tr>
                    </thead>
                    @php
                        $inscritosOrdenados = $inscritos->sortBy('numDorsal');
                    @endphp
                    <tbody id="draggable-list">
                        @csrf
                        <div class="d-none" id="carrera-id" data-carrera="{{ request()->route()->parameter('id') }}" data-url="{{ route('carreras.numdorsales.update') }}"></div>
                        @foreach ($inscritosOrdenados as $inscrito)
                            <tr data-type="{{ $inscrito->corredor->tipus }}" data-state="static" data-id="{{ $inscrito->corredor->DNI }}" data-dorsal="{{ $inscrito->numDorsal }}" draggable="true">
                                <td>{{ $inscrito->corredor->nom }}</td>
                                <td>{{ $inscrito->carrera->nom}}</td>
                                <td id="num-dorsal">{{ $inscrito->numDorsal }}</td>
                                <td>  
                                    <a href="{{ route('generar.pdf.qr', ['idCarrera' => $inscrito->idCarrera, 'idCorredor' => $inscrito->DNIcorredor, 'numDorsal' => $inscrito->numDorsal]) }}" class="btn btn-primary">Generar PDF con QR</a>
                                </td>
                                <input type="hidden" value="{{$inscrito->carrera->maximParticipants}}" id="maxParticipants">
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div> 
    </div>
</div>
