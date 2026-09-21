//
import 'leaflet/dist/leaflet.css';
import L from 'leaflet';

window.L = L;

const mapElement = document.getElementById("map");
console.log('js')
if(mapElement) {
    const map = L.map('map').setView([35.7379, 139.6543], 1);

    L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
        attribution: '&copy; OpenStreetMap contributors'
    }).addTo(map);

    map.on('click', function(e) {
        const latitude = e.latlng.lat;
        const longitude = e.latlng.lng;

        document.getElementById('latitude').value = latitude;
        document.getElementById('longitude').value = longitude;
    })
}