// steaTODO: DRISS - verifier si les valeurs des champs son correct et affiche une erreur en rouge
let myRmap = L.map('Rmapid').setView([51.505, -0.09], 13);

L.tileLayer('http://{s}.tile.cloudmade.com/e7b61e61295a44a5b319ca0bd3150890/997/256/{z}/{x}/{y}.png', {
    attribution: 'Map data &copy; <a href="http://openstreetmap.org">OpenStreetMap</a> contributors, <a href="http://creativecommons.org/licenses/by-sa/2.0/">CC-BY-SA</a>, Imagery © <a href="http://cloudmade.com">CloudMade</a>',
    maxZoom: 18
}).addTo(myRmap);

let myAmap = L.map('Amapid').setView([51.505, -0.09], 13);
L.tileLayer('http://{s}.tile.cloudmade.com/e7b61e61295a44a5b319ca0bd3150890/997/256/{z}/{x}/{y}.png', {
    attribution: 'Map data &copy; <a href="http://openstreetmap.org">OpenStreetMap</a> contributors, <a href="http://creativecommons.org/licenses/by-sa/2.0/">CC-BY-SA</a>, Imagery © <a href="http://cloudmade.com">CloudMade</a>',
    maxZoom: 18
}).addTo(myAmap);

function onMapRClick(e) {
    document.getElementById("latitudeR").value=e.latlng.lat;
    document.getElementById("longitudeR").value=e.latlng.lng;
}
myRmap.on('click', onMapRClick);

function onMapAClick(e) {
    document.getElementById("latitudeMap").value=e.latlng.lat;
    document.getElementById("longitudeMap").value=e.latlng.lng;
}
myAmap.on('click', onMapAClick);
