@include('principal.componentes.header')

<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Registro de socio</title>
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
  <link rel="stylesheet" href="{{ asset('css/register.css') }}">
</head>
  <body>
    <div class="container-fluid">
      <div class="row">
        <div class="col-md-6 full-height-register">
          <img src="{{ asset('resources/fondoLogin.png') }}" class="img-fluid h-100" alt="Imagen">
        </div>
        <div class="col-md-6 bg-light full-height-register center-text">
          <form method="POST" action="{{ route('procesarRegistro') }} ">
          @csrf
            <h1 class="mb-5 text-center">Registro de socio</h1>
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            <div class='d-flex'>
              <div>
                <div class="col-md-12 mb-2"> 
                    <label for="dni">DNI</label>
                </div>
                <div class="col-md-12 mb-2 text-center"> 
                    <input type="text" id="dni" name="dni" placeholder="DNI" class="form-control input-line" required>
                </div>
                <div class="col-md-12 mb-2"> 
                    <label for="password">Contraseña:</label>
                </div>
                <div class="col-md-12 mb-2 text-center"> 
                    <input type="password" id="password" name="password" placeholder="Contraseña" class="form-control input-line" required>
                </div>
                <div class="col-md-12 mb-2"> 
                    <label for="direccion">Dirección</label>
                </div>
                <div class="col-md-12 mb-2 text-center"> 
                    <input type="text" id="direccion" name="direccion" placeholder="Dirección" class="form-control input-line" required>
                </div>
              </div>
              <div>
                <div class="col-md-12 mb-2"> 
                    <label for="nombre">Nombre</label>
                </div>
                <div class="col-md-12 mb-2 text-center"> 
                    <input type="text" id="nombre" name="nombre" placeholder="Nombre" class="form-control input-line" required>
                </div>
                <div class="col-md-12 mb-2"> 
                    <label for="apellidos">Apellidos</label>
                </div>
                <div class="col-md-12 mb-2 text-center"> 
                    <input type="text" id="apellidos" name="apellidos" placeholder="Apellidos" class="form-control input-line" required>
                </div>
                <div class="col-md-12 mb-2"> 
                    <label for="fechanacimiento">Fecha de nacimiento</label>
                </div>
                <div class="col-md-12 mb-2 text-center"> 
                    <input type="date" id="fechanacimiento" name="fechanacimiento" class="form-control input-line" required>
                </div>
              </div>
            </div>
            <div class="col-md-12 mb-2"> 
                <label for="numerofederado">Número de federación (si estas federado)</label>
            </div>
            <div class="col-md-12 mb-2 text-center"> 
                <input type="text" id="numerofederado" name="numerofederado" placeholder="NumFederado" class="form-control input-line">
            </div>
            <div class="col-md-12 text-center mt-3">
                <button type="submit" class="btn btn-primary registerButton">Registrarse</button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </body>
</html>