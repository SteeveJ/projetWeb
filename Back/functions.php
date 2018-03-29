<?php

include_once __DIR__.'/connectDB.php';

<<<<<<< HEAD
 function is_connected(){
     return !(empty(isset($POST['connected'])) && TokenValidator(empty(isset($POST['user_id'])), empty(isset($POST['token']))));
 }
=======
>>>>>>> 805f54cab3cc19c94dc03e32ca2a4b9371dd2d20

use db\Database;

/**
 * @param string $firstName
 * @param string $lastName
 * @param string $pseudo
 * @param string $password
 * @param string $role
 * @param integer $active
 * @return bool
 */
function createUser($firstName, $lastName, $pseudo, $password, $role='user', $active=1) {
    /* TODO: Décommenté apres avoir fini la fonction check_userData
     * $check = check_userData($firstName, $lastName, $pseudo, $password, $role, $active);
    if ($check['res'] === False)
        return $check['errors'];*/
    $db = (new Database())->getDB();
    $stmt = $db->prepare("INSERT INTO USERS(FIRSTNAME, LASTNAME, PSEUDO, PASSWORD, ROLE, ACTIVE) VALUE (:FIRSTNAME, :LASTNAME, :PSEUDO, :PASSWORD, :ROLE, :ACTIVE)");
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

<<<<<<< HEAD
function getUser($id) {
    // TODO
    $conn=new PDO("mysql:host=localhost;dbname=projet_web","root","");
    $requete=$conn->prepare('Select FIRSTNAME,LASTNAME,ROLE,CREATED_AT,UPDATED_AT from users where ID_USER=:id');
    return($requete->execute(array('id'=>$id)));
    //foreach ($requete as $row){
    //    print_r($row['ID_USER']."\t".$row["FIRSTNAME"]);
    //}



=======
/**
 * Get all users
 * @return array|bool
 */
function getUsers() {
    $db = ( new Database() )->getDB();
    $stmt = $db->query("SELECT id_user, firstname, lastname, pseudo, role FROM USERS");
    try {
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
    $errors = [];

    // Contrainte sur le firstname
    if ( empty( $fistName ) && !isset($firstame) ) {
        array_push($errors, "First name is not defined");
    } else if ( sizeof($firstName) > 1 ) {
        array_push($errors, "First name with 0 or 1 char is not valid");
    }

    // Contrainte sur le lastname
    if ( empty( $lastName ) )
        array_push($errors, "Last name is not defined");
    else if ( sizeof($lastName) <= 1 )
        array_push($errors, "Last Name with 0 or 1 char is not valid");

    if ( empty( $password ) ) {
        array_push($errors, "Password is not defined");
    } else {
        if ( sizeof( $password ) < 8 || sizeof( $password ) > 16 ) {
            array_push($errors, "Your password contains less than 8 char or more than 16 char.");
        }
        // TODO: vérification des mot de passe
        // Au minimun 1 maj, 1 charactère spécial, un chiffre
        //if (preg_match("[A-Z]\s"))
    }

    // TODO : Vérification pseudo

    // TODO : Vérification user role

    // TODO : Vérification is active


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

function getUserID($pseudo, $password) {
    $db = (new Database())->getDB();
    $stmt = $db->prepare("SELECT id_user FROM USERS WHERE PSEUDO=:PSEUDO AND PASSWORD=:PASSWORD");
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
 * @param $pseudo
 * @param $password
 * @return array
 */
function login($pseudo, $password) {
    $id = getUserID($pseudo, $password);
    if($id === False)
        return [
            'res'       => False,
            'message'   => 'Password or pseudo is not valid'
        ];
    $user = getUser($id['id_user']);
    session_start();
    $_SESSION['user'] = $user;
    return [
        'res'   => True
    ];
}

/**
 * @return bool
 */
function logout() {

    if( isset( $_SESSION['user']) ) {
        session_destroy();
        return True;
    } else {
        return False;
    }
>>>>>>> 805f54cab3cc19c94dc03e32ca2a4b9371dd2d20
}

function createTopic() {
    // TODO
}

function getTopics() {
    // TODO
}