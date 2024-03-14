<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Panel de Administración</title>
    <!-- Enlaza a los archivos de Bootstrap desde el CDN -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link rel="stylesheet" href="{{ asset('css/principal.css') }}">
</head>
<body>
    <header class="navbar navbar-dark bg-black py-3">
        <div class="container-fluid d-flex justify-content-between align-items-center">
    
            <button class="navbar-toggler d-md-none" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasExample" aria-controls="offcanvasExample">
                <span class="navbar-toggler-icon"></span>
            </button>

            <img src="{{ asset('resources/icons/Logo.png') }}" class="logo img-fluid" alt="Logo Sponsor">

            <nav class="navbar navbar-expand headerNav2 d-none d-md-flex"><!-- Oculta en dispositivos pequeños -->
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link text-white">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-white">Carreras</a>
                    </li>
                </ul>
            </nav>

            <nav class="navbar navbar-expand headerNav d-none d-md-flex"><!-- Oculta en dispositivos pequeños -->
                <ul class="navbar-nav ml-auto">
                    <li class="nav-item">
                        <a class="nav-link text-white btn btn-primary btn-no-socio">Iniciar sesión</a>
                    </li>
                    <li class="nav-item iniciarSesionNav">
                        <a class="nav-link text-white btn-danger btn btn-socio">No eres socio?</a>
                    </li>
                </ul>
            </nav>

        </div>
    </header>

    <div class="offcanvas offcanvas-start" tabindex="-1" id="offcanvasExample" aria-labelledby="offcanvasExampleLabel">
        <div class="offcanvas-header">
            <h5 class="offcanvas-title" id="offcanvasExampleLabel">Menú</h5>
            <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button>
        </div>
        <div class="offcanvas-body">
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link">Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link">Carreras</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link">Iniciar sesión</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link">No eres socio?</a>
                </li>
            </ul>
        </div>
    </div>  
</body>
</html>
