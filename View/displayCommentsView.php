<div class="allComments">
    <?php
    foreach ($comments as $comment) {
    ?>
        <div class="displayComments">
            <p class="author"><?= htmlspecialchars($comment['pseudo']); ?></p>
            <p class="content"><?= htmlspecialchars($comment['contents']); ?></p>
            <p class="created_at"><?= htmlspecialchars($comment['creation_date']); ?></p>
            <p class="text-right">
                <button type="button" class="btn btn-primary" onclick="report(this.dataset.url)" data-url="index.php?url=report&amp;idComment=<?= htmlspecialchars($comment['id']); ?>">Signaler</button>
            </p>
        </div>

    <?php
    }
    ?>
</div>
