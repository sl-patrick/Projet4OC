<?php

$title = 'Modifier l\'article'; 
require 'header.php';
require 'menu.php';

?>

<div>
    <form id="newPostForm" action="index.php?url=dashboard&amp;action=addPost" method="post">
        <div class="form-group">
            <label for="newTitle">Titre : </label>
            <input type="text" name="newTitle" id="newTitle" value="<?= htmlspecialchars($article['title']); ?>">
        </div>
        <div class="form-group">
            <label for="newContents">Message :</label>
            <textarea name="newContents" id="newContents" class="form-control"><?= htmlspecialchars($article['contents']); ?></textarea>
        </div>
        <div class="form-group">
            <label for="authorOfPost">Auteur : </label>
            <input type="text" name="authorOfPost" id="authorOfPost" value="<?= htmlspecialchars($article['author']); ?>">
        </div>
        <input type="submit" value="Mettre à jour" name="update">
    </form>
</div>