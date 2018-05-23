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
$questions = getQuestionsFormate();

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
                                        $line = "<tr><td>".$sujet['id_topic']."</td><td>".$sujet['name']."</td><td>";
                                        if (topicIsEnabled($sujet['id_topic']) == false)
                                            $line .= "<a href='?page=enabled&enabled=1&idTopic=".$sujet['id_topic']."'>Activer</a>";
                                        else
                                            $line .= "<a href='?page=enabled&enabled=0&idTopic=".$sujet['id_topic']."'>Désactiver</a>";
                                        $line .= "</td></tr>";
                                        echo $line;
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
                                <th>ID</th>
                                <th>Désignation</th>
                                <th>Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php
                            foreach ($questions as $question) {

                                echo "<tr><td>".$question['ID_QUESTION']."</td><td>".$question['Nom_Formate']."</td><td></td></tr>";
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