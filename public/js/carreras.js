$(document).ready(function() {
    document.getElementById('btn-add').addEventListener('click', function() {
        window.location.href = "{{ route('addCarreras') }}";
    });
    // Evento de clic en el botón que carga los detalles de la carrera en el modal
    $('.btn-ver-detalles').click(function() {
        console.log("hola");
        // Obtener los datos de la carrera del botón que fue clicado
        var id = $(this).data('id');
        var desnivel = $(this).data('desnivel');
        var imagenMapa = $(this).data('imagen-mapa');
        var km = $(this).data('km');
        var puntoSalida = $(this).data('punto-salida');
        var cartelPromocion = $(this).data('cartel-promocion');
        var descripcion = $(this).data('descripcion');
        var url = $(this).data('url');

        //fotos
        $('#cartel').html('<img src="../storage/carrerasImages/' + cartelPromocion + '" alt="Cartel de Paaromoción" class="img-fluid mx-auto d-block" style="max-width: 500px; height: 200px;">');
        //$('#mapa').html('<img src="../storage/carrerasImages/' + imagenMapa + '" alt="Cartel de Paaromoción" class="img-fluid mx-auto d-block" style="max-width: 270px; height: 200px;">');
        $('#mapa').html(`
            <div class="accordion-item">
                <h2 class="accordion-header" id="flush-headingTwo">
                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseTwo" aria-expanded="false" aria-controls="flush-collapseTwo">
                        Mapa
                    </button>
                </h2>
                <div id="flush-collapseTwo" class="accordion-collapse collapse" aria-labelledby="flush-headingTwo" data-bs-parent="#accordionFlushExample">
                    <div class="accordion-body">
                        <img src="../storage/carrerasImages/${imagenMapa}" alt="Mapa" class="img-fluid mx-auto d-block" style="max-width: 270px; height: 200px;">
                    </div>
                </div>
            </div>
        `);
        //descripcion
        $('#descripcion').html(`
            <div class="accordion-item">
                <h2 class="accordion-header" id="flush-headingOne">
                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseOne" aria-expanded="false" aria-controls="flush-collapseOne">
                        Descripcion
                    </button>
                </h2>
                <div id="flush-collapseOne" class="accordion-collapse collapse" aria-labelledby="flush-headingOne" data-bs-parent="#accordionFlushExample">
                    <div class="accordion-body">${descripcion}</div>
                </div>
            </div>
        `);

        // Llenar la tabla del modal con los datos de la carrera
        $('#detallesCarreraBody').html('');
        $('#detallesCarreraBody').append('<tr><td>' + desnivel + '</td><td>' + km + '</td><td>' + puntoSalida + '</td><td><button id="btn-editar-carrera" class="btn btn-info btn-editar">Editar</button></td></tr>');

        $('#btn-editar-carrera').click(function() {
            // Redireccionar a la página de edición
            window.location.href = url;
        });
        // Mostrar el modal
        $('#tablaModal').modal('show');
    });
});

document.addEventListener('DOMContentLoaded', function() {
    const toggleSidebarButton = document.getElementById('toggleSidebar');
    const toggleSidebarButton1 = document.getElementById('toggleSidebar1');
    const sidebar = document.querySelector('.flex-column');

    toggleSidebarButton.addEventListener('click', function() {
        sidebar.classList.toggle('d-none');
    });
    toggleSidebarButton1.addEventListener('click', function() {
        sidebar.classList.toggle('d-none');
    });
});

// $(document).ready(function() {
//     $('#busqueda').on('keyup', function() {
//         var query = $(this).val();
//         var url = $('#buscar-carreras-url').data('url');

//         $.ajax({
//             url: url,
//             method: 'GET',
//             data: {query: query},
//             success: function(response) {
//                 // Reemplazar el contenido del tbody
//                 $('#tabla-carreras tbody').html(response);
//             },
//             error: function(xhr, status, error) {
//                 console.error(error);
//             }
//         });
//     });
// });

$(document).ready(function() {
    $('#busqueda').on('keyup', function() {
        var query = $(this).val();
        var url = $('#buscar-carreras-url').data('url');

        $.ajax({
            url: url,
            method: 'GET',
            data: {query: query},
            success: function(response) {
                // Reemplazar el contenido del div tbodyCont con los resultados de la búsqueda
                $('.tbodyCont').html(response);
            },
            error: function(xhr, status, error) {
                console.error(xhr);
            }
        });
    });
});


