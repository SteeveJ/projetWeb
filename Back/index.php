<?php

require_once __DIR__.'/functions.php';

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
        if( !empty( isset( $login['message'] ) ) ) {
            logout();
        } else {
            header("Refresh:0; url=?page=$page");
        }
    }
}

// inscription
if( !empty( isset( $_GET['signup'] ) ) && $_GET['signup'] === '1') {
    if ( !empty( isset($_POST['username-signup']) )
    &&  !empty( isset($_POST['password-signup']) )
    &&  !empty( isset($_POST['password-v-signup']) )
    &&  !empty( isset($_POST['lastname-signup']) )
    &&  !empty( isset($_POST['username-signup']) )
    &&  !empty( isset($_POST['firstname-signup']) ) ) {
        $messages_signup = [];
        if($_POST['password-v-signup'] !== $_POST['password-signup']) {
            array_push($messages_signup, "Les mots de passes ne sont pas similaire.");
        } else {
            $res = createUser($_POST['firstname-signup'], $_POST['lastname-signup'], $_POST['username-signup'], $_POST['password-signup']);
            if ( $res === False || ($res !== True || $res !== False) ) {
                $messages_signup = $res;
            }

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
        case 'addFeature':
            include __DIR__.'/views/addFeature.form.php';
            break;
        case 'addTopic':
            include __DIR__.'/views/addTopic.form.php';
            break;
        case 'form':
            include __DIR__ . '/views/validator.form.php';
            break;
        case 'admin':
            include __DIR__.'/views/admin.php';
            break;
        case 'profil':
            include __DIR__.'/views/profil.php';
            break;
        case 'enabled':
            include __DIR__.'/views/enabled.php';
            break;
        default:
            include __DIR__.'/views/404.php';
    }
}
