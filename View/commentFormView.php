<div class="m-3">
    <div class="col text-center">
        <h3>Ajouter un commentaire</h3>
    </div>

    <form id="commentForm" action="index.php?url=postComment&amp;postId=<?= htmlspecialchars($_GET['postId']); ?>" method="post">
        <div class="form-group row">
            <small id="validationMessage" class="invalid-feedback text-center"></small>
        </div>
        <div class="form-group">
            <label for="author">Pseudo</label>
            <input type="text" name="author" id="author" class="form-control">
        </div>
        <div class="form-group">
            <label for="contents">Message</label>
            <textarea name="contents" id="contents" class="form-control"></textarea>
        </div>
        <input type="submit" value="Envoyer" class="send btn btn-dark">
    </form>
</div>