
//paquetes a utilizar
//Esri Leaflet para reverse geocode: https://developers.arcgis.com/esri-leaflet/geocode-and-search/reverse-geocode/
//leaflet GeoSearch: https://github.com/smeijer/leaflet-geosearch

// import
import L from 'leaflet';
import { OpenStreetMapProvider } from 'leaflet-geosearch';
const provider = new OpenStreetMapProvider();


document.addEventListener('DOMContentLoaded', () => {

    if (document.querySelectorAll('#mapa')) {

        const lat = 18.5030595;
        const lng = -88.2947664;

        const map = L.map('mapa').setView([lat, lng], 16);

        //eliminar marcadores previos
        let markers = new L.FeatureGroup().addTo(map);

        L.tileLayer('https://tile.openstreetmap.org/{z}/{x}/{y}.png', {
            maxZoom: 19,
            attribution: '&copy; <a href="http://www.openstreetmap.org/copyright">OpenStreetMap</a>'
        }).addTo(map);

        //agregar el marcador 
        let marker;
        marker = new L.Marker([lat, lng], {
            draggable: true,
            autoPan: true
        }).addTo(map);

        //aregar el marcador a la capa de marcadores
        markers.addLayer(marker);

        const apiKey = "AAPK8d111599842942be811bbeb3734a3215N5gV88mq8l2damroUHjKJxuUZDc2K6xlojdbax9UpI-qHn_uEYH0_U2yPW0AQAR2";

        //Geocode Service
        const geocodeService = L.esri.Geocoding;

        //buscador de direcciones
        const buscador = document.querySelector('#formbuscador');
        buscador.addEventListener('blur', buscarDireccion);

        reubicarMarker(marker);



        function reubicarMarker(marker) {
            //detectar movimiento
            marker.on('moveend', function (e) {
                marker = e.target;

                const posicion = marker.getLatLng();

                //centrar automaticamente
                map.panTo(new L.LatLng(posicion.lat, posicion.lng));

                //ReverseGeocoding, cuando el usuario reubica el pin
                //L.esri.Geocoding
                geocodeService
                    .reverseGeocode({
                        apikey: apiKey
                    })
                    .latlng(posicion, 16)
                    .run(function (error, resultado) {
                        //console.log(error);
                        //console.log(resultado.address);
                        marker.bindPopup(resultado.address.LongLabel);
                        marker.openPopup();

                        //llenar los campos
                        llenarInputs(resultado);
                    });
            })
        }




        function buscarDireccion(e) {

            if (e.target.value.length > 1) {
                provider.search({ query: e.target.value + ' Chetumal MX ' })
                    .then(resultado => {
                        if (resultado) {

                            ///limpiar los marcadores previos
                            markers.clearLayers();

                            //ReverseGeocoding, cuando el usuario reubica el pin
                            //L.esri.Geocoding
                            geocodeService
                                .reverseGeocode({
                                    apikey: apiKey
                                })
                                .latlng(resultado[0].bounds[0], 16)
                                .run(function (error, resultado) {
                                    //llenar los inputs
                                    llenarInputs(resultado);

                                    //centrar el mapa
                                    map.setView(resultado.latlng);

                                    //agregar el pin

                                    marker = new L.Marker(resultado.latlng, {
                                        draggable: true,
                                        autoPan: true
                                    }).addTo(map);

                                    //asignar el contenedor de markers el nuevo pin
                                    markers.addLayer(marker);

                                    //mover el pin
                                    reubicarMarker(markers)

                                });

                        }
                    })
                    .catch(error => {
                        //console.log(error);
                        
                    })
            }
        }


        function llenarInputs(resultado) {
            console.log(resultado);
            document.querySelector('#direccion').value = resultado.address.Address || '';
            document.querySelector('#colonia').value = resultado.address.City || '';
            document.querySelector('#lat').value = resultado.latlng.lat || '';
            document.querySelector('#lng').value = resultado.latlng.lng || '';

        }

    }

})