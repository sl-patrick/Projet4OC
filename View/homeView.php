<?php 

$title = 'Mon blog';

require 'header.php'; 
require 'menu.php'; 


?>

<main class="min-vh-100">
    <section id="hero">
        <div class="jumbotron text-center">
            <div class="container"></div>
        </div>
    </section>

    <div class="container">
        <div class="row">
            <?php
            while ($post = $posts->fetch()) {
            ?>
                <div class="card">
                    <div class="card-body">
                        <h3 class="card-title">
                            <a href="index.php?url=post&amp;postId=<?= htmlspecialchars($post['id']); ?>">
                            <?= htmlspecialchars($post['title']); ?>
                            </a>
                        </h3>
                        <p class="card-text"><?= htmlspecialchars($post['contents']); ?></p>
                        <p><?= htmlspecialchars($post['author']); ?></p>
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