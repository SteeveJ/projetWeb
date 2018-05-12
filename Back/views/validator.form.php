<?php

// validation form ajout feature
function check_form_feature( $request)
{
    //ce bout formate les coordonnées tq les latitudes sont les index pairs , et longitudes impaires
    $arr=str_replace("LatLng(","", $request['pointsV']);
    $arr=str_replace(")","", $arr);
    $arr=explode(",",$arr);

    print_r($arr);
    print_r(count($arr));
    //debut traitement erreurs
    $messages = [];
    if(count($arr) < 6)//moin de 3 points fournis
        array_push($messages,"Veuillez specifier au moin 3 points");
    if(empty( isset( $request['question'])))
        array_push($messages,"Aucune question specifiée");
    //fin traitement erreurs
    if(count($messages) > 0)
    {
        alert($messages);
        echo "<p> <a href='/?page=addFeature'>Retour page précedente</a></p>";
    }
    else
    {
        $res = createFeature($request['question'],$arr);
        if ( $res === False ) {
            array_push($messages, "Un ou plusieurs coordonnées indiquées existe déjà pour cette question.");
        } else {
            redirect('?page=admin');
        }
    }
}

// validation form ajout question
function check_form_question( $request ) 
{
    $bonnesVal="";

    if (!empty( isset($request['topic'])) && !empty( isset($request['title'])) &&  !empty( isset($request['longitudeMap']))
        && !empty( isset($request['latitudeMap'])) && !empty( isset($request['zoomMaxMap'])) && !empty( isset($request['zoomMinMap']))
        && !empty( isset($request['longitudeR'])) && !empty( isset($request['latitudeR'])) && !empty( isset($request['margeR'])) ) {
            $res = True;
    }
    else
    {
        if(!empty( isset($request['topic'])))
            $bonnesVal.="&topic=".$request['topic'];
        if(!empty( isset($request['title'])))
            $bonnesVal.="&title=".$request['title'];
        if(!empty( isset($request['longitudeMap'])))
            $bonnesVal.="&longitudeMap=".$request['longitudeMap'];
        if(!empty( isset($request['latitudeMap'])))
            $bonnesVal.="&latitudeMap=".$request['latitudeMap'];
        if(!empty( isset($request['zoomMaxMap'])))
            $bonnesVal.="&zoomMaxMap=".$request['zoomMaxMap'];
        if(!empty( isset($request['zoomMinMap'])))
            $bonnesVal.="&zoomMinMap=".$request['zoomMinMap'];
        if(!empty( isset($request['longitudeR'])))
            $bonnesVal.="&longitudeR=".$request['longitudeR'];
        if(!empty( isset($request['latitudeR'])))
            $bonnesVal.="&latitudeR=".$request['latitudeR'];
        if(!empty( isset($request['margeR'])))
            $bonnesVal.="&margeR=".$request['margeR'];
    }
        if($res !== False)
        {
            createQuestion($request['topic'], $request['title'], $request['longitudeMap'],
            $request['latitudeMap'], $request['zoomMaxMap'], $request['zoomMinMap'],
            $request['longitudeR'], $request['latitudeR'], $request['margeR']);
            redirect('?page=admin');
        }
        else
        {
            redirect('?page=addQ'.$bonnesVal);
        }
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
    }
    alert($messages);
    echo "<p> <a href='/?page=addTopic'>Retour page précedente</a></p>";
}

//redirection vers le check approprié selon la page dont la requete provient
if ( !empty( isset( $_GET['req'] ) ) ) {
    switch ($_GET['req'] ){
        case 'addTopic':
            check_form_topic($_POST);
            break;
        case 'addQ':
            check_form_question($_POST);
            break;
        case 'addFeature':
            check_form_feature($_POST);
            break;
    }
}
