<div class="displayComments">
    <p class="author"><?= htmlspecialchars($comments['pseudo']); ?></p>
    <p class="content"><?= htmlspecialchars($comments['contents']); ?></p>
    <p class="created_at"><?= htmlspecialchars($comments['creation_date']); ?></p>
    <p class="text-right">
        <button type="button" class="btn btn-primary" data-url="index.php?url=report&amp;idComment=<?= htmlspecialchars($comments['id']); ?>">Signaler</button>
    </p>
</div> 

