<?php

$title = 'Ajouter un article';
require 'header.php';
require 'menu.php';

?>

<h3>Ajouter un article</h3>

<div>
    <form id="newPostForm" action="index.php?url=dashboard&amp;action=addPost" method="post">
        <div class="form-group">
            <label for="newTitle">Titre : </label>
            <input type="text" name="newTitle" id="newTitle">
        </div>
        <div class="form-group">
            <label for="newContents">Message :</label>
            <textarea name="newContents" id="newContents" class="form-control"></textarea>
        </div>
        <div class="form-group">
            <label for="authorOfPost">Auteur : </label>
            <input type="text" name="authorOfPost" id="authorOfPost">
        </div>
        <input type="submit" value="Ajouter" name="newPost">
        <input type="submit" value="En attente" name="inWaiting">
    </form>
</div>