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
    <link rel="stylesheet" href="{{ asset('css/styles.css') }}">

</head>
<body>
    <!-- Aquí puedes agregar el encabezado del panel de administración -->
    <header class="navbar navbar-dark bg-dark">
        <div class="container d-flex justify-content-between align-items-center">

            <a class="navbar-brand" href="#"><div class="container d-flex justify-content-between align-items-center">
            <button id="toggleSidebar" class="btn btn-link mb-2 text-white">
                <i class="fas fa-bars"></i> <!-- Icono de barras -->
            </button>  Panel de Administración</a>
            <nav>
                <ul>
                    <li><a class="text-white text-decoration-none" href="{{ route('admin.logout') }}">Salir</a></li>
                </ul>
            </nav>
        </div>
    </header>
</body>
</html>
