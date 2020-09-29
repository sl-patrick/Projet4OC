<?php

$title = 'Articles publiés';
require 'header.php';
require 'menu.php';

?>

<div class="row m-0">

    <div class="col">
        <h4 class="text-center">Articles récents</h4>
        <div class="col">
            <?php
            foreach ($postsPublished as $post) {
            ?>
                <div class="card">
                    <div class="card-body">
                        <div class="card-title">
                            <a href="index.php?"><?= htmlspecialchars($post['title']); ?></a>
                        </div>
                        <div class="card-text"><?= htmlspecialchars($post['contents']); ?></div>
                        <a href="index.php?url=dashboard&amp;action=updatePost&amp;postId=<?= htmlspecialchars($post['id']); ?>" class="card-link">Modifier</a>
                        <a href="index.php?url=dashboard&amp;action=deletePost&amp;postId=<?= htmlspecialchars($post['id']); ?>" class="card-link">Supprimer</a>
                    </div>
                </div>
            <?php
            }
            ?>
        </div>

        <div class="page-pagination d-flex justify-content-center">
            <nav>
                <ul class="pagination">
                    <!-- previous -->
                    <li class="page-item"><a href="index.php?url=dashboard&amp;action=posts&amp;page=<?= $currentPage - 1; ?>">Précédente</a></li>
                    <!-- Nombre de page -->
                    <li class="page-item"><a href="#"></a></li>
                    <!-- Next -->
                    <li class="page-item"><a href="index.php?url=dashboard&amp;action=posts&amp;page=<?= $currentPage + 1; ?>">Suivante</a></li>
                </ul>
            </nav>
        </div>
    </div>

</div>
<?php require 'footer.php'; ?>

</body>

</html>