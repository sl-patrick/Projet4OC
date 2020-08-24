<?php $title = 'Chapitres'; ?>

<?php 
require 'header.php'; 
require 'menu.php';
?>

<main class="min-vh-100">
    <section>
        <div class="jumbotron">
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
                        <h2 class="card-title"><a href="index.php?url=post&amp;postId=<?= htmlspecialchars($post['id']); ?>"><?= htmlspecialchars($post['title']); ?></a></h2>
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