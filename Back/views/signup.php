<?php


$title_website = 'Inscription';

$styles = [
    './src/css/main.css',
];

$h_scripts = [
        './src/jquery/dist/jquery.min.js',
];
include_once __DIR__.'/header.php';

?>
<div class="container box mg-top">
    <div class="sub-box">

<form method="POST" action="?page=<?php echo $page ?>&signup=1">
                        <div class="form-group">
                            <label for="username-signup">Pseudo : </label>
                            <input id="username-signup" name="username-signup" class="form-control" type="text">
                        </div>
                        <div class="form-group">
                            <label for="lastname-signup">Nom : </label>
                            <input id="lastname-signup" name="lastname-signup" class="form-control" type="text">
                        </div>
                        <div class="form-group">
                            <label for="firstname-signup">Prenom : </label>
                            <input id="firstname-signup" name="firstname-signup" class="form-control" type="text">
                        </div>
                        <div class="form-group">
                            <label for="password-signup">Mot de passe : </label>
                            <input id="password-signup" name="password-signup" class="form-control" type="password">
                        </div>
                        <div class="form-group">
                            <label for="password-v-signup">Mot de passe (vérification): </label>
                            <input id="password-v-signup" name="password-v-signup" class="form-control" type="password">
                        </div>
                        <div class="modal-footer">
                            <button type="submit" class="btn btn-primary">S'inscrire</button>
                            <button type="button" class="btn btn-danger" data-dismiss="modal">Annuler</button>
                        </div>
                    </form>
                </div>
            </div>
<?php

include_once __DIR__.'/footer.php';
