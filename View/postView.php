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
    <?php
    while ($comment = $comments->fetch()) {
    ?>
    <div>
        <h2>Commentaires</h2>
        <p><?= htmlspecialchars($comment['pseudo']); ?></p>
        <p><?= htmlspecialchars($comment['contents']); ?></p>
        <p><?= htmlspecialchars($comment['creation_date']); ?></p>
    </div>
    <?php
    }
    $comments->closeCursor();
    ?>

    <!-- Ajouter commentaires -->
    <div>
        <h3>Ajouter un commentaire</h3>
        <form action="index.php?url=postComment&amp;postId=<?= htmlspecialchars($_GET['postId']); ?>" method="post">
            <div class="form-group">
                <label for="author">Pseudo : </label>
                <input type="text" name="author" id="author">
            </div>
            <div class="form-group">
                <label for="contents">Message : </label>
                <textarea name="contents" id="contents" class="form-control"></textarea>
            </div>
            <input type="submit" value="Envoyer">
        </form>
    </div>
   
</div>

<?php require 'footer.php'; ?>