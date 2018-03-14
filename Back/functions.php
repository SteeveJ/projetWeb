<?php

function is_connected(){
    return empty(isset($POST['connected'])) && TokenValidator(empty(isset($POST['user_id'])), empty(isset($POST['token'])));
}