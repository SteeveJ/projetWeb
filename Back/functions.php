<?php

include_once __DIR__.'/connectDB.php';


use db\Database;

/**
 * @param string $firstName
 * @param string $lastName
 * @param string $pseudo
 * @param string $password
 * @param string $role
 * @param integer $active
 * @return bool|mixed
 */
function createUser($firstName, $lastName, $pseudo, $password, $role='user', $active=1) {
    $check = check_userData($firstName, $lastName, $password, $pseudo, $role, $active);
    if ($check['res'] === False)
        return $check['errors'];
    $db = (new Database())->getDB();
    $stmt = $db->prepare("INSERT INTO USERS(FIRSTNAME, LASTNAME, PSEUDO, PASSWORD, ROLE, ACTIVE) VALUES (:FIRSTNAME, :LASTNAME, :PSEUDO, :PASSWORD, :ROLE, :ACTIVE)");
    try {
        $stmt->execute([
            'FIRSTNAME' => $firstName,
            'LASTNAME'  => $lastName,
            'PASSWORD'  => hash('sha256', $password),
            'PSEUDO'    => $pseudo,
            'ROLE'      => $role,
            'ACTIVE'    => $active,
        ]);
        $stmt = null;
        return True;
    } catch (PDOException $e){
        return False;
    }
}

/**
 * Get user by id
 * @param $id
 * @return bool|mixed
 */
