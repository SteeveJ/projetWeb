<?php

// if ( !is_connected() )
//    redirect('?page=home');

// TODO: Ajouter condition super admin

$title_website = 'add Question';

$styles = [
    './src/css/main.css',
];

$h_scripts = [
        './src/jquery/dist/jquery.min.js',
        './src/js/addQ.form.js',
];

$f_scripts = [
];

include_once __DIR__.'/header.php';

$topics = getTopics();
// En cas d'erreur de saisie
$id_t = (!empty( isset( $_GET['id_t'] ) ) && gettype((int) $_GET['id_t']) === "integer") ? (int) $_GET['id_t'] : null;
$q = (!empty( isset( $_GET['q'] ) ) ) ? $_GET['q'] : null;
$longR = (!empty( isset( $_GET['longR'] ) ) && gettype((double) $_GET['longR']) === "double") ? (double) $_GET['longR'] : null;
$latR = (!empty( isset( $_GET['latR'] ) ) && gettype((double) $_GET['latR']) === "double") ? (double) $_GET['latR'] : null;
$margeR = (!empty( isset( $_GET['margeR'] ) ) && gettype((double) $_GET['margeR']) === "double") ? (double) $_GET['margeR'] : null;
$longM = (!empty( isset( $_GET['longM'] ) ) && gettype((double) $_GET['longM']) === "double") ? (double) $_GET['longM'] : null;
$latM = (!empty( isset( $_GET['latM'] ) ) && gettype((double) $_GET['latM']) === "double") ? (double) $_GET['latM'] : null;
$min = (!empty( isset( $_GET['min'] ) ) && gettype((int) $_GET['min']) === "integer") ? (int) $_GET['min'] : null;
$max = (!empty( isset( $_GET['max'] ) ) && gettype((int) $_GET['max']) === "integer") ? (int) $_GET['max'] : null;
?>

<div class="container box mg-top">
    <div class="sub-box">
        <h2 class="text-center">Ajouter question</h2>
        <form action="?page=form&req=addQ" method="POST">
            <h3>Sujet : </h3>
            <div class="form-group">
                <label for="topic">Choisir un sujet</label>
                <select class="form-control" name="topic" id="topic">
                    <?php

                        foreach ($topics as $t){
                            if ($id_q != null && $t['id_topic'] == $id_t)
                                echo '<option value="'.$t['id_topic'].'" selected>'.$t['name'].'</option>';
                            else
                                echo '<option value="'.$t['id_topic'].'">'.$t['name'].'</option>';
                        }
                    ?>
                </select>
            </div>

            <h3>Question : </h3>
            <div class="form-group">
                <label for="name">Votre question : </label>
                <input type="text" class="form-control" id="name" name="title" placeholder="Ou se trouve ... ?" value="<?php echo $q; ?>">
            </div>

            <h3>Réponse : </h3>
            <div class="form-group">                
                <div id="Rmapid" style="height:380px;"></div>
                <label for="latitudeR">Latitude : </label>
                <input type="number" class="form-control" step="any" min="-180" max="180" id="latitudeR" name="latitudeR" placeholder="1.234" value="<?php echo $latR; ?>" readonly>
                <label for="longitudeR">Longitude</label>
                <input type="number" class="form-control" step="any" min="-180" max="180" id="longitudeR" name="longitudeR" placeholder="1.234" value="<?php echo $longR; ?>" readonly>
            </div>
            <div class="form-group">
                <label for="margeR">Un marge d'erreur (entre 0 et 1): </label>
                <input type="number" class="form-control" step="any" min="0" max="1" id="margeR" name="margeR" placeholder="0.034" value="<?php echo $margeR; ?>">
            </div>

            <h3>Affichage de la carte : </h3>
            <div class="form-group">
                <div id="Amapid" style="height:380px;"></div>


                <label for="longitudeMap">Longitude</label>
                <input type="number" class="form-control" step="any" min="-180" max="180" id="longitudeMap" name="longitudeMap" placeholder="1.234" value="<?php echo $longM; ?>" readonly>
            </div>
            <div class="form-group">
                <label for="latitudeMap">Latitude : </label>
                <input type="number" class="form-control" step="any" min="-180" max="180" id="latitudeMap" name="latitudeMap" placeholder="1.234" value="<?php echo $latM; ?>" readonly>
            </div>
            <div class="form-group">
                <label for="zoomMinMap">Zoom minimum (entre 10 et 15): </label>
                <input type="number" class="form-control" step="any" min="10" max="15" id="zoomMinMap" name="zoomMinMap" placeholder="10" value="<?php echo $min; ?>">
            </div>
            <div class="form-group">
                <label for="zoomMaxMap">Zoom maximum (entre 10 et 15): </label>
                <input type="number" class="form-control" step="any" min="10" max="15" id="zoomMaxMap" name="zoomMaxMap" placeholder="10" value="<?php echo $max; ?>">
            </div>


            <button type="submit" class="btn btn-default">Ajouter</button>
        </form>
    </div>
</div>


<?php

include_once __DIR__.'/footer.php';
?>