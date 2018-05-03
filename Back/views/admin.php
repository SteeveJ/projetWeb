<?php

// if ( !is_connected() )
//    redirect('?page=home');

// TODO: Ajouter condition super admin

$title_website = 'Administration';

$styles = [
    './src/css/main.css',
];

$h_scripts = [
];

$f_scripts = [
];

include_once __DIR__.'/header.php';

?>

    <div class="container box mg-top">
        <div class="sub-box">
            <h2 class="text-center">Administration</h2>
            <div class="options">
                <ul>
                    <li><a href="?page=addTopic">Ajouter un sujet</a></li>
                    <li><a href="?page=addQ">Ajouter une question</a></li>
                </ul>

            </div>
        </div>
    </div>


<?php

include_once __DIR__.'/footer.php';