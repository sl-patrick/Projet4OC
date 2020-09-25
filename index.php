<?php

session_start();

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

                } elseif ($_GET['url'] === 'chapter') { 
                    $this->_frontController->chapters();
                
                } elseif ($_GET['url'] === 'postComment') {
                    if (isset($_GET['postId']) AND !empty($_GET['postId'])) {
                        if (!empty($_POST['author']) AND !empty($_POST['contents'])) {
                            $this->_frontController->postComment($_GET['postId'], $_POST['contents'], $_POST['author']);
                        } else {
                            echo 'tous les champs ne sont pas remplis';
                        }
                    } else {
                        echo 'l\'article n\'est pas disponible';
                    } 
                    
                } elseif ($_GET['url'] === 'report') {
                    if (isset($_GET['idComment']) AND !empty($_GET['idComment'])) {
                        
                        $this->_frontController->reportComment($_GET['idComment']);
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
                    
                } elseif (isset($_SESSION['pseudo'])) {

                    if ($_GET['url'] === 'dashboard') {

                        if (isset($_GET['action'])) {
                            if ($_GET['action'] === 'posts') {
                                    if ($_GET['url'] === 'postsPublished') {
                                        if (isset($_GET['page']) AND !empty($_GET['page'])) {
                                            $currentPage = intval(strip_tags($_GET['page']));
                                            $this->_backController->postsPublished($currentPage);
                                        } else {
                                            $currentPage = 1;
                                            $this->_backController->postsPublished($currentPage);
                                        }
                                        
                                    } elseif ($_GET['url'] === 'postsInWaiting') {
                                        if (isset($_GET['page']) AND !empty($_GET['page'])) {
                                            $currentPage = intval(strip_tags($_GET['page']));
                                            $this->_backController->postsWaiting($currentPage);
                                        } else {
                                            $currentPage = 1;
                                            $this->_backController->postsWaiting($currentPage);
                                        }
                                        
                                    }
                                
                                $this->_backController->dashboard();
                                
                            } elseif ($_GET['action'] === 'comments') {
                               

                                
                            } elseif ($_GET['action'] === 'addPost') {

                                if (isset($_POST['newPost'])) {
                                    if (!empty($_POST['newTitle']) AND !empty($_POST['newContents']) AND !empty($_POST['authorOfPost'])) {
                                        $this->_backController->addPost($_POST['newTitle'], $_POST['newContents'], $_POST['authorOfPost']);
                                    }   
                                } elseif (isset($_POST['inWaiting'])) {
                                    if (!empty($_POST['newTitle']) AND !empty($_POST['newContents']) AND !empty($_POST['authorOfPost'])) {
                                        $this->_backController->postWaiting($_POST['newTitle'], $_POST['newContents'], $_POST['authorOfPost']);
                                    }   
                                } else {
                                    $this->_backController->addPostView();
                                }
                            } elseif ($_GET['action'] === 'updatePost') {
                                if (isset($_POST['update']) AND isset($_GET['postId']) AND !empty($_GET['postId'])) {
                                    $this->_backController->updatePost($_GET['postId'], $_POST['newTitle'], $_POST['newContents'], $_POST['authorOfPost']);
                                }
                                if (isset($_GET['postId']) AND !empty($_GET['postId'])) {
                                    $this->_backController->getPost($_GET['postId']); 
                                }

                            } elseif ($_GET['action'] === 'deletePost') {
                                if (isset($_GET['postId']) AND !empty($_GET['postId'])) {

                                    $this->_backController->deletePostWithComments($_GET['postId']);
                                }  

                            }  elseif ($_GET['action'] === 'logout') {
                                $this->_backController->logout();
                            }

                        } else {
                            echo 'revoir';
                            $this->_backController->dashboard();
                        }
                    }
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
