<!doctype html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport"
              content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <meta description="Projet web - licence 3 informatique par Driss Bouzaid et Jerent Steeve">
        <link rel="shortcut icon" href="/favicon.ico" type="image/x-icon">
        <link rel="icon" href="/favicon.ico" type="image/x-icon">

        <link rel="stylesheet" href="./src/css/bootstrap.min.css">
        <?php
            if( isset( $styles ) && gettype( $styles ) === "array" && sizeof( $styles ) !== 0 ) {
                foreach ( $styles as $s ) {
                    echo "<link rel=\"stylesheet\" href=\"".$s."\">";
                }
            }
        ?>
        <?php
        if( isset( $h_scripts ) && gettype( $h_scripts ) === "array" && sizeof( $h_scripts ) !== 0 ) {
            foreach ( $h_scripts as $s ) {
                echo "<script src=\"".$s."\"></script>";
            }
        }
        ?>
        <title>7 merveilles<?php echo ( !empty( isset( $title_website ) ) ) ? " - ".$title_website : '' ?></title>
    </head>
    <body>
    <nav class="navbar navbar-default navbar-fixed-top">
        <div class="container-fluid">
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header">
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="#">7Merveilles</a>
            </div>

            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                <ul class="nav navbar-nav">
                    <?php
                        if($page === 'home')
                            echo "<li><a href=\"#about\">A propos</a></li>
                                    <li><a href=\"#team\">Équipe</a></li>
                                    <li><a href=\"#contact\">Contact</a></li>";
                        else
                            echo "<li><a href=\"/\">Accueil</a></li>";
                        if ( is_connected() )
                            echo '<li><a href="?page=quizz">Quizz</a></li>';
                    ?>
                </ul>

                <ul class="nav navbar-nav navbar-right">
                    <?php
                        if ( is_connected() ) {
                            echo "<li><a href='?page=admin'>".$_SESSION['user']['firstname']." ".$_SESSION['user']['lastname']."</a></li>
                                   <li><a href='?connexion=0'>logout</a></li>";
                        } else
                            echo "<li><a href=\"#login\" data-toggle=\"modal\" data-target=\"#login\">Se connecter</a></li>
                                    <li><a href=\"#signup\" data-toggle=\"modal\" data-target=\"#signup\">S'inscrire</a></li>";


                    ?>
                </ul>
            </div><!-- /.navbar-collapse -->
        </div><!-- /.container-fluid -->
    </nav>