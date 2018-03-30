<?php

$title_website = 'Home';

$styles = [
  './src/css/main.css',
];

$f_scripts = [
    './src/js/functions.js',
    './src/js/main.js',
];

include_once __DIR__.'/header.php';

?>

    <div class="container-fluide">
        <section id="about">
            <div class="row">
                <div class="col-sm-6 bg1">
                </div>
                <div class="col-sm-6 content">
                    <h2>A propos</h2>
                    Lorem ipsum dolor sit amet, consectetur adipisicing elit. Ab adipisci animi beatae dolores earum ex id, iusto labore odio pariatur, quas ratione vel vero? Aut consequuntur debitis ducimus eos sed!
                </div>
            </div>
        </section>
        <section id="quote">
            <div class="row">
                <div class="col-sm-12">
                    <div id="container_quote">
                        <h3 id="quote_1" class="quote">La culture est la possibilité même de créer, de renouveler et de partager des valeurs, le souffle qui accroît la vitalité de l'humanité. - citation Africaine</h3>
                        <h3 id="quote_2" class="quote">On refuse d'admettre le fait-même de la diversité culturelle; on préfère rejeter hors de la culture, dans la nature, tout ce qui ne se conforme pas à la norme sous laquelle on vit. - Claude Lévi-strauss</h3>
                        <h3  id="quote_3" class="quote">La culture est proche d'une façon d'être, d'un coup de foudre, d'une fête toujours inachevée du bonheur.</h3>
                    </div>
                </div>
            </div>
            <div id="select_quote">
                <div class="carre square_1" data-id="1"></div>
                <div class="carre square_2" data-id="2"></div>
                <div class="carre square_3" data-id="3"></div>
            </div>
        </section>

        <section id="factsheet" class="container">
            <h2>Fiche pratique</h2>
            <article>
                <header>
                    <!--en-tête de l'article-->
                    <h2></h2>
                </header>
                <img src="./" alt="example">
                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Aliquid architecto asperiores cumque dignissimos enim excepturi facilis, iure magni nesciunt nulla officia officiis possimus quaerat quibusdam, quod recusandae, repudiandae rerum veritatis.</p>
                <footer>
                    <!-- bas de page de l'article -->
                </footer>
            </article>
        </section>
        <!-- affichage de la carte -->
        <!--<div id="map" style="width : 600px; height : 600px;"></div>-->
    </div>
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
                            <input id="password-login" name="password-login" class="form-control" type="text">
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

<?php

include_once __DIR__.'/footer.php';

