$(document).ready(function() {
    document.getElementById('btn-add').addEventListener('click', function() {
        window.location.href = "{{ route('addCarreras') }}";
    });
    // Evento de clic en el botón que carga los detalles de la carrera en el modal
    $('.btn-ver-detalles').click(function() {
        // Obtener los datos de la carrera del botón que fue clicado
        var desnivel = $(this).data('desnivel');
        var imagenMapa = $(this).data('imagen-mapa');
        var km = $(this).data('km');
        var puntoSalida = $(this).data('punto-salida');
        var cartelPromocion = $(this).data('cartel-promocion');

        // Llenar la tabla del modal con los datos de la carrera
        $('#detallesCarreraBody').html('');
        $('#detallesCarreraBody').append('<tr><td>' + desnivel + '</td><td>' + imagenMapa + '</td><td>' + km + '</td><td>' + puntoSalida + '</td><td>' + cartelPromocion + '</td></tr>');

        // Mostrar el modal
        $('#tablaModal').modal('show');
    });
});