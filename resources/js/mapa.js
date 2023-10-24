document.addEventListener('DOMContentLoaded', () => {

    if (document.querySelectorAll('#mapa')) {
        const lat = 18.5030595;
        const lng = -88.2947664;

        const map = L.map('mapa').setView([lat, lng], 16);

        L.tileLayer('https://tile.openstreetmap.org/{z}/{x}/{y}.png', {
            maxZoom: 19,
            attribution: '&copy; <a href="http://www.openstreetmap.org/copyright">OpenStreetMap</a>'
        }).addTo(map);

        let marker;

        marker = new L.Marker([lat, lng], {
            draggable: true,
            autoPan: true
        }).addTo(map);

//Geocode Service
const geocodeService = L.esri.Geocoding.geocodeService();

        //detectar movimiento
        marker.on('moveend', function(e){
            marker = e.target;

            const posicion = marker.getLatLng();

            //centrar automaticamente
            map.panTo(new L.LatLng(posicion.lat, posicion.lng));

            //ReverseGeocoding, cuando el usuario reubica el pin
            geocodeService.reverse().latlng(posicion, 16).run(function(error, resultado){
                console.log(error);
                console.log(resultado);
            });

        })
    }

})