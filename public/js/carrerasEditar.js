document.addEventListener("DOMContentLoaded", function() {
    // Escuchar el evento drop en todo el documento
    document.addEventListener('drop', drop);

    // Cancelar la propagación del evento dragover en todo el documento
    document.addEventListener('dragover', function(event) {
        event.preventDefault();
        event.stopPropagation();
    });
});

// function drop(event) {
//     event.preventDefault();

//     // Obtener el archivo (o archivos) soltado(s)
//     var files = event.dataTransfer.files;

//     // Verificar si se soltaron archivos
//     if (files.length > 0) {
//         // Iterar sobre cada archivo
//         for (var i = 0; i < files.length; i++) {
//             var file = files[i];

//             // Verificar si el archivo es una imagen
//             if (file.type.startsWith('image/')) {
//                 // Crear un objeto URL para la imagen
//                 var imageUrl = URL.createObjectURL(file);

//                 // Crear un elemento imagen y establecer su src en la URL del objeto
//                 var img = new Image();
//                 img.src = imageUrl;

//                 // Aplicar una clase CSS de Bootstrap para hacer que la imagen sea pequeña
//                 img.classList.add('img-thumbnail');

//                 // Agregar la imagen al área de soltar
//                 document.getElementById('dropzone').appendChild(img);

//                 // Actualizar el contador de imágenes
//                 var imageCount = document.querySelectorAll('img').length;
//                 document.getElementById('imageCount').innerText = "Número de imágenes: " + imageCount;
//             }
//         }
//     }
// }
function drop(event) {
    event.preventDefault();

    // Obtener el área de soltar y el formulario
    var dropzone = document.getElementById('dropzone');
    var form = document.querySelector('form');

    // Obtener los archivos (imágenes) que se soltaron
    var files = event.dataTransfer.files;

    // Verificar si se soltaron archivos
    if (files.length > 0) {
        // Iterar sobre cada archivo
        for (var i = 0; i < files.length; i++) {
            var file = files[i];

            // Verificar si el archivo es una imagen
            if (file.type.startsWith('image/')) {
                // Crear un objeto URL para la imagen
                var imageUrl = URL.createObjectURL(file);

                // Crear un elemento imagen y establecer su src en la URL del objeto
                var img = new Image();
                img.src = imageUrl;
                img.classList.add('img-thumbnail');
                // Agregar la imagen al área de soltar
                dropzone.appendChild(img);

                // Crear un campo de tipo input oculto para almacenar la imagen como archivo
                var input = document.createElement('input');
                input.type = 'hidden';
                // input.name = 'images[]'; // Usar un array para almacenar múltiples imágenes
                input.name = 'imgCarrera[]'; // Usar el mismo nombre que en el formulario
                input.id = 'imgCarrera'; // Usar el mismo id que en el formulario
                input.value = imageUrl;

                // Agregar el campo de input al formulario
                form.appendChild(input);
            }
        }
    }
}
