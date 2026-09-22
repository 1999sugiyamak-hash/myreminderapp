
function createMap() {
    const center = {
        lat: 35.7379,
        lng: 139.6543,
    };
    const options = {
        zoom: 17,
        center: center,
    }
    const map = new google.maps.Map(document.getElementById("map"), options);

    let marker = null;
    map.addListener('click', function (e) {

        // Round lat and lng to 7 decimal places 
        const shift = 10 ** 7;
        const latitude = Math.floor(e.latLng.lat() * shift) / shift;
        const longitude = Math.floor(e.latLng.lng() * shift) / shift;

        document.getElementById('latitude').value = latitude;
        document.getElementById('longitude').value = longitude;

        // Put marker on Google map
        if (marker) {
            marker.setPosition(e.latLng);
        } else {
            marker = new google.maps.Marker({
                position: e.latLng,
                map: map,
            })
        }
        console.log('latitude:', latitude);
        console.log('longitude:', longitude);
    })
}

function displayGoogleMap() {
    if (window.google && window.google.maps) {
        createMap();
    }
}

const mapElement = document.getElementById("map");
if (mapElement) displayGoogleMap();

