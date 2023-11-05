<template>
    <div class="container my-5">
        <h2 class="text-center mb-5">{{ establecimiento.nombre }}</h2>

        <div class="row align-items-start">
            <div class="col-md-8">
                <img :src="`../storage/${establecimiento.imagen_principal}`" alt="imagen establecimiento">
                <p class="mt-5">
                    {{ establecimiento.descripcion }}
                </p>
            </div>

            <aside class="col-md-4 ">
                <div>
                    <mapa-ubicacion></mapa-ubicacion>
                </div>

                <div class="p-4 bg-primary">
                    <h2 class="text-center text-white mt-2 mb-4">
                        Más Información
                    </h2>

                    <p class="text-white mt-1">
                        <span class="fw-bold">
                            Ubicación:
                        </span>
                        {{ establecimiento.direccion }}
                    </p>

                    <p class="text-white mt-1">
                        <span class="fw-bold">
                            Colonia:
                        </span>
                        {{ establecimiento.colonia }}
                    </p>

                    <p class="text-white mt-1">
                        <span class="fw-bold">
                            Horario:
                        </span>
                        {{ establecimiento.apertura }} - {{ establecimiento.cierre }}
                    </p>

                    <p class="text-white mt-1">
                        <span class="fw-bold">
                            Teléfono:
                        </span>
                        {{ establecimiento.telefono }}
                    </p>

                </div>
            </aside>
        </div>
    </div>
</template>

<script>

import { store } from '../store'
import MapaUbicacion from './MapaUbicacion.vue'

export default {

    components: {
        MapaUbicacion
    },
    //cuando se monte el componente se hace una llamada al backend para obtener los datos de la categoria
    mounted() {
        //consultamos al backend
        //console.log(this.$route.params);
        const { id } = this.$route.params
        axios.get('/api/establecimientos/' + id)
            .then(respuesta => {
                //console.log(respuesta.data)
                store.commit('AGREGAR_ESTABLECIMIENTO', respuesta.data)
            })
    },
    computed: {
        establecimiento() {
            //se trae los valores del state para trabajarlos en el template
            return store.getters.obtenerEstablecimiento;
        }
    }

}

</script>