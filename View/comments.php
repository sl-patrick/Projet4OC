<?php

$title = 'Commentaires récents';
require 'header.php';
require 'menu.php';

?>

<main class="min-vh-100">
    <div class="container">
        <div class="col">
            <div class="row">
                <div class="col">
                    <h2 class="text-center">Commentaires récents</h2>
                    <div class="col">
                        <?php
                        foreach ($comments as $comment) {
                        ?>
                            <div class="displayComments card shadow-sm mb-2">
                                <div class="card-body">
                                    <h5 class="card-title"><?= htmlspecialchars($comment['pseudo']); ?></h5>
                                    <div class="card-text mb-2"><?= htmlspecialchars($comment['contents']); ?></div>
                                    <div class="card-text text-muted mb-2"><?= htmlspecialchars($comment['creation_date']); ?></div>
                                </div>
                            </div>
                        <?php
                        }
                        ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</main>

<div class="page-pagination d-flex justify-content-center">
    <nav>
        <ul class="pagination">
            <li class="page-item mt-3 <?= ($currentPage === 1) ? 'disabled' : '' ?>">
                <a class="page-link" href="index.php?url=dashboard&amp;action=comments&amp;page=<?= $currentPage - 1; ?>">Précédente</a>
            </li>
            <li class="page-item mt-3 <?= ($currentPage == $totalPage) ? 'disabled' : '' ?>">
                <a class="page-link" href="index.php?url=dashboard&amp;action=comments&amp;page=<?= $currentPage + 1; ?>">Suivante</a>
            </li>
        </ul>
    </nav>
</div>  

<?php require 'footer.php'; ?>
