"use strict";

function loadQuestion() {
    $.getJSON('./demo.json').done(function(data) {
        // geojson
        console.log(data);
        const location = data.location;
        initMap(location.latitude, location.longitude, location.zoomMax, location.zoomMin);
    });
}



$('#map-demo').on('show.bs.modal', function (evt) {
    const h = parseInt(window.innerHeight*0.65);
    console.log(h);
});


/**
 * FUNCTIONS
 */

/**
 * Initialise la carte du monde avec openStreetMap
 */
function initMap(lat, lng, zMax, zMin){
    // On initialise une instance de leaflet
    map = new L.Map('map-demo');

    // On charge les coordonnées de base de la carte
    map.setView([lat, lng], zMin);

    /**
     *  On charge la carte depuis l'api mapbox qui sont des contributeurs de openstreetmap
     *  On peut reglé le zoom de la carte ici.
     */
    L.tileLayer('https://api.tiles.mapbox.com/v4/{id}/{z}/{x}/{y}.png?access_token=pk.eyJ1Ijoic2t5cm8iLCJhIjoiY2pkcHpqd3Z0MHpkODJ3cXpuaDAxanFjdyJ9.Ta1TlUNAb5MZe2MJl6YAtw', {
        maxZoom: zMax,
        minZoom: zMin,
        attribution: 'Map data &copy; <a href="http://openstreetmap.org">OpenStreetMap</a> contributors, ' +
        '<a href="http://creativecommons.org/licenses/by-sa/2.0/">CC-BY-SA</a>, ' +
        'Imagery © <a href="http://mapbox.com">Mapbox</a>',
        id: 'mapbox.light'
    }).addTo(map);

}

/**
 * Permet de charger la carte d'une question
 */
function loadingMap(){

    // on initialise la carte
    initMap(questionOfTopic.location.latitude,
        questionOfTopic.location.longitude,
        questionOfTopic.location.zoomMax,
        questionOfTopic.location.zoomMin);

    // on affiche les élèments de geoJSON sur la carte
    L.geoJSON(questionOfTopic.map, {
        style: function (feature) {
            return feature.properties && feature.properties.style;
        },
        onEachFeature: onEachFeature,
        pointToLayer: function (feature, latlng) {
            return L.circleMarker(latlng, {
                radius: 8,
                fillColor: "#ff7800",
                color: "#000",
                weight: 1,
                opacity: 1,
                fillOpacity: 0.8
            });
        }
    }).addTo(map);
}

// Action après le chargement du dom
$(document).ready(function(){
    $('.quote').toggle();
    $('#quote_'+quote).toggle();
    $('.square_'+quote).addClass('bg_square');

    initquote();

    $('.carre').on('mousedown', function(){
        clearInterval(quote_interval);
        $('#quote_'+quote).toggle();
        $('.square_'+quote).removeClass('bg_square');
        quote = $(this).data('id');
        $('#quote_'+quote).toggle();
        $('.square_'+quote).addClass('bg_square');
        initquote();
    });

});