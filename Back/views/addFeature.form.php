<?php
// TODO : Driss a toi de gérer les features
?>
<?php

// if ( !is_connected() )
//    redirect('?page=home');

// TODO: Ajouter condition super admin

$title_website = 'add Feature';

$styles = [
    './src/css/main.css',
];

$h_scripts = [
    './src/jquery/dist/jquery.min.js',
];

$f_scripts = [
    './src/js/addF.form.js',
];

include_once __DIR__.'/header.php';

$questions = getQuestionsFormate();
// En cas d'erreur de saisie
?>

<div class="container box mg-top">
    <div class="sub-box">
        <h2 class="text-center">Ajouter Feature</h2>
        <?php
            if ( !empty( isset($message) ) ) echo "<p>$message</p>";//affichage d'erreurs en cas d'erreur
        ?>


        <form action="?page=form&req=addFeature" method="POST">

            <div class="form-group">
                <label for="question">Question</label>
                <select name="question" class="form-control" id="question">
                    <?php
                        foreach ($questions as $q){

                            if ($id_q != null && $t['ID_QUESTION'] == $id_t)
                                echo '<option value="'.$q['ID_QUESTION'].'" selected>'.$q['Nom_Formate'].'</option>';
                            else
                                echo '<option value="'.$q['ID_QUESTION'].'">'.$q['Nom_Formate'].'</option>';
                        }
                    ?>
                </select>
            </div>
            <div class="form-group">
                <div id="mapid" style="height:380px;"></div>
            </div>
                <div class="form-group">
                    <input type="hidden" id="pointsV" name="pointsV">
                </div>

            <button type="submit" class="btn btn-default">Ajouter</button>
        </form>
    </div>
</div>


<?php

include_once __DIR__.'/footer.php';

?>