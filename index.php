<!-- ROUTEUR -->
<?php

require 'Controller/FrontController.php';
require 'Controller/BackController.php';

class Router {

    private $_frontController;
    private $_backController;

    public function __construct()
    {
        $this->_frontController = new FrontController();
        $this->_backController = new BackController();

    }

    public function run() {
        try {
            if (isset($_GET['url'])) {
                if ($_GET['url'] === 'post') {
                    if (isset($_GET['postId']) AND $_GET['postId'] !== '') {
                        $this->_frontController->articleWithComments($_GET['postId']);
                    } else {
                        $this->_frontController->chapters();
                    }
                } elseif ($_GET['url'] === 'postComment') {
                    if (isset($_GET['postId'])) {
                        if (!empty($_POST['author']) AND !empty($_POST['contents'])) {
                            $this->_frontController->postComment($_GET['postId'], $_POST['contents'], $_POST['author']);

                        } else {
                            echo 'tout les champs ne sont pas remplis';
                        }
                    } else {
                        echo 'l\'article n\'est pas disponible';
                    } 
                } elseif ($_GET['url'] === 'chapter') {
                    $this->_frontController->chapters();
                } else {
                    //Afficher page d'erreur.
                    echo 'page inconnue';
                }
            } else {
                $this->_frontController->home();
            }
        } catch (Exception $error) {
            echo $error->getMessage();
        }
    }  
}

$router = new Router();
$router->run();
