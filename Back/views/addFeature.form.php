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
];

$f_scripts = [
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
        <script src="JKS.js"></script>

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
            <script>
            var mymap = L.map('mapid').setView([51.505, -0.09], 13);
            L.tileLayer('http://{s}.tile.cloudmade.com/e7b61e61295a44a5b319ca0bd3150890/997/256/{z}/{x}/{y}.png', {
    attribution: 'Map data &copy; <a href="http://openstreetmap.org">OpenStreetMap</a> contributors, <a href="http://creativecommons.org/licenses/by-sa/2.0/">CC-BY-SA</a>, Imagery Â© <a href="http://cloudmade.com">CloudMade</a>',
    maxZoom: 18
}).addTo(mymap);
var popup = L.popup();
var points=[];
function onMapClick(e) {

    L.marker(e.latlng).addTo(mymap);
    
points.push(e.latlng);
document.getElementById("pointsV").value=points;
var polygon = L.polygon(points).addTo(mymap);
    polygon.color = "red";
    polygon.fillColor= '#f03';

}

mymap.on('click', onMapClick);

</script>
            <button type="submit" class="btn btn-default">Ajouter</button>
        </form>
    </div>
</div>


<?php

include_once __DIR__.'/footer.php';

?>