<div class="allComments mb-3">
    <?php
    foreach ($comments as $comment) {
    ?>
        <div id="<?= htmlspecialchars($comment['id']); ?>" class="displayComments card shadow-sm mb-2">
            <div class="card-body">
                <h4 class="author card-title"><?= htmlspecialchars($comment['pseudo']); ?></h4>
                <p class="content card-text"><?= htmlspecialchars($comment['contents']); ?></p>
                <p class="created_at card-text text-muted"><?= htmlspecialchars($comment['creation_date']); ?></p>
                <p class="text-right m-0">
                    <button type="button" class="btn btn-dark" onclick="report(this.dataset.url, this.dataset.id)" data-id="<?= htmlspecialchars($comment['id']); ?>" data-url="index.php?url=report&amp;idComment=<?= htmlspecialchars($comment['id']); ?>">Signaler</button>
                </p>
            </div>
        </div>

    <?php
    }
    ?>
</div>
