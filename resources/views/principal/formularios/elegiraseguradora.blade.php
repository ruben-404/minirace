<!-- ver datos
@if(isset($formData))
    {{-- Iterar sobre los datos del formulario --}}
    @foreach($formData as $key => $value)
        <p>{{ $key }}: {{ $value }}</p>
    @endforeach
@endif
-->
@include('principal.componentes.header')

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Aseguradoras disponibles de {{ $formData['idCarrera'] }}</div>
                <form method="POST" enctype="multipart/form-data" action="{{ route('mandar.aseguraciones.carrera.open')}}">
                    @csrf
                    <div class="form-group mb-0">
                        <select id="aseguradoraElegida" name="aseguradoraElegida"> 

                            @foreach ($carrerasAsseguradas as $carrera)
                                <option value="{{ $carrera->CIFasseguradora }}">{{ $carrera->asseguradora->nom }} -- {{ $carrera->asseguradora->preuCursa }}€</option>
                            @endforeach

                        </select>
                    </div>
                    <input type="hidden" id="idCarrera" name="idCarrera" value="{{$formData['idCarrera']}}">
                    <input type="hidden" id="dni" name="dni" value="{{ $formData['dni'] }}">
                    <input type="hidden" id="direccion" name="direccion" value="{{ $formData['direccion'] }}">
                    <input type="hidden" id="nombre" name="nombre" value="{{ $formData['nombre'] }}">
                    <input type="hidden" id="apellidos" name="apellidos" value="{{ $formData['apellidos'] }}">
                    <input type="hidden" id="fechanacimiento" name="fechanacimiento" value="{{ $formData['fechanacimiento'] }}">
                    <input type="hidden" id="genere" name="genere" value="{{ $formData['genere'] }}">
                    <button type="submit" class="btn btn-primary">Aseguradora elegida</button>
                </form>
            </div>
        </div>
    </div>
</div>
