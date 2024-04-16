@include('principal.componentes.header')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Aseguradoras disponibles de {{ $id }}</div>
                <form method="POST" enctype="multipart/form-data" action="{{ route('principal.formularios.pagarCarrera.open')}}">
                    @csrf
                    <div class="form-group mb-0">
                        <select id="aseguradoraElegida" name="aseguradoraElegida" class="m-3 p-2"> 
                            @foreach ($aseguradorasDisponibles as $carrera)
                                <option value="{{ $carrera->CIFasseguradora }}">{{ $carrera->asseguradora->nom }} -- {{ $carrera->asseguradora->preuCursa }}€</option>
                            @endforeach
                        </select>
                    </div>
                    <input type="hidden" id="idCarrera" name="idCarrera" value="{{$id}}">
                    <div class="m-3">
                        <button type="submit" class="btn btn-primary">Aseguradora elegida</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@include('principal.componentes.footer')