function getUser($id){
    $db = (new Database())->getDB();
    $stmt = $db->prepare("SELECT id_user, firstname, lastname, pseudo, role FROM USERS WHERE id_user=:ID");
    try {
        $stmt->execute([
            'ID' => $id
        ]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    } catch (PDOException $e){
        return False;
    }
}


/**
 * Get all users
 * @return array|bool
 */
function getUsers() {
    $db = ( new Database() )->getDB();
    try {
        $stmt = $db->query("SELECT id_user, firstname, lastname, pseudo, role FROM USERS");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    } catch ( PDOException $e ){
        return False;
    }
}

/**
 * Check all information about user before a create
 * @param string $firstName
 * @param string $lastName
 * @param string $pseudo
 * @param string $password
 * @param string $role
 * @param integer $active
 * @return array
 */
function check_userData($firstName, $lastName, $password, $pseudo, $role, $active){
    // Tableau qui rassemble les erreurs
    $errors = [];

    // Vérification sur le firstname
    if ( empty( $firstName ) || !isset($firstName) ) {
        array_push($errors, "First name is not defined");
    } else if ( strlen($firstName) <= 1 ) {
        array_push($errors, "First name with length 0 or 1 char is not valid");
    }

    // Vérification sur le lastname
    if ( empty( $lastName ) )
        array_push($errors, "Last name is not defined");
    else if ( strlen($lastName) <= 1 )
        array_push($errors, "Last Name with length 0 or 1 char is not valid");

    // Vérification des mots de passes
    if ( empty( $password ) ) {
        array_push($errors, "Password is not defined");
    } else {
        // compris entre 8 et 16 caractère, Au minimun 1 maj, 1 charactère spécial, un chiffre
        if ( strlen( $password ) < 8 || strlen( $password ) > 16 )
            array_push($errors, "Your password contains less than 8 char or more than 16 char.");
        //debug_front(preg_match(mb_convert_encoding('/[#$%^&*()+=@\-\[\]\';,.\/{}|":<>?~\\\\]/', 'UTF-8'),$password));
        if (preg_match(mb_convert_encoding('/[A-Z]/', 'UTF-8'),$password) !== 1 )
            array_push($errors,"Your Password must contain at least 1 uppercase!");
        if( preg_match(mb_convert_encoding('/[#$%^&*()+=@\-\[\]\';,.\/{}|":<>?~\\\\]/', 'UTF-8'), $password) !== 1 )
        array_push($errors,"Your password must contain at least 1 special character!");
        if (preg_match(mb_convert_encoding('/[0-9]/', 'UTF-8'),$password) !== 1 )
            array_push($errors,"Your password must contain at least 1 number!");
    }
    // Vérification pseudo
    if( empty($pseudo) || !isset($pseudo) )
        array_push($errors,"Pseudo is not defined!");
    else if( preg_match("/[\s]/",$pseudo) === 1 )
        array_push($errors,"Your pseudo cannot contain spaces!");
    else if( strlen($pseudo) <= 1 )
        array_push($errors,"Pseudo with length 0 or 1 is not valid!");

    // Vérification user role
    if( strcasecmp($role ,"user" ) !== 0 )
        if ( strcasecmp($role ,"admin" ) !== 0 )
            array_push($errors,"Role is neither user nor admin");

    // Vérification is active
        if( !in_array($active, [0,1] ) )
            array_push($errors,"Active is neither 0 nor 1");

        if (sizeof($errors) === 0)
            return [
                'res'    => True,
            ];
            else
                return [
                    'res'    => False,
                    'errors' => $errors
                ];
            }

/**
 * Permet de recupérer l'id d'un utilisateur en fonction 
 * de son pseudo et mot de passse
 * @param string $pseudo
 * @param string $password
 * @return array|bool
 */
function getUserID($pseudo, $password) {
    $db = (new Database())->getDB();
    $stmt = $db->prepare("SELECT id_user FROM USERS WHERE PSEUDO=:PSEUDO AND PASSWORD=:PASSWORD AND USERS.ACTIVE=1");
    try {
        $stmt->execute([
            'PSEUDO'        => $pseudo,
            'PASSWORD'      => hash('sha256', $password),
        ]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    } catch (PDOException $e){
        return False;
    }
}


/**
 * Fonction de connexion des utilisateurs
 * @param string $pseudo
 * @param string $password
 * @return array
 */
function login($pseudo, $password) {
    $id = getUserID($pseudo, $password);
    if($id === False)
        return [
            'res'       => False,
            'message'   => 'Password or pseudo is not valid'
        ];

    /*if (!empty( isset( $_COOKIE['connected'] ) ))
        return [
            'res'       => False,
            'message'   => 'Une session est déjà active'
        ];*/
    $user = getUser($id['id_user']);
    session_start();
    $_SESSION['user'] = $user;
    setcookie('connected', 'True', time() + (60 * 30));
    return [
        'res'   => True
    ];
}


/**
 * Permet de déconnecter un utilisateur dur le site
 * @return bool
 */
function logout() {
    if( isset( $_COOKIE['connected'] ) && $_COOKIE['connected'] === 'True' ) {
        session_destroy();
        unset($_COOKIE['connected']);
        setcookie('connected', '', time() - 3600, '/');
        return True;
    } else {
        return False;
    }

}

/**
 * Permet de créer une topic
 * @param string $topicName
 * @return bool
 */
function createTopic($topicName) {
    $db = (new Database())->getDB();
    $stmt = $db->prepare("INSERT INTO TOPICS(Name) VALUES (:NAME)");
    try {
        $stmt->execute([
            'NAME' => $topicName,
        ]);
        $stmt = null;
        return True;
    } catch (PDOException $e){
        return False;
    }
}

/**
 * Permet d'afficher tous les topics existant
 * @return array|bool
 */
function getTopics() {
    $db = (new Database())->getDB();
    try {
        $stmt = $db->query("Select id_topic, name from TOPICS");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    } catch (PDOException $e){
        return False;
    }
}

/**
 * Permet d'afficher un topic spécifiques
 * @param integer $id
 */
function getTopic($id) {
    $db = (new Database())->getDB();
    try {
        $stmt = $db->prepare("Select id_topic,name from TOPICS where id_topic=:ID");
        $stmt->execute([
            "ID"=>$id
        ]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    } catch (PDOException $e){
        return False;
    }
}

/**
 * Permet de rentré des coordonnée pour tous les points sur la carte
 * @param $lat
 * @param $long
 * @return bool|string
 */
function createCoordinate($lat, $long) {
    $db = (new Database())->getDB();
    $stmt = $db->prepare("INSERT INTO COORDINATES(latitude, longitude) VALUES (:LATITUDE, :LONGITUDE)");
    try {
        $stmt->execute([
            'LATITUDE' => $lat,
            'LONGITUDE' => $long
        ]);
        return $db->lastInsertId();
    } catch (PDOException $e){
        return False;
    }
}

/**
 * Permet de crée une réponse (Point sur la carte)
 * @param $marginError
 * @param $latitude
 * @param $longitude
 * @return array|bool|string
 */
function createResponse($marginError, $latitude, $longitude) {
    $db = (new Database())->getDB();
    $stmt = $db->prepare("INSERT INTO RESPONSES(coordinate_id, marginError) VALUES (:ID, :MARGE)");
    $IDCoordinate = createCoordinate($latitude, $longitude);
    if($IDCoordinate === False) {
        return [
            'res'   => False,
            'message'      => 'Fail : createCoordinate',
        ];
    }
    try {
        $stmt->execute([
            'ID' => $IDCoordinate,
            'MARGE' => $marginError
        ]);
        return $db->lastInsertId();
    } catch (PDOException $e){
        return False;
    }
}

/**
 * Permet rentrer les coordonnées de la carte
 * @param $max
 * @param $min
 * @param $latitude
 * @param $longitude
 * @return array|bool|string
 */
function createMap($max, $min, $latitude, $longitude) {
    $db = (new Database())->getDB();
    $stmt = $db->prepare("INSERT INTO MAPS(coordinate_id, zoommax, zoommin) VALUES (:ID, :MAX, :MIN)");
    $IDCoordinate = createCoordinate($latitude, $longitude);
    if($IDCoordinate === False) {
        return [
            'res'       => False,
            'message'   => 'Fail : createCoordinate',
        ];
    }
    try {
        $stmt->execute([
            'ID' => $IDCoordinate,
            'MAX' => $max,
            'MIN'   => $min
        ]);
        return $db->lastInsertId();
    } catch (PDOException $e){
        return False;
    }
}

/**
 * Permet de crée une question pour un topics donnée
 * @param $IDTopic
 * @param $title
 * @param $longitudeMap
 * @param $latitudeMap
 * @param $zoomMax
 * @param $zoomMin
 * @param $longitudeResponse
 * @param $latitudeResponse
 * @param $marginError
 * @return array|bool|string
 */
function createQuestion($IDTopic, $title, $longitudeMap,
 $latitudeMap, $zoomMax, $zoomMin, $longitudeResponse, $latitudeResponse, $marginError) {
    $db = (new Database())->getDB();
    $stmt = $db->prepare("INSERT INTO QUESTIONS(title, topic_id, response_id, map_id) VALUES (:TITLE, :TOPIC, :RESPONSE, :MAP)");
    $IDMap = createMap($zoomMax, $zoomMin, $latitudeMap, $longitudeMap);
    if($IDMap === False) {
        return [
            'res'       => False,
            'message'   => 'Fail : createMap',
        ];
    }
    $IDResponse = createResponse($marginError, $latitudeResponse, $longitudeResponse);
    if($IDResponse === False) {
        return [
            'res'       => False,
            'message'   => 'Fail : createResponse',
        ];
    }
    try {
        $stmt->execute([
            'TITLE'     => $title,
            'TOPIC'     => $IDTopic,
            'RESPONSE'  => $IDResponse,
            'MAP'       => $IDMap,
        ]);
        return $db->lastInsertId();
    } catch (PDOException $e){
        return False;
    }
}

/**
 * Permet de crée une zone cliquable sur la carte
 * @param $id_quest
 * @param $ptsArray
 * @return array|bool|string
 */
function createFeature($id_quest,$ptsArray){
    $db = (new Database())->getDB();
    $i=0;
    do
    {
        $cid = createCoordinate($ptsArray[$i],$ptsArray[$i+1]);
        if($cid === False) {
            return [
                'res'       => False,
                'message'   => 'Fail : createFeature_Coordinate',
            ];
        }
        else{
        $stmt=$db->prepare("INSERT INTO FEATURES(coordinate_id,ID_QUESTION) VALUES(:CID,:QID)");
        try {
            $stmt->execute([
                'CID' => $cid,
                'QID' => $id_quest
            ]);
            $db->lastInsertId();
        } catch (PDOException $e){
            return False;
        }
        }
        $i=$i+2;//+2 pour passer au point suivant
    }while($i <= (count($ptsArray)-1));

return $db->lastInsertId();
}

/**
 * Retourne toutes les questions de la bdd
 * @return array|bool
 */
function getQuestions() {
    $db = (new Database())->getDB();
    try {
        $stmt = $db->query("Select ID_QUESTION,TITLE,TOPIC_ID,RESPONSE_ID,MAP_ID from QUESTIONS");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    } catch (PDOException $e){
        return False;
    }
}

/**
 * Retourne les questions dans un certain format
 * @return array|bool
 */
function getQuestionsFormate()//retourne les questions sous format : nom_topic - Titre_Question,je vais l'utiliser en Ajouter_Feature
{
    $db = (new Database())->getDB();
    try {
        $stmt = $db->query("Select ID_QUESTION,Concat(name,' - ',Title) as Nom_Formate from questions q join topics t where q.TOPIC_ID=t.ID_TOPIC");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    } catch (PDOException $e){
        return False;
    }
}

/**
 * retourne les question d'un topic
 * @param $id_topic
 * @return array|bool
 */
function getQuestionsTopic($id_topic) {
    $db = (new Database())->getDB();
    try {
        $stmt = $db->prepare("
            SELECT QUESTIONS.ID_QUESTION as ID, QUESTIONS.TITLE as q,
            REPONSE.LATITUDE as resp_lat, REPONSE.LONGITUDE as resp_long,
            RESPONSES.MARGINERROR as resp_marginerror, MAPS.ZOOMMAX as map_zmax,
            MAPS.ZOOMMIN as map_zmin, MAP.LATITUDE as map_lat, MAP.LONGITUDE as map_long 
            FROM QUESTIONS
            JOIN RESPONSES ON RESPONSES.ID_RESPONSE = QUESTIONS.RESPONSE_ID
            JOIN COORDINATES as reponse ON RESPONSES.COORDINATE_ID = reponse.ID_COORDINATE
            JOIN MAPS ON QUESTIONS.MAP_ID = MAPS.ID_MAP
            JOIN COORDINATES as map ON map.ID_COORDINATE = MAPS.COORDINATE_ID
            WHERE QUESTIONS.TOPIC_ID = :ID
        ");
        $stmt->execute([
            'ID'     => $id_topic
        ]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    } catch (PDOException $e){
        return False;
    }
}

/**
 * Retourne le nombre de question d'un topic
 * @param $id_topic
 * @return mixed
 */
function checkMaxQ($id_topic){
    $db = (new Database())->getDB();
    $stmt = $db->prepare("SELECT count(*) as count FROM QUESTIONS WHERE TOPIC_ID=:ID");
    try {
        $stmt->execute([
            "ID" => $id_topic
        ]);
        return $stmt->fetch();
    } catch(PDOException $e) {
        echo $e;
    }
}

/**
 * Affiche les topics au format json
 */
function getTopics_json() {
    $q = getTopics();

    if($q === false)
        echo "Une erreur est survenue dans la requête";
    else
        echo json_encode($q, JSON_PRETTY_PRINT);
}

/**
 * Retourne les question sous forme de JSON
 * @param $id_topic
 * @return null
 */
function getQuestions_Json($id_topic) {
    if ( empty( isset( $id_topic ) ) ) return null;
    $questions = getQuestionsTopic($id_topic);
    if($questions === false) {
        echo "Une erreur est survenue dans la requête";
    } else {
        $q = [];
        foreach ( $questions as $x ) {
            $x['map'] = [];
            $x['map']['type'] = "FeatureCollection";
            $x['map']['features'] = [];
            $x['map']['features']['type'] = "Feature";
            $x['map']['features']['geometry'] = [];
            $x['map']['features']['geometry']['type'] = "Polygon";
            $x['map']['features']['geometry']['coordinates'] = [];
            foreach (getFeatureQ($x['ID']) as $feature){
                array_push($x['map']['features']['geometry']['coordinates'], [$feature['LONGITUDE'], $feature['LATITUDE']]);
            }
            array_push($q, $x);
        }
        echo json_encode($q, JSON_PRETTY_PRINT);
    }
}

/**
 * Permet de déterminer si un utilisateur est connecté
 */
function is_connected() {
    return (!empty( isset( $_SESSION['user'] ) ) && !empty( isset( $_COOKIE['connected'] ) ) && $_COOKIE['connected'] === 'True');
}

/**
 * Permet de rediriger vers une autre page
 * @param string $url
 */
function redirect($url) {
    ob_start(); // ensures anything dumped out will be caught

    // clear out the output buffer
    while (ob_get_status()) {
        ob_end_clean();
    }

    // no redirect
    header( "Location: $url" );
}

function alert($messages) {
    if ( !empty( isset( $messages) ) ) {
        echo "<div class='alert alert-danger'>";
        foreach ($messages as $m) {
            echo "<p>$m</p>";
        }
        echo "</div>";
    }
}

/**
 * Permet de debuggé proprement les variables
 * @param $var
 */
function debug_front($var) {
    echo '<pre>';
    print_r($var);
    echo '</pre>';
}

/**
 * @param integer $userId
 */
function getScores($userId) {
    $db = (new Database())->getDB();
    try {
        $stmt = $db->prepare("SELECT TOPIC_ID,MAX(SCORE) as scoreMax FROM SCORES WHERE USER_ID = :ID GROUP BY TOPIC_ID");
        $stmt->execute([
            "ID" => $userId
        ]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    } catch (PDOException $e){
        return False;
    }
}

/**
 * Permet de déterminer si l'utilisateur est un administrateur
 * @param $role
 * @return bool
 */
function is_admin($role) {
    if(strcasecmp($role,"admin")==0)
        return True;
    else return False;
}

/**
 * Permet de récupérer les features d'une carte
 * @param $id_question
 * @return array|bool
 */
function getFeatureQ($id_question) {
    $db = (new Database())->getDB();
    try {
        $stmt = $db->prepare("SELECT * FROM FEATURES as f JOIN COORDINATES as c ON f.COORDINATE_ID = c.ID_COORDINATE WHERE ID_QUESTION = :ID");
        $stmt->execute([
            "ID" => $id_question
        ]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    } catch (PDOException $e){
        return False;
    }
}
