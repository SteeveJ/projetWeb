<?php


// TODO : DRISS - Verifier quel formulaire est à valider (exemple requete GET URL : /?page=form&req=addQ) req est le nom du formaile. PS : il n'y aura que des requête GET


/*
 * TODO : DRISS - Vérifier les informations du formulaire d'ajout de question et ajouter la question.
 *
 * Cette phase de vérification consiste à verifier que les données de la requête POST n'as pas été changer en cours de route.
 * Exemple : Si une valeur est supérieur a ce que l'on demande.
 * Aide
 * Les données reçu son en POST
 * Dans le cas ou un admin rentre des données incorrect : on retourne les donnée valide dans l'URL.
 * Les nom des paramettres GET a retourner.
 * id_t     : identifiant du sujet (topic)
 * q        : la question (c'est une string)
 * longR    : longitude la réponse à la question
 * latR     : latitude de la réponse à la question
 * margeR   : la marge d'erreur de l'utilisateur
 * longM    : la longitude pour positionner la carte
 * latM     : La latitude pour positionner la carte
 * min      : minimun zoom
 * max      : maximun zoom
 * */
function check_form_question( $request ) {
    $url_error = '?page=addQ';
    $error = False;

    /*
     *  retourner les informations correct du formulaire avec un requete
     *  GET (exemple Requete GET URL : ?page=addQ&id_q=2&q=salut+??+%26%26+dawa&longR=123.231&latR=-1.23&latM=1.5&max=12)
     *  si la donnée n'est pas valide
     *  $error = True
     *  sinon si la donnée est valide on fait par exemple:
     *  $url_error += "&q=$question";
     *
     */

    if( $error )
        redirect( $url_error );

    //  Ajouter la question à la DB
}

function check_form_topic( $request ) {
    if ( !empty( isset( $request['topic'] ) ) && strlen( str_replace( " ", '',$request['topic'] ) ) >= 1 )
        createTopic($request['topic']);
    else
        redirect('?page=addTopic');

    redirect('?page=admin');
}

if ( !empty( isset( $_GET['req'] ) ) ) {
    switch ($_GET['req'] ){
        case 'addTopic':
            check_form_topic($_POST);
            break;
    }
}
