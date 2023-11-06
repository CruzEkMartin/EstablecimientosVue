<template>
    <div class="mapa">
        <l-map :zoom="zoom" :center="center" :options="mapOptions">
            <l-tile-layer :url="url" :attribution="attribution"></l-tile-layer>

            <l-marker :latLng="{lat, lng}">
                <l-tooltip>

                </l-tooltip>
            </l-marker>
        </l-map>
    </div>
</template>

<script>
import { store } from '../store'
import { latLng } from 'leaflet';
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
            attribution:
                '&copy; <a href="http://osm.org/copyright">OpenStreetMap</a> contributors',
            currentZoom: 11.5,
            mapOptions: {
                zoomSnap: 0.5
            },
            showMap: true,
            lat: "",
            lng: ""
        };
    },
    created(){
        console.log(store.getters.obtenerEstablecimiento.lat);
        this.lat = store.getters.obtenerEstablecimiento.lat;
        this.lng = store.getters.obtenerEstablecimiento.lng;
    }
}
</script>n

<style scoped>
@import 'https://unpkg.com/leaflet@1.9.4/dist/leaflet.css';

.mapa {
    height: 300px;
    width: 100%;
}
</style>