// steaTODO: DRISS - verifier si les valeurs des champs son correct et affiche une erreur en rouge
let myRmap = new L.Map('Rmapid');
myRmap.setView([51.505, -0.09], 13);

L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
    maxZoom: 19,
    attribution: '&copy; <a href="http://www.openstreetmap.org/copyright">OpenStreetMap</a>'
}).addTo(myRmap);

function onMapRClick(e) {
    document.getElementById("latitudeR").value=e.latlng.lat;
    document.getElementById("longitudeR").value=e.latlng.lng;
}
myRmap.on('click', onMapRClick);


let myAmap = new L.Map('Amapid');
myAmap.setView([51.505, -0.09], 13);

L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
    maxZoom: 19,
    attribution: '&copy; <a href="http://www.openstreetmap.org/copyright">OpenStreetMap</a>'
}).addTo(myAmap);

function onMapAClick(e) {
    document.getElementById("latitudeMap").value=e.latlng.lat;
    document.getElementById("longitudeMap").value=e.latlng.lng;
}
myAmap.on('click', onMapAClick);


