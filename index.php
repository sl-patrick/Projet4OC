<!-- ROUTEUR -->
<?php

require('Controller/Controller.php');

class Router {

    public function run() {
        try {
            if (isset($_GET['url'])) {
                var_dump($_GET['url']);
                if ($_GET['url'] === 'post') {
                    if (isset($_GET['postId']) && is_int($_GET['postId'])) {
                        //Afficher la page post.
                        $frontController = new FrontController();
                        $frontController->post($_GET['postId']);
                    } else {
                        $frontController = new FrontController();
                        $frontController->chapters();
                    }
                } elseif ($_GET['url'] === 'chapter') {
                    //Afficher la page chapitre.
                    $frontController = new FrontController();
                    $frontController->chapters();
                } else {
                    //Afficher page d'erreur.
                    echo'page inconnue';
                }
            } else {
                //Afficher la page d'accueil.
                $frontController = new FrontController();
                $frontController->home();
            }
        } catch (Exception $error) {
            echo $error->getMessage();
        }
    }  
}

$router = new Router();
$router->run();
