<?php

    // On vérifie si une page est ciblée
    if( !empty( isset( $_POST['page'] ) ) )
        $page  = $_POST['page'];
    else if ( !empty( isset( $_GET['page'] ) ) )
        $page  = $_GET['page'];
    else
        include __DIR__.'/views/home.php';

    if ( isset($page) ) {
        switch ($page) {
            case 'api':
                include __DIR__.'/views/api.php';
            break;
            case 'form_login':
                break;
        }
    }
