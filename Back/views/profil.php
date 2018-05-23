<?php

// On vérifie si l'utilisateur est connecté
if(!is_connected())
    redirect('?page=home');

$title_website = 'Profil';

$styles = [
    './src/css/main.css',
];

$h_scripts = [
];

$f_scripts = [
];

include_once __DIR__.'/header.php';

$user = $_SESSION['user'];

$myScores = getScores($user['id_user']);
?>

    <div class="container box mg-top">
        <div class="sub-box">
            <?php if(is_admin($user['role'])) echo "<p class='text-center identificateur'>Vous pouvez accédez à l'admoinistration <a href='?page=admin'>ici</a></p>"; ?>
            <div class="row">
                <div class="col-md-6">
                    <h3 class="titre">Mon profile :</h3>
                    <p><span class="identificateur">Pseudo : </span> <?php echo $user['pseudo'] ?></p>
                    <p><span class="identificateur">Prénom : </span><?php echo $user['firstname'] ?></p>
                    <p><span class="identificateur">Nom : </span><?php echo $user['lastname'] ?></p>
                </div>
                <div class="col-md-6">
                    <h3 class="titre">Meilleurs scores</h3>
                    <?php
                        if(!empty( isset( $myScores ) ) && $myScores !== False ) {
                            echo "<table class='table table-condensed'><tbody><tr><th>Thème</th><th>Score</th></tr>";
                            foreach ($myScores as $score)
                                echo "<tr><td>".getTopic($score['TOPIC_ID'])['name']."</td><td>".$score['scoreMax']."</td></tr>";

                            echo "</tbody></table>";
                        } else {
                            echo "Pas de scores.";
                        }
                    ?>
                </div>
            </div>
        </div>
    </div>


<?php

include_once __DIR__.'/footer.php';