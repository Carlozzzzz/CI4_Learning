const api_url = 'https://api.wheretheiss.at/v1/satellites/25544';
const lat = document.getElementById("lat");
const long = document.getElementById("long");
const velo = document.getElementById("velocity");
let firstTime = true;

// Initialize the Map and tiles
const myMap = L.map('issMap').setView([0, 0], 1);
const attribution =  '&copy; <a href="http://www.openstreetmap.org/copyright">OpenStreetMap</a>';
const tileUrl = 'https://tile.openstreetmap.org/{z}/{x}/{y}.png';
const tiles = L.tileLayer(tileUrl, {attribution});
tiles.addTo(myMap);

// Initialize Marker with custom icon
const issIcon = L.icon({
    iconUrl: "<?= base_url('assets/img/issLogo.png') ?>",
    iconSize: [55, 32],
    iconAnchor: [25, 16],
});
const marker = L.marker([0, 0], { icon : issIcon }).addTo(myMap);

async function getISS(){
    const response = await fetch (api_url);
    const data = await response.json();
    const { latitude, longitude, velocity } = data;  // destructuring

    marker.setLatLng([latitude, longitude]);
    if(firstTime)
    {
        myMap.setView([latitude, longitude], 2);
        firstTime = false;
    }
    lat.textContent = latitude;
    long.textContent = longitude;
    velo.textContent = velocity;

}

// Start the Application
getISS();
setInterval(getISS, 2000);














// JSON
/**
 * same as javascript objects and array 
 */