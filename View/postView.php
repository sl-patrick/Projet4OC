<?php $title = 'Mon blog'; ?>

<?php require 'header.php'; ?>

<?php
$post = $posts->fetch();
?>

<section>
    <div class="jumbotron text-center">
        <div class="container">
            <h2><?= htmlspecialchars($post['title']); ?></h2>
            <p>par : <?= htmlspecialchars($post['author']); ?></p>
            <p>Créé le : <?= htmlspecialchars($post['creation_date']); ?></p>
        </div>
    </div>
</section>

<div class="container">
    <div class="row">
        <a href="index.php">Retour à l'accueil</a>
    </div>
    <!-- contenu article -->
    <div class="row">
        <p><?= htmlspecialchars($post['contents']); ?></p>
    </div>

    <?php
    
    $posts->closeCursor();
    
    ?>
    <!-- Afficher commentaires -->
    <?php require 'displayCommentsView.php'; ?>
    <!-- Ajouter commentaires -->
    <?php require 'commentsFormView.php'; ?>




</div>

<?php require 'footer.php'; ?>