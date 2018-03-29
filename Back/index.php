<?php

require_once __DIR__.'/functions.php';

/*if(createUser('skyro', 'dev', 'skyro-dev', '1234') === false)
    print 'user is already create.';
else
    print 'use is create';*/

echo '<p>User 1 : </p>';
echo '<pre>';
print_r(getUser(1));
echo '</pre>';

echo '<p>get All user: </p>';
echo '<pre>';
print_r(getUsers());
echo '</pre>';

echo '<p>get user id: </p>';
echo '<pre>';
print_r((getUserID('skyro-dev', '1234') !== False) ? getUserID('skyro-dev', '134') : 'FAUX');
echo '</pre>';

echo '<p>Connexion: </p>';
echo '<pre>';
print_r(login('skyro-dev', '1234'));
print_r($_SESSION);
echo '</pre>';

echo '<p>déconnexion: </p>';
echo '<pre>';
print_r(logout());
session_start();
print_r($_SESSION);
echo '</pre>';
