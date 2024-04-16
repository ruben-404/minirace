@include('principal.componentes.header')

<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Registro de socio</title>
  <link rel="stylesheet" href="{{ asset('css/register.css') }}">
</head>
  <body>
    <div class="container-fluid">
      <div class="row">
        <div class="col-md-6 full-height-register ass">
          <img src="{{ asset('resources/fondoLogin.png') }}" class="img-fluid h-100" alt="Imagen">
        </div>
        <div class="col-md-6 bg-light full-height-register center-text">
            <div class='d-flex flex-column flex-md-row'>
              <div>
                <div class="col-md-12 mb-2 center-text">
                    <h1 class="d-block">Inscrito satisfactoriamente</h1>
                </div>
                <div class="col-md-12 mb-2 center-text">
                    <a href="{{ route('generar.factura.novalidado.open', ['idCarrera' => $datos['idCarrera'], 'CIFaseguradora' => $datos['CIFaseguradora'], 'DNIcorredor' => $datos['DNIcorredor']]) }}" class="d-block btn btn-primary">Descargar factura</a>
                </div>
                <div class="col-md-12 mb-2 center-text"> 
                    <a href="/" class="d-block btn btn-primary">Volver al inicio</a>
                </div>
              </div>
            </div>
        </div>
      </div>
    </div>
  </body>
</html>