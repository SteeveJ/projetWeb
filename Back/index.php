<?php

require __DIR__.'/functions.php';


// On vérifie si une page est ciblée
if( !empty( isset( $_POST['page'] ) ) )
    $page  = $_POST['page'];
else if ( !empty( isset( $_GET['page'] ) ) )
    $page  = $_GET['page'];
else
    $page  = 'home';

// On démarre une session si l'utilisateur est connecté
if ( !empty( isset( $_COOKIE['connected'] ) ) && $_COOKIE['connected'] === 'True' )
    session_start();

// permet la connection d'un utilisateur
if ( !empty( isset( $_GET['connexion'] ) ) && $_GET['connexion'] === '1'
    && !empty( isset( $_POST['username-login'] ) ) && !empty( isset( $_POST['password-login'] ) ) ) {
    $res = $_GET['connexion'];
    if( $res === '1' ) {
        $login = login($_POST['username-login'], $_POST['password-login']);
        if( empty( $login ) ) {
            echo $login['message'];
        } else {
            header("Refresh:0; url=?page=$page");
        }
    }
}

// permet de déconnecter l'utilisateur du site
if (!empty( isset( $_GET['connexion'] ) ) && $_GET['connexion'] === '0') {
    logout();
    header("Refresh:0; url=index.php");
}

// Selection des pages du site
if ( isset($page) ) {
    switch ($page) {
        case 'api':
            include __DIR__.'/views/api.php';
            break;
        case 'quizz':
            include __DIR__.'/views/quizz.php';
            break;
        case 'home':
            include __DIR__.'/views/home.php';
            break;
        case 'addQ':
            include __DIR__.'/views/addQuestion.form.php';
            break;
        case 'form':
            include __DIR__ . '/views/validator.form.php';
            break;
        default:
            include __DIR__.'/views/404.php';
    }
}
