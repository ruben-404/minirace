<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
</head>
<body>
    <header>
        <h1>Panel de Administración</h1>
        <nav>
            <ul>
                <li><a href="#">Salir</a></li>
                <li</li>

                <button id="toggleSidebar" class="btn btn-link mb-2">
                <i class="fas fa-bars"></i> <!-- Icono de barras -->
            </button>
            </ul>
        </nav>
    </header>

    @yield('content')
</body>
</html>
