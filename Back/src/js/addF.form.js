let mymap = L.map('mapid').setView([51.505, -0.09], 13);

L.tileLayer('https://api.tiles.mapbox.com/v4/{id}/{z}/{x}/{y}.png?access_token={accessToken}', {
    attribution: 'Map data &copy; <a href="http://openstreetmap.org">OpenStreetMap</a> contributors, <a href="http://creativecommons.org/licenses/by-sa/2.0/">CC-BY-SA</a>, Imagery © <a href="http://cloudmade.com">CloudMade</a>',
    maxZoom: 18,
    id: 'mapbox.light',
    accessToken: 'pk.eyJ1Ijoic2t5cm8iLCJhIjoiY2poNmV6ejNvMTlneDJxbGYzeTdya2JucyJ9.qyocW9FTx8QmAv3p4HBXaA'
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