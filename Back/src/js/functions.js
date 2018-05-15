"use strict";

let d =
    {
        "ID": 1,
        "q": "Ou ce trouve la plage de Riflet ?",
        "resp_lat": 16.334666761112235,
        "resp_long": -61.78309888496681,
        "resp_marginerror": 0.034,
        "map_zmax": 12,
        "map_zmin": 10,
        "map_lat": 16.31933949748773,
        "map_long": -61.79050686039952,
        "map": {
            "type": "FeatureCollection",
            "features": [
                {
                    "type": "Feature",
                    "properties": {
                        "name": "foo"
                    },
                    "geometry": {
                        "type": "Polygon",
                        "coordinates": [
                            [
                                [
                                    16.376652,
                                    -61.757364
                                ],
                                [
                                    16.344369,
                                    -61.707926
                                ],
                                [
                                    16.241554,
                                    -61.811609
                                ],
                                [
                                    16.271217,
                                    -61.847315
                                ],
                                [
                                    16.376652,
                                    -61.757364
                                ]
                            ]
                        ]
                    }
                }
            ]
        }
    };


/**
 *  Variables
 */
// Carte
let map;

// timer
let timer;
let seconde;

// Q
let qNumber;
let questions;
let questionsOfTopic;
let questionOfTopic;
let score_j;

// quotes
let minQuote = 1;
let maxQuote = 3;
let quote = minQuote;
let quote_interval;

/**
 * FUNCTIONS
 */

/**
 * Initialise la carte du monde avec openStreetMap
 */
function initMap(lat, lng, zMax, zMin){
    // On initialise une instance de leaflet
    map = new L.Map('map');

    // On charge les coordonnées de base de la carte
    map.setView([lat, lng], zMin);

    /**
     *  On charge la carte depuis l'api mapbox qui sont des contributeurs de openstreetmap
     *  On peut reglé le zoom de la carte ici.
     */
    L.tileLayer('https://api.tiles.mapbox.com/v4/{id}/{z}/{x}/{y}.png?access_token={accessToken}', {
        maxZoom: zMax,
        minZoom: zMin,
        attribution: 'Map data &copy; <a href="http://openstreetmap.org">OpenStreetMap</a> contributors, ' +
        '<a href="http://creativecommons.org/licenses/by-sa/2.0/">CC-BY-SA</a>, ' +
        'Imagery © <a href="http://mapbox.com">Mapbox</a>',
        id: 'mapbox.light',
        accessToken: 'pk.eyJ1Ijoic2t5cm8iLCJhIjoiY2poNmV6ejNvMTlneDJxbGYzeTdya2JucyJ9.qyocW9FTx8QmAv3p4HBXaA'
    }).addTo(map);

}

/**
 * Permet de charger la carte d'une question
 */
