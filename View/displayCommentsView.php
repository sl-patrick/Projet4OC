<h2>Commentaires</h2>

<?php

while ($comment = $comments->fetch()) {

?>
    <div>
        <p class="author"><?= htmlspecialchars($comment['pseudo']); ?></p>
        <p class="content"><?= htmlspecialchars($comment['contents']); ?></p>
        <p class="created_at"><?= htmlspecialchars($comment['creation_date']); ?></p>
    </div>
<?php
}

$comments->closeCursor();

?>