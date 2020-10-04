<?php 

$title = 'Mon blog';

require 'header.php'; 
require 'menu.php'; 


?>

<section id="hero">
    <div class="jumbotron jumbotron-fluid text-center">
        <div class="container"></div>
    </div>
</section>
<main class="min-vh-100">

    <div class="container">
        <div class="row d-flex justify-content-center">
            <?php
            while ($post = $posts->fetch()) {
            ?>
                <div class="card text-center col-lg-5 m-3 p-0">
                    <div class="card-header"></div>
                    <div class="card-body">
                        <h2 class="card-title text-uppercase">
                            <a class="card-link" href="index.php?url=post&amp;postId=<?= htmlspecialchars($post['id']); ?>">
                            <?= htmlspecialchars($post['title']); ?>
                            </a>
                        </h2>
                        <p class="card-text"><?= mb_strimwidth(htmlspecialchars($post['contents']), 0, 200, '...'); ?>
                        <span>
                            <a class="card-link" href="index.php?url=post&amp;postId=<?= htmlspecialchars($post['id']); ?>">Lire la suite</a>
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
            $posts->closeCursor();
            ?>
        </div>
    </div>
</main>

<?php require 'footer.php'; ?>