<template>
    <div class="mapa">
        <l-map ref="mapa" v-model:zoom="zoom" :center="center" :options="mapOptions">
            <l-tile-layer :url="url" :attribution="attribution" />

            <l-marker :lat-lng="{ lat, lng }">
                <l-tooltip>
                    <div>{{ establecimiento.nombre }}</div>
                </l-tooltip>
            </l-marker>
        </l-map>
    </div>
</template>

<script>
import { store } from '@/store'
import { L, latLng } from 'leaflet';
import "leaflet/dist/leaflet.css";
import { LMap, LTileLayer, LMarker, LTooltip } from '@vue-leaflet/vue-leaflet';


export default {
    components: {
        LMap,
        LTileLayer,
        LMarker,
        LTooltip
    },
    data() {
        return {
            zoom: 16,
            center: latLng(18.5030595, -88.2947664),
            url: "https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png",
            attribution: '&copy; <a href="http://www.openstreetmap.org/copyright">OpenStreetMap</a>',
            currentZoom: 11.5,
            mapOptions: {
                zoomSnap: 0.5
            },
            showMap: true,
            lat: "",
            lng: ""
        };
    },
    created() {
        setTimeout(() => {
            this.lat = store.getters.obtenerEstablecimiento.lat;
            this.lng = store.getters.obtenerEstablecimiento.lng;
            this.center = latLng(this.lat, this.lng);
        }, 300);
    },
    computed: {
        establecimiento() {
            //se trae los valores del state para trabajarlos en el template
            return store.getters.obtenerEstablecimiento;
        }
    }

}
</script>

<style scoped>
@import 'https://unpkg.com/leaflet@1.9.4/dist/leaflet.css';

.mapa {
    height: 300px;
    width: 100%;
}
</style>