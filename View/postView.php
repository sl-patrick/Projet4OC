<?php

$title = 'Mon blog';

require 'header.php';
require 'menu.php';


foreach ($posts as $post) {

?>

<main>
    <section>
        <div class="jumbotron jumbotron-fluid background text-center">
            <div class="container">
                <h2><?= htmlspecialchars($post['title']); ?></h2>
                <p>par : <?= htmlspecialchars($post['author']); ?></p>
                <p>Créé le : <?= htmlspecialchars($post['creation_date']); ?></p>
            </div>
        </div>
    </section>

    <div class="container">
        <div class="row m-3 justify-content-between">
            <a class="text-decoration-none" href="index.php">Retour à l'accueil</a>
            <a class="text-decoration-none" href="index.php?url=chapter">Chapitres</a>

        </div>
        <!-- contenu article -->
        <div class="row">
            <div class="col text-center">
                <p ><?= htmlspecialchars($post['contents']); ?></p>
            </div>
        </div>
        <hr class="my3">

    <?php
    }

    ?>
    
    <?php require 'displayCommentsView.php'; ?>
    <?php require 'commentFormView.php'; ?>

    </div>
</main>

    <?php require 'footer.php'; ?>