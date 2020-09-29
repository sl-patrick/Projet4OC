<?php

$title = 'Commentaires signalés';
require 'header.php';
require 'menu.php';

?>

<div class="row m-0">
    <div class="col">
        <h4 class="text-center">Commentaires signalés</h4>
        <div class="col">
            <?php 
            foreach ($lastReportComments as $reportComment) {
    
            ?>
                <div class="card">
                    <div class="card-body">
                        <div class="card-title"><?= htmlspecialchars($reportComment['pseudo']); ?></div>
                        <div class="card-text"><?= htmlspecialchars($reportComment['contents']); ?></div>
                        <div class="card-text"><?= htmlspecialchars($reportComment['creation_date']); ?></div>
                    </div>
                </div>
            <?php
            }
            ?>
        </div>
    </div>

</div>
<?php require 'footer.php'; ?>

</body>

</html>