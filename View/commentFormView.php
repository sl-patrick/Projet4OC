<h3>Ajouter un commentaire</h3>

<div>
    <form id="form" action="index.php?url=postComment&amp;postId=<?= htmlspecialchars($_GET['postId']); ?>" method="post">
        <div class="form-group">
            <label for="author">Pseudo : </label>
            <input type="text" name="author" id="author">
        </div>
        <div class="form-group">
            <label for="contents">Message : </label>
            <textarea name="contents" id="contents" class="form-control"></textarea>
        </div>
        <input type="submit" value="Envoyer" class="send">
    </form>
</div>
