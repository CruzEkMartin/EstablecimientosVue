document.addEventListener('DOMContentLoaded', () => {

    if (document.querySelectorAll('#mapa')) {


        const map = L.map("mapa", {
            minZoom: 2
          })
    
          map.setView([34.02, -118.805], 13);
    
          const apiKey = "AAPK8d111599842942be811bbeb3734a3215N5gV88mq8l2damroUHjKJxuUZDc2K6xlojdbax9UpI-qHn_uEYH0_U2yPW0AQAR2";
    
          const basemapEnum = "arcgis/streets";
    
          L.esri.Vector.vectorBasemapLayer(basemapEnum, {
            apiKey: apiKey
          }).addTo(map);

          
        // const apiKey = "AAPK8d111599842942be811bbeb3734a3215N5gV88mq8l2damroUHjKJxuUZDc2K6xlojdbax9UpI-qHn_uEYH0_U2yPW0AQAR2";
        // const basemapEnum = "ArcGIS:Topographic"
        // const layer = L.esri.Vector.vectorBasemapLayer(basemapEnum, { apiKey: apiKey });

        // const lat = 18.5030595;
        // const lng = -88.2947664;

        // const map = L.map('mapa').setView([lat, lng], 16);

        // layer.addTo(map);

        // L.tileLayer('https://tile.openstreetmap.org/{z}/{x}/{y}.png', {
        //     maxZoom: 19,
        //     attribution: '&copy; <a href="http://www.openstreetmap.org/copyright">OpenStreetMap</a>'
        // }).addTo(map);

        // let marker;

        // marker = new L.Marker([lat, lng], {
        //     draggable: true,
        //     autoPan: true
        // }).addTo(map);

        // //Geocode Service
        // const geocodeService = L.esri.Geocoding.geocodeService();

        // //detectar movimiento
        // marker.on('moveend', function (e) {
        //     marker = e.target;

        //     const posicion = marker.getLatLng();

        //     //centrar automaticamente
        //     map.panTo(new L.LatLng(posicion.lat, posicion.lng));

        //     //ReverseGeocoding, cuando el usuario reubica el pin
        //     geocodeService.reverse().latlng(posicion, 16).run(function (error, resultado) {
        //         console.log(error);
        //         console.log(resultado);
        //     });

        // })

    }

})