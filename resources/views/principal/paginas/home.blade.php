<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Simple Bootstrap Carousel</title>
    <!--<link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet">-->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    @include('principal.componentes.header')
</head>
<body>

<div class="">
    <div id="carouselExampleIndicators" class="carousel slide" data-bs-ride="carousel">
    <div class="carousel-inner carruselMenu">
            <!-- Slide 1 -->
            <div class="carousel-item active">
                <img src="storage/homeImages/carousel1.png" class="d-block w-100" alt="First slide">
                <div class="carousel-caption d-none d-md-block">
                    <h5 class="TituloCarrusel">COMPETICION DE COCHES RC</h5>
                    <a href="#" class="btn btn-primary botonCarrusel">DESCUBRE MÁS</a>
                </div>
            </div>
            <!-- Slide 2 -->
            <div class="carousel-item">
                <img src="storage/carrerasImages/cartel_.png" class="d-block w-100" alt="Second slide">
                <div class="carousel-caption d-none d-md-block">
                    <h5 class="TituloCarrusel">COMPETICION DE COCHES RC</h5>
                    <a href="#" class="btn btn-primary botonCarrusel" id="botonCarrusel">DESCUBRE MÁS</a>
                </div>
            </div>
            <!-- Slide 3 -->
            <div class="carousel-item">
                <img src="storage/homeImages/carousel1.png" class="d-block w-100" alt="Third slide">
                <div class="carousel-caption d-none d-md-block">
                    <h5 class="TituloCarrusel">COMPETICION DE COCHES RC</h5>
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

<section id="zonaSponsors">
    <div class="container text-center">
        <h2 id="tituloSponsor">NUESTROS SPONSORS</h2>
        <hr id="barraSponsors"/>
        <div class="demo-row">
          <div class="container" id="id-sponsors">
            <div id="sponsor-carousel" class="carousel slide" data-ride="carousel"> 
              <div class="carousel-inner" role="listbox">
                <div class="item active">
                  <div class="row">
                    <div class="col-sm-3">
                      <div class="sponsor-feature"><img alt="" src="https://itagroup.hs.llnwd.net/o40/csg/pse-demo/channel-incentive/nucor-logo.svg" class="imgSponsor"/></div>
                    </div>
                    <div class="col-sm-3">
                      <div class="sponsor-feature"><img alt="" src="https://itagroup.hs.llnwd.net/o40/csg/pse-demo/channel-incentive/logo-mil.png" class="imgSponsor" /></div>
                    </div>
                    <div class="col-sm-3">
                      <div class="sponsor-feature"><img alt="" src="https://itagroup.hs.llnwd.net/o40/csg/pse-demo/channel-incentive/logo-timberline.jpg" class="imgSponsor" /></div>
                    </div>
                    <div class="col-sm-3">
                      <div class="sponsor-feature"><img alt="" src="https://itagroup.hs.llnwd.net/o40/csg/pse-demo/channel-incentive/logo-ppg.jpg" class="imgSponsor" /></div>
                    </div>
                  </div>
                </div>
                <div class="item">
                  <div class="row">
                    <div class="col-sm-3">
                      <div class="sponsor-feature"><img alt="" src="https://itagroup.hs.llnwd.net/o40/csg/pse-demo/channel-incentive/logos/logo2.jpg" class="imgSponsor" /></div>
                    </div>
                    <div class="col-sm-3">
                      <div class="sponsor-feature"><img alt="" src="https://itagroup.hs.llnwd.net/o40/csg/pse-demo/channel-incentive/logos/logo3.jpg" class="imgSponsor" /></div>
                    </div>
                    <div class="col-sm-3">
                      <div class="sponsor-feature"><img alt="" src="https://itagroup.hs.llnwd.net/o40/csg/pse-demo/channel-incentive/logos/logo4.jpg" class="imgSponsor" /></div>
                    </div>
                    <div class="col-sm-3">
                      <div class="sponsor-feature"><img alt="" src="https://itagroup.hs.llnwd.net/o40/csg/pse-demo/channel-incentive/nucor-logo.svg" class="imgSponsor" /></div>
                    </div>
                  </div>
                </div>
              </div>
              <a class="left carousel-control" href="#sponsor-carousel" role="button" data-slide="prev">
                <span class="glyphicon glyphicon-chevron-left"></span>
              </a>
              <a class="right carousel-control" href="#sponsor-carousel" role="button" data-slide="next">
                <span class="glyphicon glyphicon-chevron-right"></span>
              </a>
            </div>
          </div>
        </div>
    </div>

<script>
  $(document).ready(function(){
    $('.carousel').carousel();
  });
</script>

</body>
</html>
