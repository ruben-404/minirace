<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MiniRace</title>
    <!--<link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet">-->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <link href='https://fonts.googleapis.com/css?family=Montserrat' rel='stylesheet'>
    @include('principal.componentes.header')
</head>
<body>

<!--@foreach ($carrerasDestacadas as $carrera)
    <div>{{ $carrera->idCarrera }}</div>
@endforeach-->

<div class="">
    <div id="carouselExampleIndicators" class="carousel slide" data-bs-ride="carousel">
    <div class="carousel-inner carruselMenu">
            <!-- Slide 1 -->
            <div class="carousel-item active">
                <img src="storage/homeImages/carousel1.png" class="d-block w-100" alt="First slide">
                <div class="carousel-caption d-none d-md-block">
                    <h5 class="TituloCarrusel">COMPETICIÓN <br>DE COCHES RC</h5>
                    <a href="#" class="btn btn-primary botonCarrusel">DESCUBRE MÁS</a>
                </div>
            </div>
            <!-- Slide 2 -->
            <div class="carousel-item">
                <img src="storage/carrerasImages/cartel_.png" class="d-block w-100" alt="Second slide">
                <div class="carousel-caption d-none d-md-block">
                    <h5 class="TituloCarrusel">COMPETICIÓN <br>DE COCHES RC</h5>
                    <a href="#" class="btn btn-primary botonCarrusel" id="botonCarrusel">DESCUBRE MÁS</a>
                </div>
            </div>
            <!-- Slide 3 -->
            <div class="carousel-item">
                <img src="storage/homeImages/carousel1.png" class="d-block w-100" alt="Third slide">
                <div class="carousel-caption d-none d-md-block">
                    <h5 class="TituloCarrusel">COMPETICIÓN <br>DE COCHES RC</h5>
                    <a href="#" class="btn btn-primary botonCarrusel">DESCUBRE MÁS</a>
                </div>
            </div>
        </div>
        <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Previous</span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Next</span>
        </button>
    </div>
</div>

<div class="container pt-5 contPca">
  <div class="cardsContanier">
    <h1 class="text-center race-title text-white">PRÓXIMAS CARRERAS</h1>
    <h3 class="text-center race-subtitle text-white">Echa un vistazo a nuestras próximas carreras</h3>
      <div class="row row-cols-1 row-cols-md-4 g-4 overflow-auto contCards">
          @foreach($carrerasDestacadas as $carrera)
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
</div>

<section id="zonaSponsors">
    <div class="container text-center">
        <h2 id="tituloSponsor">NUESTROS SPONSORS</h2>
        <hr id="barraSponsors"/>
        <div class="demo-row">
            <div class="container" id="id-sponsors">
                <div id="sponsor-carousel" class="carousel slide" data-ride="carousel"> 
                    <div class="carousel-inner" role="listbox">
                        @php
                          @$highlightedSponsors = App\Models\Sponsor::where('destacat', 1)->get();
                        @endphp
                        @foreach($highlightedSponsors->chunk(4) as $chunk)
                        <div class="item{{ $loop->first ? ' active' : '' }}">
                            <div class="row">
                                @foreach($chunk as $sponsor)
                                <div class="col-sm-3">
                                    <div class="sponsor-feature" style="width: 100%; height: 120px;"> <!-- Adjust the width and height as needed -->
                                        <img alt="" src="{{ asset('storage/sponsorsImages/' . $sponsor->logo) }}" class="imgSponsor" style="max-width: 100%; max-height: 100%;"/> <!-- Adjust max-width and max-height as needed -->
                                    </div>
                                </div>
                                @endforeach
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<script>
  $(document).ready(function(){
    $('.carousel').carousel();
  });
</script>

</body>
</html>
