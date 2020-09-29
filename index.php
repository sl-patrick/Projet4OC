<?php

session_start();

require 'Controller/FrontController.php';
require 'Controller/BackController.php';

class Router
{

    private $_frontController;
    private $_backController;

    public function __construct()
    {
        $this->_frontController = new FrontController();
        $this->_backController = new BackController();
    }

    public function run()
    {
        try {
            if (isset($_GET['url'])) {
                if ($_GET['url'] === 'post') {
                    if (isset($_GET['postId']) and !empty($_GET['postId'])) {
                        $this->_frontController->articleWithComments($_GET['postId']);
                    } else {
                        $this->_frontController->chapters();
                    }
                } elseif ($_GET['url'] === 'chapter') {
                    $this->_frontController->chapters();
                } elseif ($_GET['url'] === 'postComment') {
                    if (isset($_GET['postId']) and !empty($_GET['postId'])) {
                        if (!empty($_POST['author']) and !empty($_POST['contents'])) {
                            $this->_frontController->postComment($_GET['postId'], $_POST['contents'], $_POST['author']);
                        } else {
                            echo 'tous les champs ne sont pas remplis';
                        }
                    } else {
                        echo 'l\'article n\'est pas disponible';
                    }
                } elseif ($_GET['url'] === 'report') {
                    if (isset($_GET['idComment']) and !empty($_GET['idComment'])) {

                        $this->_frontController->reportComment($_GET['idComment']);
                    }
                } elseif ($_GET['url'] === 'login') {
                    if (isset($_GET['action']) and $_GET['action'] === 'connect' and isset($_POST['submit'])) {
                        if (!empty($_POST['pseudo']) and !empty($_POST['password'])) {

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
                                $state = 0;
                                    if (isset($_GET['page']) AND !empty($_GET['page'])) {
                                        $currentPage = intval(strip_tags($_GET['page']));
                                        $this->_backController->postsPublished($currentPage,$state);
                                    } else {
                                        $currentPage = 1;
                                        $this->_backController->postsPublished($currentPage,$state);
                                    }
                            } elseif ($_GET['action'] === 'inWaiting') {
                                $state = 1;
                                if (isset($_GET['page']) AND !empty($_GET['page'])) {
                                    $currentPage = intval(strip_tags($_GET['page']));
                                    $this->_backController->postsPublished($currentPage,$state);
                                } else {
                                    $currentPage = 1;
                                    $this->_backController->postsPublished($currentPage,$state);
                                }

                            } elseif ($_GET['action'] === 'comments') {
                                $state = 0;
                                if (isset($_GET['page']) AND !empty($_GET['page'])) {
                                    $currentPage = intval(strip_tags($_GET['page']));
                                    $this->_backController->lastComments($currentPage,$state);
                                } else {
                                    $currentPage = 1;
                                    $this->_backController->lastComments($currentPage,$state);
                                }

                            } elseif ($_GET['action'] === 'reportComments') {
                                $state = 1;
                                if (isset($_GET['page']) AND !empty($_GET['page'])) {
                                    $currentPage = intval(strip_tags($_GET['page']));
                                    $this->_backController->lastComments($currentPage,$state);

                                } else {
                                    $currentPage = 1;
                                    $this->_backController->lastComments($currentPage,$state);
                                }
                                
                            } elseif ($_GET['action'] === 'addPost') {

                                if (isset($_POST['newPost'])) {
                                    if (!empty($_POST['newTitle']) and !empty($_POST['newContents']) and !empty($_POST['authorOfPost'])) {
                                        $this->_backController->addPost($_POST['newTitle'], $_POST['newContents'], $_POST['authorOfPost']);
                                    }
                                } elseif (isset($_POST['inWaiting'])) {
                                    if (!empty($_POST['newTitle']) and !empty($_POST['newContents']) and !empty($_POST['authorOfPost'])) {
                                        $this->_backController->postWaiting($_POST['newTitle'], $_POST['newContents'], $_POST['authorOfPost']);
                                    }
                                } else {
                                    $this->_backController->addPostView();
                                }
                            } elseif ($_GET['action'] === 'updatePost') {
                                if (isset($_POST['update']) and isset($_GET['postId']) and !empty($_GET['postId'])) {
                                    $this->_backController->updatePost($_GET['postId'], $_POST['newTitle'], $_POST['newContents'], $_POST['authorOfPost']);
                                }
                                if (isset($_GET['postId']) and !empty($_GET['postId'])) {
                                    $this->_backController->getPost($_GET['postId']);
                                }
                            } elseif ($_GET['action'] === 'deletePost') {
                                if (isset($_GET['postId']) and !empty($_GET['postId'])) {

                                    $this->_backController->deletePostWithComments($_GET['postId']);
                                }
                            } elseif ($_GET['action'] === 'logout') {
                                $this->_backController->logout();
                            }
                        } else {

                            echo 'erreur';
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
