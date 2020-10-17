<?php

$title = 'Modifier l\'article'; 
require 'header.php';
require 'menu.php';

foreach ($getArticle as $article) {
    ?>
<main class="min-vh-100">
    <div class="container">
        <div class="row">
            <div class="col">
                <h3>Mettre à jour</h3>
                <form id="newPostForm" action="index.php?url=dashboard&amp;action=updatePost&amp;postId=<?= htmlspecialchars($article['id']); ?>" method="post">
                    <div class="form-group row">
                        <label for="newTitle" class="col-sm-2 col-form-label">Titre</label>
                        <div class="col">
                            <input class="form-control" type="text" name="newTitle" id="newTitle" value="<?= htmlspecialchars($article['title']); ?>">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="newContents" class="col-sm-2 col-form-label">Message</label>
                        <div class="col">
                            <textarea name="newContents" id="newContents" class="form-control"><?= html_entity_decode($article['contents']); ?></textarea>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="authorOfPost" class="col-sm-2 col-form-label">Auteur</label>
                        <div class="col">
                            <input class="form-control" type="text" name="authorOfPost" id="authorOfPost" value="<?= htmlspecialchars($article['author']); ?>">
                        </div>
                    </div>
                    <div class="form-group row">
                        <input type="submit" value="Mettre à jour" name="update" class="btn btn-dark">
                        <?php
                        if (intval($getArticle[0]['post_waiting']) === 1) {
                        ?>
                            <input type="submit" value="Mettre en ligne" name="putInLine" class="btn btn-dark">
                        <?php
                        } 
                        ?>
                        
                    </div>
                </form>
            </div>    
        </div>
    </div>
</main>
<?php
}
?>

<?php require 'footer.php'; ?>
