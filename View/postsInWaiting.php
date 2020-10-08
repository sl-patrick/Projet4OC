<?php
$title = 'Articles en attentes';
require 'header.php';
require 'menu.php';
?>

<main class="min-vh-100">
    <div class="container">
        <div class="row m-0">
            <div class="col">
                <h4 class="text-center">Articles en attentes</h4>
                <div class="col">
                    <?php
                    foreach ($posts as $postInWait) {
                    ?>
                        <div class="card text-center mb-3">
                            <div class="card-header"></div>
                            <div class="card-body">
                                <div class="card-title">
                                    <h3 class="card-title text-uppercase">
                                        <a class="text-decoration-none text-dark" href="index.php?"><?= htmlspecialchars($postInWait['title']); ?></a>
                                    </h3>
                                </div>
                                <div class="card-text"><?= htmlspecialchars($postInWait['contents']); ?></div>
                            </div>
                            <div class="card-footer">
                                <a href="index.php?url=dashboard&amp;action=updatePost&amp;postId=<?= htmlspecialchars($postInWait['id']); ?>" class="card-link">Modifier</a>
                                <a href="index.php?url=dashboard&amp;action=deletePost&amp;postId=<?= htmlspecialchars($postInWait['id']); ?>" class="card-link">Supprimer</a>
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
            <li class="page-item mt-3 <?= ($currentPage === 1) ? 'disabled' : '' ?>">
                <a class="page-link" href="index.php?url=dashboard&amp;action=inWaiting&amp;page=<?= $currentPage - 1; ?>">Précédente</a>
            </li>
            <li class="page-item mt-3 <?= ($currentPage >= $totalPage) ? 'disabled' : '' ?>">
                <a class="page-link" href="index.php?url=dashboard&amp;action=inWaiting&amp;page=<?= $currentPage + 1; ?>">Suivante</a>
            </li>
        </ul>
    </nav>
</div>

<?php require 'footer.php'; ?>

</body>
</html>