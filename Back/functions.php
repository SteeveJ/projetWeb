<?php

// ne pas toucher ces fonction driss
// function Token(){
//     return 
// }

 function is_connected(){
     return !(empty(isset($POST['connected'])) && TokenValidator(empty(isset($POST['user_id'])), empty(isset($POST['token']))));
 }

function createUser() {
    // TODO
}

function getUsers(){
    // TODO
}

function getUser($id) {
    // TODO
    $conn=new PDO("mysql:host=localhost;dbname=projet_web","root","");
    $requete=$conn->prepare('Select FIRSTNAME,LASTNAME,ROLE,CREATED_AT,UPDATED_AT from users where ID_USER=:id');
    return($requete->execute(array('id'=>$id)));
    //foreach ($requete as $row){
    //    print_r($row['ID_USER']."\t".$row["FIRSTNAME"]);
    //}



}

function createTopic() {
    // TODO
}

function getTopics() {
    // TODO
}