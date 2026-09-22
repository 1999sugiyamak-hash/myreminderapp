    
function createMap(){
    const center = {
        lat: 35.7379, 
        lng: 139.6543,
    };
    const options = {
        zoom: 17,
        center: center,
    }
    const map = new google.maps.Map(document.getElementById("map"), options);
}

function displayGoogleMap() {
    if(window.google && window.google.maps){
        createMap();
    }
}

const mapElement = document.getElementById("map");
if(mapElement) displayGoogleMap();