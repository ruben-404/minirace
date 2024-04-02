@include('principal.componentes.header')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Aseguradoras disponibles de {{ $id }}</div>
                <form method="POST" enctype="multipart/form-data" action="{{ route('principal.formularios.pagarCarrera.open')}}">
                    @csrf
                    <div class="form-group mb-0">
                    <select id="aseguradoraElegida" name="aseguradoraElegida"> 
                        @foreach ($aseguradorasDisponibles as $carrera)
                            <option value="{{ $carrera->CIFasseguradora }}">{{ $carrera->asseguradora->nom }} -- {{ $carrera->asseguradora->preuCursa }}€</option>
                        @endforeach
                    </select>
                    </div>
                    <input type="hidden" id="idCarrera" name="idCarrera" value="{{$id}}">
                    <button type="submit" class="btn btn-primary">Aseguradora elegida</button>
                </form>
            </div>
        </div>
    </div>
</div>
@include('principal.componentes.footer')
