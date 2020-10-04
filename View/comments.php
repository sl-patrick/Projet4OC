<?php

$title = 'Commentaires';
require 'header.php';
require 'menu.php';

?>
<!-- commentaires -->
<div class="col">
    <div class="row">
        <div class="col">
            <h4 class="text-center">Commentaires récents</h4>
            <div class="col">
                <?php
                foreach ($comments as $comment) {

                ?>
                    <div class="card">
                        <div class="card-body">
                            <div class="card-title"><?= htmlspecialchars($comment['pseudo']); ?></div>
                            <div class="card-text"><?= htmlspecialchars($comment['contents']); ?></div>
                            <div class="card-text"><?= htmlspecialchars($comment['creation_date']); ?></div>
                        </div>
                    </div>
                <?php
                }
                ?>
            </div>
            
            <?php require 'pagination.php'; ?>
            
        </div>
    </div>
</div>
</div>

<?php require 'footer.php'; ?>

</body>

</html>