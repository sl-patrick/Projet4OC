<?php

$title = 'Articles publiés';
require 'header.php';
require 'menu.php';

?>

<main class="min-vh-100">
    <div class="container">
        <div class="row m-0">
            <div class="col">
                <h2 class="text-center">Articles récents</h2>
            <div class="col">
            <?php
            foreach ($posts as $post) {
            ?>
                <div class="card text-center mb-3">
                <div class="card-header"></div>
                    <div class="card-body">
                        <div class="card-title">
                            <h2 class="card-title text-uppercase">
                                <a class="text-decoration-none text-dark" href="index.php?"><?= htmlspecialchars($post['title']); ?></a>
                            </h2>
                        </div>
                        <div class="card-text"><?= html_entity_decode($post['contents']); ?></div>
                    </div>
                    <div class="card-footer">
                        <a href="index.php?url=dashboard&amp;action=updatePost&amp;postId=<?= htmlspecialchars($post['id']); ?>" class="card-link">Modifier</a>
                        <a href="index.php?url=dashboard&amp;action=deletePost&amp;postId=<?= htmlspecialchars($post['id']); ?>" class="card-link">Supprimer</a>
                    </div>
                </div>
            <?php
            }
            ?>
                </div>
            </div>
        </div>
    </div>
</main>

<div class="page-pagination d-flex justify-content-center">
    <nav>
        <ul class="pagination">
            <!-- previous -->
            <li class="page-item mt-3 <?= ($currentPage === 1) ? 'disabled' : '' ?>">
                <a class="page-link" href="index.php?url=dashboard&amp;action=posts&amp;page=<?= $currentPage - 1; ?>">Précédente</a>
            </li>
            <!-- Next -->
            <li class="page-item mt-3 <?= ($currentPage >= $totalPage) ? 'disabled' : '' ?>">
                <a class="page-link" href="index.php?url=dashboard&amp;action=posts&amp;page=<?= $currentPage + 1; ?>">Suivante</a>
            </li>
        </ul>
    </nav>
</div>

<?php require 'footer.php'; ?>

</body>

</html>