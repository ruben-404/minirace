<div class="cardsContanier">
    <div class="row row-cols-1 row-cols-md-4 g-4 overflow-auto contCards">
        @foreach($carreras as $carrera)
        <div class="col">
            <div class="card">
                <img src="{{ asset('storage/carrerasImages/' . $carrera['cartellPromoció']) }}" class="card-img-top" alt="Cartel de la carrera">
                <div class="card-body">
                    <h5 class="card-title">{{ $carrera['nom'] }}</h5>
                    <a href="{{ route('infoCarrera', ['id' => $carrera->idCarrera]) }}" class="btn btn-primary">Ver información de la carrera</a>

                </div>
            </div>
        </div>
        @endforeach
    </div>
</div>
