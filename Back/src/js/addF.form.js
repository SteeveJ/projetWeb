let mymap = L.map('mapid').setView([51.505, -0.09], 13);

L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
    maxZoom: 19,
    attribution: '&copy; <a href="http://www.openstreetmap.org/copyright">OpenStreetMap</a>'
}).addTo(mymap);

let popup = L.popup();
let points=[];

function onMapClick(e) {

    L.marker(e.latlng).addTo(mymap);

    points.push(e.latlng);
    document.getElementById("pointsV").value=points;
    let polygon = L.polygon(points).addTo(mymap);
    polygon.color = "red";
    polygon.fillColor= '#f03';

}

mymap.on('click', onMapClick);