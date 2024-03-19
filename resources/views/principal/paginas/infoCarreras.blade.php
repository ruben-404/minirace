@include('principal.componentes.header')

<div class="container mt-5">
    <div class="row">
        <div class="col-md-8 text-white">
            <h2>{{ $carrera->nom }}</h2>
            <p>{{ $carrera->descripció }}</p>
        </div>
        <div class="col-md-4">
            <img src="{{ asset('storage/carrerasImages/' . $carrera->cartellPromoció) }}" alt="Cartel de la carrera" class="img-fluid">
        </div>
    </div>
</div>
