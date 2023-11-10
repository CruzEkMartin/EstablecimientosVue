<template>
    <div class="mapa">
        <l-map v-model:zoom="zoom" :center="center" :options="mapOptions" :use-global-leaflet="false">
            <l-tile-layer :url="url" :attribution="attribution" />
            <l-marker v-for="establecimiento in establecimientos" 
                        v-bind:key="establecimiento.id"
                        :lat-lng="obtenerCoordenadas(establecimiento)" 
                        :icon="iconoEstablecimiento(establecimiento)"
                        @click="redireccionar(establecimiento.id)"
                        >
                <l-tooltip>
                    <div>
                        {{ establecimiento.nombre }} - {{ establecimiento.categoria.nombre }}
                    </div>
                </l-tooltip>
            </l-marker>
        </l-map>
    </div>
</template>

<script>
import { store } from '@/store'
import L from 'leaflet';
import { latLng } from 'leaflet';
import { LMap, LTileLayer, LMarker, LTooltip, LIcon } from '@vue-leaflet/vue-leaflet';
import { watch, computed } from "vue";

export default {
    components: {
        LMap,
        LTileLayer,
        LMarker,
        LTooltip,
        LIcon
    },
    data() {
        return {
            zoom: 13,
            center: latLng(18.5030595, -88.2947664),
            //url: "https://server.arcgisonline.com/ArcGIS/rest/services/World_Imagery/MapServer/tile/{z}/{y}/{x}",
            url: "https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png",
            attribution: '&copy; <a href="http://www.openstreetmap.org/copyright">OpenStreetMap</a>',
            currentZoom: 11.5,
            currentCenter: latLng(18.5030595, -88.2947664),
            showParagraph: false,
            mapOptions: {
                zoomSnap: 0.5
            },
            showMap: true
        };
    },
    created() {
        axios.get('api/establecimientos')
            .then(respuesta => {
                //console.log(respuesta.data)
                store.commit('AGREGAR_ESTABLECIMIENTOS', respuesta.data)
            })
    },
    computed: {
        establecimientos() {
            return store.getters.obtenerEstablecimientos
        }
    },
    methods: {
        obtenerCoordenadas(establecimiento) {
            return {
                lat: establecimiento.lat,
                lng: establecimiento.lng
            }
        },
        iconoEstablecimiento(establecimiento) {
            //console.log(establecimiento.categoria.slug)
            const { slug } = establecimiento.categoria;

            return L.icon({
                iconSize: [40, 50],
                iconUrl: `images/iconos/${slug}.png`,
            })
        },
        redireccionar(id) {
            this.$router.push({name: 'establecimiento', params: { id }})
        }
    },

    setup() {
        //const store = useStore();

        //si se selecciona un elemento del menu obtenemos los establecimientos
        watch(() => store.state.categoria, function () {
            //console.log('value changes detected');
            axios.get('/api/' + store.getters.obtenerCategoria)
                .then(respuesta => {
                    //console.log(respuesta)
                    store.commit('AGREGAR_ESTABLECIMIENTOS', respuesta.data)
                })
        });

        return {
            myvalue: computed(() => store.state.categoria)
        }
    },

}
</script>


<style scoped>
@import 'https://unpkg.com/leaflet@1.9.4/dist/leaflet.css';

.mapa {
    height: 600px;
    width: 100%;
}
</style>