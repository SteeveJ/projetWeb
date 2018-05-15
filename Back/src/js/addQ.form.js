// steaTODO: DRISS - verifier si les valeurs des champs son correct et affiche une erreur en rouge
let myRmap = new L.Map('Rmapid');
myRmap.setView([51.505, -0.09], 13);

L.tileLayer('https://api.tiles.mapbox.com/v4/{id}/{z}/{x}/{y}.png?access_token={accessToken}', {
    attribution: 'Map data &copy; <a href="http://openstreetmap.org">OpenStreetMap</a> contributors, <a href="http://creativecommons.org/licenses/by-sa/2.0/">CC-BY-SA</a>, Imagery © <a href="http://cloudmade.com">CloudMade</a>',
    maxZoom: 18,
    id: 'mapbox.light',
    accessToken: 'pk.eyJ1Ijoic2t5cm8iLCJhIjoiY2poNmV6ejNvMTlneDJxbGYzeTdya2JucyJ9.qyocW9FTx8QmAv3p4HBXaA'
}).addTo(myRmap);

function onMapRClick(e) {
    document.getElementById("latitudeR").value=e.latlng.lat;
    document.getElementById("longitudeR").value=e.latlng.lng;
}
myRmap.on('click', onMapRClick);


let myAmap = new L.Map('Amapid');
myAmap.setView([51.505, -0.09], 13);

L.tileLayer('https://api.tiles.mapbox.com/v4/{id}/{z}/{x}/{y}.png?access_token={accessToken}', {
    attribution: 'Map data &copy; <a href="http://openstreetmap.org">OpenStreetMap</a> contributors, <a href="http://creativecommons.org/licenses/by-sa/2.0/">CC-BY-SA</a>, Imagery © <a href="http://cloudmade.com">CloudMade</a>',
    maxZoom: 18,
    id: 'mapbox.light',
    accessToken: 'pk.eyJ1Ijoic2t5cm8iLCJhIjoiY2poNmV6ejNvMTlneDJxbGYzeTdya2JucyJ9.qyocW9FTx8QmAv3p4HBXaA'
}).addTo(myAmap);

function onMapAClick(e) {
    document.getElementById("latitudeMap").value=e.latlng.lat;
    document.getElementById("longitudeMap").value=e.latlng.lng;
}
myAmap.on('click', onMapAClick);


