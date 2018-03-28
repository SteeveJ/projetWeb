<?php

require_once __DIR__.'/functions.php';

if(createUser('skyro', 'dev', 'skyro-dev', '1234') === false)
    print 'user is already create.';
else
    print 'use is create';

echo '<p>User 1 : </p>';
echo '<pre>';
print_r(getUser(1));
echo '</pre>';

echo '<p>get All user: </p>';
echo '<pre>';
print_r(getUsers());
echo '</pre>';