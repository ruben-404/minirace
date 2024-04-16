@include('principal.componentes.header')
<script src="https://www.paypal.com/sdk/js?client-id=AWLRjNZgcsBV_POJ4dOvoukFw6tcEAJ0Flsa8TRcdLNW5VhIYjEYkTXJraBRU2BKm66t_WEPbQF-e9ZG&currency=EUR"></script>
<script src="{{ asset('js/paypalOpenNovalidado.js') }}"></script>
<div class="container">
    <h2>Tabla de datos</h2>
    <div class="table-responsive">
        <table class="table table-bordered">
            <div class="d-flex justify-content-center">
                <h1 class="text-white m-4">Datos para inscribirse a la carrera {{$formData['idCarrera']}}</h1>
            </div>
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
                    <td class="text-white">Genero</td>
                    <td class="text-white">{{ $formData['genere'] }}</td>
                </tr>
                <tr>
                    <td class="text-white">Aseguradora</td>
                    <td class="text-white">{{ $formData['aseguradoraElegida'] }}</td>
                </tr>
            </tbody>
        </table>
        <div class="d-flex justify-content-center m-4">
            <div class="w-25"> <!-- Aquí aplicamos el ancho del 25% al contenedor principal -->
                <div id="paypal-button-open-novalidado-container" data-url="{{ route('get.open.novalidado.price') }}"></div>
            </div>
        </div>
        <form id="inscripcion-open-novalidado-form" method="POST" enctype="multipart/form-data" action="{{ route('gestionar.inscripcion.novalidado.open')}}">
            @csrf
            <input type="hidden" id="idCarrera" name="idCarrera" value="{{$formData['idCarrera']}}">
            <input type="hidden" id="dni" name="dni" value="{{ $formData['dni'] }}">
            <input type="hidden" id="direccion" name="direccion" value="{{ $formData['direccion'] }}">
            <input type="hidden" id="nombre" name="nombre" value="{{ $formData['nombre'] }}">
            <input type="hidden" id="apellidos" name="apellidos" value="{{ $formData['apellidos'] }}">
            <input type="hidden" id="fechanacimiento" name="fechanacimiento" value="{{ $formData['fechanacimiento'] }}">
            <input type="hidden" id="aseguradoraElegida" name="aseguradoraElegida" value="{{ $formData['aseguradoraElegida'] }}">
            <input type="hidden" id="genere" name="genere" value="{{ $formData['genere'] }}">
            <!--<button type="submit" class="btn btn-primary">Inscribirse</button>
            <p class="text-white">(botón temporal que simula el paypal)</p>-->
        </form>
    </div>
</div>