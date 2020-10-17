<?php

$title = 'Commentaires signalés';
require 'header.php';
require 'menu.php';

?>


<main class="min-vh-100">
    <div class="container">
        <div class="row m-0">
            <div class="col">
                <h2 class="text-center">Commentaires signalés</h2>
                <div class="col">
                    <?php 
                    foreach ($comments as $comment) {
                    ?>
                        <div class="card shadow-sm mb-2">
                            <div class="card-body">
                                <h5 class="card-title"><?= htmlspecialchars($comment['pseudo']); ?></h5>
                                <div class="card-text mb-2"><?= htmlspecialchars($comment['contents']); ?></div>
                                <div class="card-text text-muted mb-2"><?= htmlspecialchars($comment['creation_date']); ?></div>
                                <a href="index.php?url=dashboard&amp;action=deleteComment&amp;commentId=<?= htmlspecialchars($comment['id']); ?>" class="card-link btn btn-dark">Supprimer</a>
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
                <a class="page-link" href="index.php?url=dashboard&amp;action=reportComments&amp;page=<?= $currentPage - 1; ?>">Précédente</a>
            </li>
            <li class="page-item mt-3 <?= ($currentPage >= $totalPage) ? 'disabled' : '' ?>">
                <a class="page-link" href="index.php?url=dashboard&amp;action=reportComments&amp;page=<?= $currentPage + 1; ?>">Suivante</a>
            </li>
        </ul>
    </nav>
</div>

<?php require 'footer.php'; ?>
