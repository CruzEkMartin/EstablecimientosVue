

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
            success: function (file, respuesta) {
                //console.log(file);
                console.log(respuesta);
                file.nombreServidor = respuesta.archivo;
            },
            sending: function (file, xhr, formData) {
                formData.append('uuid', document.querySelector('#uuid').value)
               // console.log('enviando');
            },
            removedfile: function(file, respuesta){
                console.log(file);

                const params = {
                    imagen: file.nombreServidor
                }
                axios.post('/imagenes/destroy', params)
                    .then( respuesta => {
                        console.log(respuesta)
                    })
            }

        });
    }
})

