<?php

$title_website = 'Home';

$styles = [
  './src/css/main.css',
];

$h_scripts = [
    './src/leaflet/dist/leaflet.js',
];

$f_scripts = [
    './src/js/functions.js',
    './src/js/main.js',
];

include_once __DIR__.'/header.php';

?>

    <div class="container box mg-top">
        <section id="about">
            <div class="row">
                <div class="col-sm-12 content">
                    <h2>A propos</h2>
                    <p>Le site des sept merveilles propose un ensemble de quiz culturel.</p>
                    <p>Les quiz consiste à chercher sept lieux fantastique sur une carte intéractive.</p>
                    <p>Ces quiz de culture générale sont un excellent moyen d’apprendre en s’amusant ! Pour vous, nous avons cherché les meilleures questions pour vous aider à accroître vos connaissances.</p>
                    <br>
                    <br>
                    <button class="btn btn-lg btn-primary btn-demo" data-toggle="modal" data-target="#demo"> Démo </button>
                    <button class="btn btn-lg btn-danger">S'inscrire</button>
                    <br>
                    <br>
                </div>
            </div>
        </section>
        <section id="quote">
            <div class="row">
                <div class="col-sm-12">
                    <div id="container_quote">
                        <p id="quote_1" class="quote">La culture est la possibilité même de créer, de renouveler et de partager des valeurs, le souffle qui accroît la vitalité de l'humanité. - citation Africaine</p>
                        <p id="quote_2" class="quote">On refuse d'admettre le fait-même de la diversité culturelle; on préfère rejeter hors de la culture, dans la nature, tout ce qui ne se conforme pas à la norme sous laquelle on vit. - Claude Lévi-strauss</p>
                        <p  id="quote_3" class="quote">La culture est proche d'une façon d'être, d'un coup de foudre, d'une fête toujours inachevée du bonheur.</p>
                    </div>
                </div>
            </div>
            <div id="select_quote">
                <div class="carre square_1" data-id="1"></div>
                <div class="carre square_2" data-id="2"></div>
                <div class="carre square_3" data-id="3"></div>
            </div>
        </section>

        <section id="team" class="content">
            <h2>Équipe</h2>
            <div class="row">
                <div class="col-sm-3 col-sm-pull-9"></div>
                <div class="col-sm-3">
                    <img src="./src/img/team_1.jpg" alt="Driss BOUZAID" class="img-circle image-team">
                    <p class="name">Driss BOUZAID</p>
                    <p>Développeur - CTO</p>
                </div>
                <div class="col-sm-3">
                    <img src="./src/img/team_2.jpg" alt="Steeve JERENT" class="img-circle image-team">
                    <p class="name">Steeve JERENT</p>
                    <p>Développeur - Designer</p>
                </div>
            </div>
        </section>
        <!-- affichage de la carte -->
        <!--<div id="map" style="width : 600px; height : 600px;"></div>-->
    </div>

    <section id="contact" class="container box">
        <div class="content">
            <h2>Contact</h2>
            <form method="POST" action="#">
                <div class="form-group">
                    <label for="name">Nom : </label>
                    <input id="name" name="name" class="form-control" type="text">
                </div>
                <div class="form-group">
                    <label for="email">Email : </label>
                    <input id="email" name="email" class="form-control" type="email">
                </div>
                <div class="form-group">
                    <label for="message">Message : </label>
                    <textarea class="form-control" name="message" id="message" rows="5"></textarea>
                </div>
                <div class="form-group">
                    <button type="submit" class="btn btn-lg btn-primary">Envoyer</button>
                </div>
            </form>
        </div>
    </section>
    <div id="footer">
        &copy; copyright Jerent Steeve 2018
    </div>

    <!-- Modal inscription -->
    <div class="modal fade" id="login" tabindex="-1" role="dialog" aria-labelledby="loginLabel">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="myModalLabel">Se connecter</h4>
                </div>
                <div class="modal-body">
                    <form method="POST" action="?page=<?php echo $page ?>&connexion=1">
                        <div class="form-group">
                            <label for="username-login">Pseudo : </label>
                            <input id="username-login" name="username-login" class="form-control" type="text">
                        </div>
                        <div class="form-group">
                            <label for="password-login">Mot de passe : </label>
                            <input id="password-login" name="password-login" class="form-control" type="password">
                        </div>
                        <div class="modal-footer">
                            <button type="submit" class="btn btn-primary">Se connecter</button>
                            <button type="button" class="btn btn-danger" data-dismiss="modal">Annuler</button>
                        </div>
                    </form>
                </div>

            </div>
        </div>
    </div>

    <div class="modal fade" id="demo" tabindex="-1" role="dialog" aria-labelledby="demoLabel">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="demoLabel">Demo</h4>
                </div>
                <div class="modal-body">
                    <h2>Démonstration quizz</h2>
                    <div class="box-demo">
                        <div id="map-demo"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>

<?php

include_once __DIR__.'/footer.php';

