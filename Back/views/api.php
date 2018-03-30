<?php
require_once __DIR__.'/../functions.php';

if( !empty( isset( $_POST['q'] ) ) ) {
    header('Content-Type: application/json;charset=utf-8');
    switch ($_POST['q']) {
        case 'topics':
            getTopics_json();
            break;
        default:
            include __DIR__.'/404.php';
    }
} else {
    include __DIR__.'/header.php';
    echo "<h1>Vous ne pouvez pas accéder de cette manière à l'API.</h1>";
    include __DIR__.'/footer.php';
}

