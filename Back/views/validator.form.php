<?php

// validation form ajout question
function check_form_question( $request ) {
    debug_front($request);
    debug_front(checkMaxQ($request['topic']));
    debug_front(getQuestions());

    if (!empty( isset($request['topic'])) && !empty( isset($request['title'])) &&  !empty( isset($request['longitudeMap']))
        && !empty( isset($request['latitudeMap'])) && !empty( isset($request['zoomMaxMap'])) && !empty( isset($request['zoomMinMap']))
        && !empty( isset($request['longitudeR'])) && !empty( isset($request['latitudeR'])) && !empty( isset($request['margeR'])) ) {
        // TODO : Driss Faire les verifications
        createQuestion($request['topic'], $request['title'], $request['longitudeMap'],
            $request['latitudeMap'], $request['zoomMaxMap'], $request['zoomMinMap'],
            $request['longitudeR'], $request['latitudeR'], $request['margeR']);
        // TODO: Driss retouner vers la page admin si correct sinon retourner les information en get (voir les noms des element dans addQuestion.form.php)
    }


    //  Ajouter la question à la DB
}

// validation du formulaire d'ajout des topic
function check_form_topic( $request ) {
    $messages = [];
    if ( !empty( isset( $request['topic'] ) ) && strlen( str_replace( " ", '',$request['topic'] ) ) >= 1 ) {
        $res = createTopic($request['topic']);
        if ( $res === False ) {
            array_push($messages, "Le sujet existe déjà.");
        } else {
            redirect('?page=admin');
        }
    } else {
        redirect('?page=addTopic');
    }
    alert($messages);
    echo "<p> <a href='/?page=addTopic'>Retour page précedente</a></p>";
}

if ( !empty( isset( $_GET['req'] ) ) ) {
    switch ($_GET['req'] ){
        case 'addTopic':
            check_form_topic($_POST);
            break;
        case 'addQ':
            check_form_question($_POST);
            break;
    }
}
