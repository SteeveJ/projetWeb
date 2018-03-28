<?php

include_once __DIR__.'/connectDB.php';


use db\Database;

/**
 * @param string $firstName
 * @param string $lastName
 * @param string $password
 * @param string $role
 * @param integer $active
 * @return bool
 */
function createUser($firstName, $lastName, $pseudo, $password,$role='user', $active=1) {
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
        return true;
    } catch (PDOException $e){
        return false;
    }
}

/**
 * Get user by id
 * @param $id
 * @return bool|mixed
 */
function getUser($id){
    $db = (new Database())->getDB();
    $stmt = $db->prepare("SELECT id_user, firstname, lastname, role FROM USERS WHERE id_user=:ID");
    try {
        $stmt->execute([
            'ID' => $id
        ]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    } catch (PDOException $e){
        return false;
    }
}

/**
 * Get all users
 * @return array|bool
 */
function getUsers() {
    $db = ( new Database() )->getDB();
    $stmt = $db->query("SELECT id_user, firstname, lastname, role FROM USERS");
    try {
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    } catch ( PDOException $e ){
        return false;
    }
}

/**
 * Check all information about user before a create
 * @param $firstName
 * @param $lastName
 * @param $password
 * @param $role
 * @param $active
 * @return array
 */
function check_userData($firstName, $lastName, $password, $pseudo, $role, $active){
    $errors = [];

    // Contrainte sur le firstname
    if ( empty( $fistName ) ) {
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
        // TODO: contraintes des mot de passe à finir
        // Au minimun 1 maj, 1 charactère spécial, un chiffre
        //if (preg_match("[A-Z]\s"))
    }

    // TODO : contrainte user role

    // TODO : Contrainte is active

    return $errors;
}

function login($pseudo, $password) {

}

function createTopic() {
    // TODO
}

function getTopics() {
    // TODO
}