function loadingMap(){
    // on initialise la carte
    initMap(questionOfTopic.map_lat,
            questionOfTopic.map_long,
            questionOfTopic.map_zmax,
            questionOfTopic.map_zmin);

    questionOfTopic.map.features[0].geometry.coordinates = [ questionOfTopic.map.features[0].geometry.coordinates ];
    console.warn(questionOfTopic.map.features);
    // on affiche les élèments de geoJSON sur la carte
    // questionOfTopic.map
    L.geoJSON(d.map, {
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

/**
 * Permet de changer de question
 */
function nextQuestion(){
    // on incrémente le compteur des questions
    qNumber++;

    if(qNumber === 8) {
        endGame();
    } else {
        // to efface la carte map
        map.remove();
        questionOfTopic = questionsOfTopic[qNumber];
        loadingMap();
    }
}

/**
 * Permet d'instancier une partie
 */
function initGame() {
    qNumber = 0;
    score_j = 0;
    questionOfTopic = questionsOfTopic[qNumber];
    console.log(questionsOfTopic);
    $('#question').html(questionOfTopic.q);
    loadingMap();
}

function setQuestionsOfTopic(q) {
    questionsOfTopic = q;
}

function loadQ(){

}

/**
 *
 */
function endGame(){
    console.log('finish');
}

/**
 * Permet de retourner le score du joueur
 * @returns {*}
 */
function getScore() {
    return score_j;
}
/**
 * Action au click sur la carte
 * @param feature
 */
function correction(feature, evt){
    let marginLat, marginLng;
    const position = questionOfTopic.response.position;

    if(evt.latlng.lat > position.lat)
        marginLat = evt.latlng.lat - position.lat;
    else
        marginLat = position.lat - evt.latlng.lat;
    if(evt.latlng.lng > position.lng)
        marginLng = evt.latlng.lng - position.lng;
    else
        marginLng = position.lng - evt.latlng.lng;

    const res_score = score(marginLat,
                marginLng,
                questionOfTopic.response.marginError);
    let response_message;

    switch(res_score){
        case 0:
            response_message = "Dommage, tu n'as pas trouvé.";
            break;
        case 1:
            response_message = "Bravo, tu as trouvé la position.";
            break;
        case 2:
            response_message = "C'était presque ça.";
            break;
        case 3:
            response_message = "À quelque centimètre tu avais la solution.";
            break;
    }
    // On ajoute le contenu de la section réponse
    $('#title_response').html(response_message);
    $('#content_response').html(questionOfTopic.about);
    // On cache la section question
    $('#questions').toggle();
    // on affiche la section réponse
    $('#response').toggle();
    $('.score').html(getScore());

    // on ajoute les image
    for (let i in questionOfTopic.images) {
        $('#image').html("<img " +
            "src='"+questionOfTopic.images[i].path+"' " +
            "alt='"+questionOfTopic.images[i].desc+"'>");
    }
}

function score(marginLat, marginLng, marginError) {
    if (marginLat < marginError && marginLng < marginError) {
        score_j += 1;
        return 1;
    } else if (marginLat < marginError*1.25 && marginLng < marginError*1.25) {
        score_j += 0.5;
        return 2;
    } else if (marginLat < marginError*1.5 && marginLng < marginError*1.5) {
        score_j += 0.25;
        return 3;
    } else {
        score_j += 0;
        return 0;
    }
}

function onEachFeature(feature, layer) {
    /*let popupContent = "<p>I started out as a GeoJSON " +
        feature.geometry.type + ", but now I'm a Leaflet vector!</p>";

    if (feature.properties && feature.properties.popupContent) {
        popupContent += feature.properties.popupContent;
    }

    layer.bindPopup(popupContent);*/
    layer.on('mousedown', function(evt){
        correction(feature, evt);
    });
}

/**
 * Permet de démarrer le chronomètre
 * @param timeMax temps maximun du chronomètre
 */
function initTimer(timeMax){
    seconde = 0;
    timer = setInterval(function (){
        console.log(++seconde);
        if(seconde === timeMax){
            clearInterval(timer);
            // open modal with time out
        }
    }, 1000);
}

/**
 * Charge les localisation des points
 * @param url url du fichier
 * @returns {Promise}
 */
function loadLocation(url){
    return new Promise(function (resolve, reject) {
        $.getJSON(url)
            .done(function (data) {
                resolve(data);
            })
            .fail(function () {
                reject(Error('Impossible d\'ouvrir le fichier ' + url));
            })
        }
    );
}

/**
 *
 * @param $id_topic
 * @returns {boolean}
 */
function loadQuestion($id_topic){
    let api_question = "index.php?page=api";
    return new Promise((resolve, reject) => {
        $.post(api_question, {q: 'questions', id: $id_topic})
        .done(function (data) {
            questions = data;
            resolve(data);
        })
        .fail(function () {
            reject(Error('Impossible d\'ouvrir le fichier ' + api_question));
        })
    });
}

/**
 * Charger les Questions
 * @returns {Promise}
 */
function loadTopics(){
    return new Promise((resolve, reject) => {
        $.post('index.php', {'page': 'api', 'q': 'topics'})
        .done(function (data) {
            questions = data;
            resolve(data);
        })
        .fail(function () {
            reject(Error('Impossible d\'ouvrir le fichier ' + url));
        })
});
}

/**
 * Permet de charger les scores du/des joueur(s)
 */
function loadScore(){

}

/**
 * Permet d'initialiser le diaporama
 * des citations sur la page d'accueil
 */
function initquote(){
    quote_interval = setInterval(function(){
        $('#quote_'+quote).toggle();
        $('.square_'+quote).removeClass('bg_square');
        quote++;
        if(quote > maxQuote)
            quote = 1;
        $('#quote_'+quote).toggle();
        $('.square_'+quote).addClass('bg_square');
    }, 5000);
}

/**
 * Permet de compter le nombre de clée dans une objet
 * @param obj
 * @returns {Number}
 */
function countProperties(obj) {
    return Object.keys(obj).length;
}