@include('principal.componentes.header')
<script src="https://www.paypal.com/sdk/js?client-id=AWLRjNZgcsBV_POJ4dOvoukFw6tcEAJ0Flsa8TRcdLNW5VhIYjEYkTXJraBRU2BKm66t_WEPbQF-e9ZG&currency=EUR"></script>
<script src="{{ asset('js/paypalPro.js') }}"></script>
<div class="container">
    <h2>Tabla de datos</h2>
    <div class="table-responsive">
        <table class="table table-bordered">
            <h1 class="text-white">Datos para inscribirse a la carrera {{ $id }}</h1>
            <tbody>
                <tr>
                    <td class="text-white">DNI</td>
                    <td class="text-white">{{ $dni }}</td>
                </tr>
            </tbody>
        </table>
        <div id="paypal-button-pro-container" data-url="{{ route('get.pro.price') }}"></div>
        <form id="inscripcion-pro-form" method="POST" enctype="multipart/form-data" action="{{ route('gestionar.inscripcion.socio.pro')}}">
            @csrf
            <input type="hidden" id="idCarrera" name="idCarrera" value="{{ $id }}">
            <input type="hidden" id="dni" name="dni" value="{{ $dni }}">
            <!--<button type="submit" class="btn btn-primary">Inscribirse</button>
            <p class="text-white">(botón temporal que simula el paypal)</p>-->
        </form>
    </div>
</div>


@include('principal.componentes.footer')
