<?php

if ( !is_connected() && is_admin($_SESSION['user']['role']))
    redirect('?page=home');


$title_website = 'Administration';

$styles = [
    './src/css/main.css',
];

$h_scripts = [
];

$f_scripts = [
];

include_once __DIR__.'/header.php';

$sujets = getTopics();
$questions = getQuestions();

?>

    <div class="container box mg-top">
        <div class="sub-box">
            <h2 class="text-center">Administration</h2>
            <div class="options">
                <p>Construire son quizz : </p>
                <ul>
                    <li><a href="?page=addTopic">Ajouter un sujet</a></li>
                    <li><a href="?page=addQ">Ajouter une question</a></li>
                    <li><a href="?page=addFeature">Ajouter la zone pour une question</a></li>
                </ul>
                <div class="row">
                    <div class="col-md-12">
                        <h2>Les sujets</h2>
                        <table class="table table-responsive">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Désignation</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                    foreach ($sujets as $sujet) {
                                        echo "<tr><td>".$sujet['id_topic']."</td><td>".$sujet['name']."</td><td></td></tr>";
                                    }
                                ?>
                            </tbody>
                        </table>
                    </div>
                    <div class="col-md-12">
                        <h2>Les questions</h2>
                        <table class="table table-responsive">
                            <thead>
                            <tr>
                                ID_QUESTION,TITLE,TOPIC_ID,RESPONSE_ID,MAP_ID
                                <th>ID</th>
                                <th>Désignation</th>
                                <th>Longitude (réponse)</th>
                                <th>Latitude (réponse)</th>
                                <th>Marge d'erreur</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php
                            foreach ($sujets as $sujet) {
                                echo "<tr><td>".$sujet['id_topic']."</td><td>".$sujet['name']."</td><td></td></tr>";
                            }
                            ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>


<?php

include_once __DIR__.'/footer.php';