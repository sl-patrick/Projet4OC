<?php

$title = 'Ajouter un article';
require 'header.php';
require 'menu.php';

?>

<main class="min-vh-100">
    <div class="container">
        <div class="row">
            <div class="col">
                <h2 class="text-center">Ajouter un article</h2>
                <form id="newPostForm" action="index.php?url=dashboard&amp;action=addPost" method="post">
                    <div class="form-group row">
                        <label for="newTitle" class="col-sm-2 col-form-label-">Titre</label>
                        <div class="col">
                            <input type="text" name="newTitle" id="newTitle" class="form-control">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="newContents" class="col-sm-2">Message</label>
                        <div class="col">
                            <textarea name="newContents" id="newContents" class="form-control"></textarea>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="authorOfPost" class="col-sm-2">Auteur</label>
                        <div class="col">
                            <input type="text" name="authorOfPost" id="authorOfPost" class="form-control" value="Jean Forteroche">
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col">
                            <input type="submit" value="Ajouter" name="newPost" class="btn btn-dark">
                            <input type="submit" value="Brouillon" name="inWaiting" class="btn btn-dark">
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</main>

<?php require 'footer.php'; ?>