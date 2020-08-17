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

                    if (isset($_GET['postId']) AND !empty($_GET['postId'])) {

                        $this->_frontController->articleWithComments($_GET['postId']);
                    } else {
                        
                        $this->_frontController->chapters();
                    }

                } elseif ($_GET['url'] === 'addPost') {

                    if (!empty($_POST['title']) AND !empty($_POST['contents']) AND !empty($_POST['author'])) {
                        
                        $this->_backController->addPost($_POST['title'], $_POST['contents'], $_POST['author']);
                    }

                } elseif ($_GET['url'] === 'updatePost') {
                    
                    $this->_backController->updatePost();

                } elseif ($_GET['url'] === 'deletePost') {
                    
                    $this->_backController->deletePostWithComments();

                } elseif ($_GET['url'] === 'postComment') {

                    if (isset($_GET['postId']) AND !empty($_GET['postId'])) {
                        if (!empty($_POST['author']) AND !empty($_POST['contents'])) {
                            
                            $this->_frontController->postComment($_GET['postId'], $_POST['contents'], $_POST['author']);
                            
                        } else {
                            echo 'tout les champs ne sont pas remplis';
                        }
                    } else {
                        echo 'l\'article n\'est pas disponible';
                    } 
                    
                } elseif ($_GET['url'] === 'login') {
                    if (isset($_GET['action']) AND $_GET['action'] === 'connect' AND isset($_POST['submit'])) {
                        if (!empty($_POST['pseudo']) AND !empty($_POST['password'])) {
                
                            $this->_backController->connectUser($_POST['pseudo'], $_POST['password']);
    
                        } elseif (empty($_POST['pseudo'])) {
                            echo 'pseudo manquant';
                        } elseif (!empty($_POST['password'])) {
                            echo 'mot de passe manquant';
                        }
                    } else {
                        $this->_frontController->login();
                    }

                } elseif ($_GET['url'] === 'signup') {
                    if (isset($_POST['signup'])) {
                        if (!empty($_POST['newPseudo']) AND !empty($_POST['newPassword']) AND !empty($_POST['confirmPassword'])) {
                            if ($_POST['newPassword'] !== $_POST['confirmPassword']) {
                                echo 'le mot de passe ne correspond pas';
                            } else {
                                $this->_frontController->createUser($_POST['newPseudo'],$_POST['newPassword']);
                            }
                        } elseif (empty($_POST['newPseudo']) OR empty($_POST['newPassword']) OR empty($_POST['confirmPassword'])) {
                            echo 'tout les champs ne sont pas remplis';
                        }
                    } else {
                        
                        $this->_frontController->signUp();
                        
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
