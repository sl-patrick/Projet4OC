<header>
    <nav class="col navbar navbar-expand navbar-dark bg-dark">
        <a class="navbar-brand" href="index.php">Jean Forteroche</a>
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
                <a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown" id="dashboardDropdown" aria-haspopup="true" aria-expanded="false">Tableau de bord</a>
                <div class="dropdown-menu" aria-labelledby="dashboardDropdown">
                    <a href="index.php?url=dashboard" class="dropdown-item">Accueil</a>
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
    </nav>
</header>