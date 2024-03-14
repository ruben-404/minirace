@include('principal.componentes.header')

<div class="container pt-5">
    <div class="row row-cols-1 row-cols-md-4 g-4 overflow-auto" style="max-height: 800px; overflow-y: auto;">
        @foreach($carreras as $carrera)
        <div class="col">
            <div class="card">
                <img src="{{ asset('storage/carrerasImages/' . $carrera['cartellPromoció']) }}" class="card-img-top" alt="Cartel de la carrera">
                <div class="card-body">
                    <h5 class="card-title">{{ $carrera['nom'] }}</h5>
                    <a href="#" class="btn btn-primary">Más información</a>
                </div>
            </div>
        </div>
        @endforeach
    </div>
</div>
