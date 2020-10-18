<?php
$title = 'Chapitres';
require 'header.php';
require 'menu.php';
?>

<section id="hero">
    <div class="jumbotron jumbotron-fluid background text-center">
        <div class="container-fluid background-opacity text-white">
            <h1>Les chapitres</h1>
            <hr class="my-3">
        </div>
    </div>
</section>

<main class="min-vh-100">
    <div class="container-fluid">
        <div class="row d-flex justify-content-center">
            <?php
            foreach ($posts as $post) {
            ?>
                <div class="card col-lg-5 m-2 p-0 text-center">
                    <div class="card-header"></div>

                    <div class="card-body">
                        <h2 class="card-title text-uppercase">
                            <a class="card-link text-dark" href="index.php?url=post&amp;postId=<?= htmlspecialchars($post['id']); ?>"><?= htmlspecialchars($post['title']); ?></a>
                        </h2>
                        <p class="card-text"><?= mb_strimwidth(html_entity_decode($post['contents']), 0, 200, '...'); ?>
                            <span>
                                <a href="index.php?url=post&amp;postId=<?= htmlspecialchars($post['id']); ?>">Lire la suite</a>
                            </span>
                        </p>
                    </div>
                    <div class="card-footer text-muted">
                        <p>Par : <?= htmlspecialchars($post['author']); ?></p>
                        <p>Créé le : <?= htmlspecialchars($post['creation_date']); ?></p>
                    </div>
                </div>
            <?php
            }
            ?>
        </div>
        <div class="page-pagination d-flex justify-content-center">
            <nav>
                <ul class="pagination">
                    <li class="page-item mt-3 <?= ($currentPage === 1) ? 'disabled' : '' ?>">
                        <a class="page-link" href="index.php?url=chapter&amp;page=<?= $currentPage - 1; ?>">Précédente</a>
                    </li>
                    <li class="page-item mt-3 <?= ($currentPage == $totalPage) ? 'disabled' : '' ?>">
                        <a class="page-link" href="index.php?url=chapter&amp;page=<?= $currentPage + 1; ?>">Suivante</a>
                    </li>
                </ul>
            </nav>
        </div>
    </div>
</main>

<?php require 'footer.php'; ?>