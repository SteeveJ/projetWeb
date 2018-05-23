<?php

if ( !is_connected() )
    redirect('?page=home');

// TODO: Ajouter condition super admin

$title_website = 'Add topic';

$styles = [
    './src/css/main.css',
];

$h_scripts = [
];

$f_scripts = [
];

include_once __DIR__.'/header.php';

?>

<div class="container box mg-top">
    <div class="sub-box">
        <h2 class="text-center">Ajouter Topic</h2>
        <?php if ( !empty( isset($message) ) ) echo "<p>$message</p>";  ?>
        <form action="?page=form&req=addTopic" method="POST">

            <div class="form-group">
                <label for="topic">Nom </label>
                <input type="text" class="form-control" id="topic" name="topic" placeholder="Les 7 merveilles du monde">
            </div>

            <button type="submit" class="btn btn-default">Ajouter</button>
        </form>
    </div>
</div>


<?php

include_once __DIR__.'/footer.php';
