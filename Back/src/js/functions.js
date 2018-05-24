"use strict";

/**
 *  Variables
 */
// Carte
let map;

// Q
let qNumber;
let questions;
let questionsOfTopic;
let questionOfTopic;
let score_j;
let idTopic;

// quotes
let minQuote = 1;
let maxQuote = 3;
let quote = minQuote;
let quote_interval;

let api_question = "./index.php?page=api";

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

    // On charge les donnée de la carte
    let p = L.polygon(questionOfTopic.map.features[0].geometry.coordinates, {
        style: function (feature) {
            return feature.properties && feature.properties.style;
        },
        //onEachFeature: onEachFeature,
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
    p.on('mousedown', function(evt){
        correction(evt);
    })

}

/**
 * Permet de changer de question
 */
function nextQuestion(){
    // on incrémente le compteur des questions
    qNumber++;

    if(qNumber === questionsOfTopic.length+1) {
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

/**
 *
 */
function endGame(){
    console.log('finish');
}


function getResponse(res_score) {

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

    if (qNumber == questionsOfTopic.length-1) {
        $('#next').css('display', 'None');
        sendScore();
    }

    // On ajoute le contenu de la section réponse
    $('#title_response').html(response_message);
    $('#content_response').html(questionOfTopic.about);
    // On cache la section question

    $('#questions').toggle();
    // on affiche la section réponse

    $('#response').toggle();
    $('.score').html(getScore());

    map.remove();

    initMap(questionOfTopic.map_lat,
        questionOfTopic.map_long,
        questionOfTopic.map_zmax,
        questionOfTopic.map_zmin);

    // On charge les donnée de la carte
    L.marker([questionOfTopic.resp_lat,questionOfTopic.resp_long]).addTo(map);

}

function sendScore() {
    $.post(api_question, {q: 'score', idTopic: idTopic, idUser : user_id, score: getScore()})
    .done(function (data) {
        console.log(data);
    })
    .fail(function () {
        console.log('Impossible d\'ouvrir le fichier ' + api_question);
    })
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
function correction(evt){
    let marginLat, marginLng;
    const position_lat = questionOfTopic.resp_lat,
    position_lng = questionOfTopic.resp_long;

    // on récupère l'ecart entre position de la réponse et le position
    if(evt.latlng.lat > position_lat)
        marginLat = evt.latlng.lat - position_lat;
    else
        marginLat = position_lat - evt.latlng.lat;
    if(evt.latlng.lng > position_lng)
        marginLng = evt.latlng.lng - position_lng;
    else
        marginLng = position_lng - evt.latlng.lng;

    const res_score = score(marginLat,
                marginLng,
                questionOfTopic.resp_marginerror);

    // on choisi un message adapté en fonction du nombre de proint reçu


    getResponse(res_score);

}

/**
 * On calcule le score en fonction des écarts entre
 * la poistion de la réponse et la position du clique du joueur
 * @param marginLat
 * @param marginLng
 * @param marginError
 * @returns {number}
 */
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


/**
 * Charge les questions et retourne une promesse
 * @param id_topic
 * @returns {boolean}
 */
function loadQuestion(id_topic){
    idTopic = id_topic;
    return new Promise((resolve, reject) => {
        $.post(api_question, {q: 'questions', id: id_topic})
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
 * Charge les topic et retourne une prommesse
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