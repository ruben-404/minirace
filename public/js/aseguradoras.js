$(document).ready(function() {
    // Evento de clic en el botón que carga los detalles de la carrera en el modal
    $('.btn-ver-detalles-aseguradora').click(function() {
        var cif = $(this).data('cif');
        var nom = $(this).data('nom');
        var preu = $(this).data('preucursa');
        var direccion = $(this).data('direccion');
        var logo = $(this).data('logo');
        $('#modalAseguradora').html(`
            <h1 class='modal-title text-center align-middle'>Detalles ${cif}</h1>
            <img class='text-center align-middle' width="200" height="200" src="../storage/asseguradoresImages/${logo}" alt="Logo asseguradora">
        `);
        $('#carrerasAseguradas').html(`
            <table class="table">
                <tr>
                    <th class="text-center align-middle">CIF</th>
                    <th class="text-center align-middle">Nombre</th>
                    <th class="text-center align-middle">Precio en carrera</th>
                    <th class="text-center align-middle">Direccion</th>
                </tr>
                <tr>
                    <td class="text-center align-middle">${cif}</td>
                    <td class="text-center align-middle">${nom}</td>
                    <td class="text-center align-middle">${preu} €</td>
                    <td class="text-center align-middle">${direccion}</td>
                </tr>
            </table>
        `);
        $('#tablaModalAseguradora').modal('show');
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
