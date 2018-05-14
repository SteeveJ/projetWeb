<?php

if ( !is_connected() ) {
    redirect('?page=home');
}

$title_website = 'Quizz';

$styles = [
    './src/leaflet/dist/leaflet.css',
    './src/css/main.css',
];

$h_scripts = [
    './src/leaflet/dist/leaflet.js',
];

$f_scripts = [
    './src/jquery/dist/jquery.min.js',
    './src/js/functions.js',
    './src/js/main_2.js',
];

include_once __DIR__.'/header.php';

?>

    <div class="container bg-white container-top">
        <div id="topics"></div>
        <div id="questions">
            <h2 id="topic"></h2>
            <p>Score : <span class="score"></span></p>
            <p id="question"></p>
            <div id="map"></div>
        </div>
        <div id="response">
            <h2 id="title_response"></h2>
            <p>Score : <span class="score"></span></p>
            <p id="content_response"></p>
            <div id="images"></div>
            <div id="buttons">
                <button class='btn btn-primary' id='next'>Suivant</button>
            </div>
        </div>
    </div>
    <div id="footer">
        &copy; copyright Jerent Steeve 2018
    </div>

<?php

include_once __DIR__.'/footer.php';

