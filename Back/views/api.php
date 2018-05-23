<?php
require_once __DIR__.'/../functions.php';

function unavailable() {
    $page = "unavailable";
    include __DIR__.'/header.php';
    echo "<br><br><h1>Vous ne pouvez pas accéder de cette manière à l'API.</h1>";
    include __DIR__.'/footer.php';
}

if( !empty( isset( $_POST['q'] ) ) ) {
    header('Content-Type: application/json;charset=utf-8');
    switch ($_POST['q']) {
        case 'topics':
            getTopics_json();
            break;
        case 'questions':
            if ( empty( isset( $_POST['id'] ) ) )  { unavailable(); break; }
            getQuestions_Json($_POST['id']);
            break;
        case 'score':
            if( empty( isset( $_POST['idTopic'] ) )
                && empty( isset( $_POST['idUser'] ) )
                && empty( isset( $_POST['score'] ) ) ) {
                unavailable(); break;
            }
            $tab['resultat'] = addScore($_POST['idTopic'], $_POST['idUser'], $_POST['score']);
            echo json_encode($tab);
            break;
        default:
            include __DIR__.'/404.php';
    }
} else {
    unavailable();
}

