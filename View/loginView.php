<?php
$title = 'Connexion';
require 'header.php';
?>

<main class="min-vh-100">
    <div class=" min-vh-100 container d-flex flex-column align-items-center justify-content-center text-center" id="login_view">
        <h1>Connexion</h1>
        <form id="loginForm" action="index.php?url=login&amp;action=connect" method="POST">
            <?php
            if (isset($errorMessage)) {
            ?>
                <div class="form-group row">
                    <small id="validationMessage" class="invalid-feedback d-block"><?= htmlspecialchars($errorMessage); ?></small>
                </div>
            <?php
            }
            ?>
            <div class="form-group row">
                <label for="pseudo" class="sr-only">Pseudo</label>
                <input class="form-control" type="text" name="pseudo" id="pseudo" placeholder="Pseudo" aria-describedby="validationMessage">
            </div>
            <div class="form-group row">
                <label for="password" class="sr-only">Mot de passe</label>
                <input class="form-control" type="password" name="password" id="password" placeholder="Mot de passe" aria-describedby="validationMessage">
            </div>
            <div class="form-group row justify-content-center">
                <input class="btn btn-dark" type="submit" name="submit" value="Connexion">
            </div>
            <div class="form-group row justify-content-center">
                <a class="text-decoration-none text-dark" href="index.php">Retourner sur le site</a>
            </div>
        </form>
    </div>
</main>

<?php require 'footer.php'; ?>