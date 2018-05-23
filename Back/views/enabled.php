<?php

require_once __DIR__.'/../functions.php';

if( !empty( isset( $_GET['enabled'] ) ) ) {
    if( !empty( isset( $_GET['idTopic'] ) ) ){
        if ($_GET['enabled'] == 1) {
            statusTopic($_GET['idTopic']);

        } else {
            statusTopic($_GET['idTopic'], 0);

        }
        header('Location: index.php?page=admin');
    }
}