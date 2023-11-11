

import Dropzone from 'dropzone';

document.addEventListener('DOMContentLoaded', () => {

    if (document.querySelector('#dropzone')) {
        Dropzone.autoDiscover = false;

        const dropzone = new Dropzone('div#dropzone', {
            url: '/imagenes/store',
            dictDefaultMessage: 'Sube hasta 10 imágenes',
            maxfiles: 10,
            required: true,
            acceptedFiles: ".png,.jpg,.jpeg,.gif",
            addRemoveLinks: true,
            dictRemoveFile: "Eliminar Imagen",
            headers: {
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
            },
            init: function () {
                //se llama al inicio de la carga de la página para verificar si existe imagenes para el elemento dropzone (usado en forms vies y edit)
                const galeria = document.querySelectorAll('.galeria'); //inputs hidden con los nombres de las imagenes obtenidos desde el controller
                //console.log(galeria);

                //obtenenmos las imagenes
                if(galeria.length > 0){
                    galeria.forEach(imagen =>{
                        //console.log(imagen.value);
                        const imagenPublicada = {};
                        imagenPublicada.size = 1; //si no se guarda el tamaño de la imagen se tiene que poner un size por defecto.
                        imagenPublicada.name = imagen.value;
                        //se agrega el nombre del "servidor" para que dropzone se comunique internamente
                        imagenPublicada.nombreServidor = imagen.value;

                        //agregamos la imagen a dropzone
                        this.options.addedfile.call(this, imagenPublicada);
                        this.options.thumbnail.call(this, imagenPublicada, `/storage/${imagenPublicada.name}`);
                        //si el thumbnail se ve con mucho zoom se tiene que actualizar el scss resources/sass/establecimientos.scss con las clases 
                        // dropzone .dz-preview .dz-image img {
                        //    display: block;
                        //    object-fit: scale-down;
                        //    width: 200px;
                        // }

                        //mostramos los iconos de que las imagenes se subieron correctamente, para evitar se vea la barra de carga en el thumbnail
                        imagenPublicada.previewElement.classList.add('dz-success');
                        imagenPublicada.previewElement.classList.add('dz-complete');
                    })
                }
            },
            success: function (file, respuesta) {
                //console.log(file);
                console.log(respuesta);
                file.nombreServidor = respuesta.archivo;
            },
            sending: function (file, xhr, formData) {
                formData.append('uuid', document.querySelector('#uuid').value)
                // console.log('enviando');
            },
            removedfile: function (file, respuesta) {
                console.log(file);

                const params = {
                    imagen: file.nombreServidor,
                    uuid: document.querySelector('#uuid').value
                }
                axios.post('/imagenes/destroy', params)
                    .then(respuesta => {
                        console.log(respuesta)

                        //Eliminar del DOM
                        file.previewElement.parentNode.removeChild(file.previewElement);
                    })
            }

        });
    }
})

