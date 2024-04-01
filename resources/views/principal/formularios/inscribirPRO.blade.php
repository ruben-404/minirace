
@include('principal.componentes.header')
hola
<div class="container">
    <h2>Tabla de datos</h2>
    <div class="table-responsive">
        <table class="table table-bordered">
            <h1 class="text-white">Datos para inscribirse a la carrera {{$formData['idCarrera']}}</h1>
            <tbody>
                <tr>
                    <td class="text-white">DNI</td>
                    <td class="text-white">{{ $formData['dni'] }}</td>
                </tr>
                <tr>
                    <td class="text-white">Dirección</td>
                    <td class="text-white">{{ $formData['direccion'] }}</td>
                </tr>
                <tr>
                    <td class="text-white">Nombre</td>
                    <td class="text-white">{{ $formData['nombre'] }}</td>
                </tr>
                <tr>
                    <td class="text-white">Apellidos</td>
                    <td class="text-white">{{ $formData['apellidos'] }}</td>
                </tr>
                <tr>
                    <td class="text-white">Fecha de Nacimiento</td>
                    <td class="text-white">{{ $formData['fechanacimiento'] }}</td>
                </tr>
                <tr>
                    <td class="text-white">Número Federado</td>
                    <td class="text-white">{{ $formData['numerofederado'] }}</td>
                </tr>
            </tbody>
        </table>
        <form method="POST" enctype="multipart/form-data" action="{{ route('gestionar.inscripcion.novalidado.pro')}}">
            @csrf
            <input type="hidden" id="idCarrera" name="idCarrera" value="{{$formData['idCarrera']}}">
            <input type="hidden" id="dni" name="dni" value="{{ $formData['dni'] }}">
            <input type="hidden" id="direccion" name="direccion" value="{{ $formData['direccion'] }}">
            <input type="hidden" id="nombre" name="nombre" value="{{ $formData['nombre'] }}">
            <input type="hidden" id="apellidos" name="apellidos" value="{{ $formData['apellidos'] }}">
            <input type="hidden" id="fechanacimiento" name="fechanacimiento" value="{{ $formData['fechanacimiento'] }}">
            <input type="hidden" id="numerofederado" name="numerofederado" value="{{ $formData['numerofederado'] }}">
            <p class="text-white">(botón temporal que simula el paypal)</p>
            <button type="submit" class="btn btn-primary">Inscribirse</button>
        </form>
    </div>
</div>
