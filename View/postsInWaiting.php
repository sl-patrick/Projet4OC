<?php

$title = 'Articles en attente';
require 'header.php';
require 'menu.php';

?>

<div class="row m-0">

    <div class="col">
        <h4 class="text-center">Articles en attentes</h4>
        <div class="col">
            <?php

            foreach ($postsInWaiting as $postInWait) {
            ?>
                <div class="card">
                    <div class="card-body">
                        <div class="card-title">
                            <a href="index.php?"><?= htmlspecialchars($postInWait['title']); ?></a>
                        </div>
                        <div class="card-text"><?= htmlspecialchars($postInWait['contents']); ?></div>
                        <a href="index.php?url=dashboard&amp;action=updatePost&amp;postId=<?= htmlspecialchars($postInWait['id']); ?>" class="card-link">Modifier</a>
                        <a href="index.php?url=dashboard&amp;action=deletePost&amp;postId=<?= htmlspecialchars($postInWait['id']); ?>" class="card-link">Supprimer</a>
                    </div>
                </div>
            <?php
            }
            ?>
        </div>
        <div class="page-pagination">
            <nav>
                <ul class="pagination">
                    <!-- previous -->
                    <li class="page-item"><a href="#">Précédente</a></li>
                    <!-- Nombre de page -->
                    <li class="page-item"><a href="#"></a></li>
                    <!-- Next -->
                    <li class="page-item"><a href="#">Suivante</a></li>
                </ul>
            </nav>
        </div>
    </div>
</div>
<?php require 'footer.php'; ?>

</body>

</html>