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
  <div class="container footer-column-left footercolumn">
    <div class="footerelement">
      <img src="{{ asset('resources/icons/Logo.png') }}" class="logofooter img-fluid" alt="Logo Sponsor">
      <p class="d-lg-none info">Tu destino para experimentar la emoción de las carreras de coches teledirigidos a otro nivel</p>
      <p class="d-none d-lg-block infoblock">Tu destino para experimentar la emoción de las carreras de coches teledirigidos a otro nivel</p>
    </div>
  </div>
  <div class="container footer-column-right footercolumn">
    <div class="footerelement">
      <p class='titlefooter'>CONTÁCTANOS</p>
      <address class="d-lg-none address-footer-mini">
        <strong>A108 Adam Street</strong><br>
        New York, NY 535022<br>
        United States<br>
        <abbr title="Phone">Phone:</abbr> +1 5589 55488 55<br>
        <abbr title="Email">Email:</abbr> info@example.com
      </address>
      <address class="d-none d-lg-block address-footer">
        <strong>A108 Adam Street</strong><br>
        New York, NY 535022<br>
        United States<br>
        Phone: +1 5589 55488 55<br>
        Email: info@example.com
      </address>
    </div>
  </div>
</footer>
</body>