<?php 

$title = 'Connexion'; 
require 'header.php'; 
?>

<main class="min-vh-100">
    <div class=" min-vh-100 container d-flex flex-column align-items-center justify-content-center text-center" id="login_view">
    
        <form id="loginForm" action="index.php?url=connect" method="post">
            <div class="form-group">
                <label for="pseudo" class="sr-only">Pseudo</label>
                <input type="text" name="pseudo" id="pseudo" placeholder="Pseudo">
            </div>
            <div class="form-group">
                <label for="password" class="sr-only">Mot de passe</label>
                <input type="password" name="password" id="password" placeholder="Mot de passe">
            </div>
            <div class="form-group">
                <input type="submit" value="Connexion">
            </div>
            
            <a href="index.php">Retourner sur le site</a>
        
        </form>
    </div>
</main>

</body>
</html>



