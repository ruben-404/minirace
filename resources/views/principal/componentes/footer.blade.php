<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Enlaza a los archivos de Bootstrap desde el CDN -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/styles.css') }}">
</head>
<body>
  <footer class="footer">
    <div class="container footer-column">
      <div class="footerelement">
        <img src="{{ asset('resources/icons/Logo.png') }}" class="logo img-fluid" alt="Logo Sponsor">
        <span>Columna 1</span>
      </div>
    </div>
    <div class="container footer-column">
      <div class="footerelement">
        <img src="{{ asset('resources/icons/Logo.png') }}" class="logo img-fluid" alt="Logo Sponsor">
        <span>Columna 1</span>
      </div>
    </div>
  </footer>
</body>