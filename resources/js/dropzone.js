

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
            headers: {
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
            },
            success: function (file, respuesta) {
                //console.log(file);
                console.log(respuesta);
            },
            sending: function (file, xhr, formData) {
                formData.append('uuid', document.querySelector('#uuid').value)
               // console.log('enviando');
            }

            //se puede sustituir los eventos success y el sending con el siguiente codigo
            // init: function () {
            //     this.on("success", function (file, respuesta) {
            //         console.log(respuesta);
            //     });
            //     this.on("error", function (file, respuesta) {
            //         console.log("Error.");
            //     });
            //     this.on("sending", function (file, xhr, formData) {
            //         formData.append('uuid', document.querySelector('#uuid').value)
            //         console.log('enviando');
            //     });
            // }


        });
    }
})

