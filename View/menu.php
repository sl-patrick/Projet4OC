<header>
    <nav class="col navbar navbar-expand-lg navbar-dark bg-dark">
        <a class="navbar-brand" href="index.php">Jean Forteroche</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div id="navbarResponsive" class="collapse navbar-collapse">
        <ul class="navbar-nav">
<?php
if (isset($_SESSION['pseudo'])) {
    ?>
            <li class="nav-item">
                <a href="index.php" class="nav-link">Accueil</a>
            </li>
            <li class="nav-item">
                <a href="index.php?url=chapter" class="nav-link">Chapitres</a>
            </li>
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" data-toggle="dropdown" id="dashboardDropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">Tableau de bord</a>
                <div class="dropdown-menu" aria-labelledby="dashboardDropdown">
                    <a href="index.php?url=dashboard&amp;action=posts" class="dropdown-item">Articles publiés</a>
                    <a href="index.php?url=dashboard&amp;action=inWaiting" class="dropdown-item">Brouillons</a>
                    <a href="index.php?url=dashboard&amp;action=comments" class="dropdown-item">Commentaires</a>
                    <a href="index.php?url=dashboard&amp;action=reportComments" class="dropdown-item">Commentaires signalés</a>
                    <a href="index.php?url=dashboard&amp;action=addPost" class="dropdown-item">Ajouter un article</a>
                </div>
            <li class="nav-item ">
                <a href="index.php?url=dashboard&amp;action=logout" class="nav-link">Déconnexion</a>
            </li>
            
    <?php
} else {
    ?>
            <li class="nav-item">
                <a href="index.php" class="nav-link">Accueil</a>
            </li>
            <li class="nav-item">
                <a href="index.php?url=chapter" class="nav-link">Chapitres</a>
            </li>
    <?php
}
?>
        </ul>
        </div>
    </nav>
</header>