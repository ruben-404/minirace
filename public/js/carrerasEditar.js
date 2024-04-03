document.addEventListener("DOMContentLoaded", function() {
    // Escuchar el evento drop en todo el documento
    document.addEventListener('drop', drop);

    // Cancelar la propagación del evento dragover en todo el documento
    document.addEventListener('dragover', function(event) {
        event.preventDefault();
        event.stopPropagation();
    });
});

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

            console.log(file)
            if (file.type.startsWith('image/')) {
                var imageUrl = URL.createObjectURL(file);

                // Crear un elemento imagen y establecer su src en la URL del objeto
                var img = new Image();
                img.src = imageUrl;
                img.classList.add('img-thumbnail');
                // Agregar la imagen al área de soltar
                dropzone.appendChild(img);

                // Crear un campo de tipo input de archivo para almacenar la imagen como archivo
                var input = document.createElement('input');
                input.type = 'file';
                input.name = 'imgCarrera[]'; // Usar el mismo nombre que en el formulario
                input.id = 'imgCarrera'; // Usar el mismo id que en el formulario
                
                // Crear un objeto FileList con el archivo y asignarlo al input
                var fileList = new DataTransfer();
                fileList.items.add(file);
                input.files = fileList.files;

                // Agregar el campo de input al formulario
                form.appendChild(input);


                var inputValue = document.getElementById('imgCarrera').value;
            }
        
        }
    }
}
