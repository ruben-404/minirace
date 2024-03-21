@include('principal.componentes.header')

<div class="container mt-5">
    <div class="row text-white contInfo">
        <h2>{{ $carrera->nom }}</h2>

        <div class="col-md-4">
            <img src="{{ asset('storage/carrerasImages/' . $carrera->cartellPromoció) }}" alt="Cartel de la carrera" class="img-fluid">
        </div>
        <div class="col-md-4 mx-auto descricioCont">
            <p>{{ $carrera->descripció }}</p>

        </div>
        <div class="accordion mt-5" id="accordionExample">
            <div class="accordion-item desplegableCont">
                <h2 class="accordion-header" id="headingOne">
                    <button class="accordion-button collapsed desplegableInfo text-white" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="false" aria-controls="collapseOne">
                        Mapa
                    </button>
                </h2>
                <div id="collapseOne" class="accordion-collapse collapse desplegableInfo" aria-labelledby="headingOne" data-bs-parent="#accordionExample">
                    <div class="accordion-body text-white d-flex justify-content-center align-items-center">
                        <img src="{{ asset('storage/carrerasImages/' . $carrera->imatgeMapa) }}" alt="Mapa de la carrera" class="img-fluid">
                    </div>
                </div>
            </div>
            <div class="accordion-item desplegableCont">
                <h2 class="accordion-header" id="headingTwo">
                    <button class="accordion-button collapsed desplegableInfo text-white" type="button" data-bs-toggle="collapse" data-bs-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                        Desnivel
                    </button>
                </h2>
                <div id="collapseTwo" class="accordion-collapse collapse desplegableInfo" aria-labelledby="headingTwo" data-bs-parent="#accordionExample">
                    <div class="accordion-body text-white">
                        <p>{{ $carrera->desnivell }}</p>

                    </div>
                </div>
            </div>
            <div class="accordion-item desplegableCont">
                <h2 class="accordion-header" id="headingThree">
                    <button class="accordion-button collapsed desplegableInfo text-white" type="button" data-bs-toggle="collapse" data-bs-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                        Horario
                    </button>
                </h2>
                <div id="collapseThree" class="accordion-collapse collapse desplegableInfo" aria-labelledby="headingThree" data-bs-parent="#accordionExample">
                    <div class="accordion-body text-white">
                        <p>{{ $carrera->hora }}</p>
                        <p>{{ $carrera->data }}</p>

                    </div>
                </div>
            </div>
        </div>
        
        
</div>
@include('principal.componentes.footer')
