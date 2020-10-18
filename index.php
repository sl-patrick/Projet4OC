<?php
session_start();
require 'Controller/FrontController.php';
require 'Controller/BackController.php';

class Router {

    private $_frontController;
    private $_backController;

    public function __construct() {
        $this->_frontController = new FrontController();
        $this->_backController = new BackController();
    }

    public function run() {
        if (isset($_GET['url'])) {

            if ($_GET['url'] === 'post') {
                if (isset($_GET['postId']) AND !empty($_GET['postId'])) {
                    $this->_frontController->articleWithComments($_GET['postId']);
                } else {
                    header('Location:./index.php?url=chapter');
                }

            } elseif ($_GET['url'] === 'chapter') {
                $state = 0;
                if (isset($_GET['page']) AND !empty($_GET['page'])) {
                    $currentPage = intval(strip_tags($_GET['page']));
                    $this->_frontController->chapters($currentPage, $state);

                } else {
                    $currentPage = 1;
                    $this->_frontController->chapters($currentPage, $state);
                }

            } elseif ($_GET['url'] === 'postComment') {
                if (isset($_GET['postId']) AND !empty($_GET['postId'])) {
                    if (isset($_POST['author']) AND isset($_POST['contents'])) {
                        $this->_frontController->postComment($_GET['postId'], $_POST['contents'], $_POST['author']);
                    } 
                }

            } elseif ($_GET['url'] === 'report') {
                if (isset($_GET['idComment']) AND !empty($_GET['idComment'])) {
                    $this->_frontController->reportComment($_GET['idComment']);
                }
            } elseif ($_GET['url'] === 'login') {
                if (isset($_GET['action']) AND $_GET['action'] === 'connect' AND isset($_POST['submit'])) {
                    if (isset($_POST['pseudo']) AND isset($_POST['password'])) {
                        $this->_backController->connectUser($_POST['pseudo'], $_POST['password']);
                    }
                } else {
                    $this->_frontController->login();
                }
                
            } elseif (isset($_SESSION['pseudo'])) {

                if ($_GET['url'] === 'dashboard' AND isset($_GET['action']) AND !empty($_GET['action'])) {
                    
                        if ($_GET['action'] === 'posts') {
                            $state = 0;
                                if (isset($_GET['page']) AND !empty($_GET['page'])) {
                                    $currentPage = intval(strip_tags($_GET['page']));
                                    $this->_backController->allPostsPagination($currentPage,$state);
                                } else {
                                    $currentPage = 1;
                                    $this->_backController->allPostsPagination($currentPage,$state);
                                }
                        } elseif ($_GET['action'] === 'inWaiting') {
                            $state = 1;
                            if (isset($_GET['page']) AND !empty($_GET['page'])) {
                                $currentPage = intval(strip_tags($_GET['page']));
                                $this->_backController->allPostsPagination($currentPage,$state);
                            } else {
                                $currentPage = 1;
                                $this->_backController->allPostsPagination($currentPage,$state);
                            }

                        } elseif ($_GET['action'] === 'comments') {
                            $state = 0;
                            if (isset($_GET['page']) AND !empty($_GET['page'])) {
                                $currentPage = intval(strip_tags($_GET['page']));
                                $this->_backController->allCommentsPagination($currentPage,$state);
                            } else {
                                $currentPage = 1;
                                $this->_backController->allCommentsPagination($currentPage,$state);
                            }

                        } elseif ($_GET['action'] === 'reportComments') {
                            $state = 1;
                            if (isset($_GET['page']) AND !empty($_GET['page'])) {
                                $currentPage = intval(strip_tags($_GET['page']));
                                $this->_backController->allCommentsPagination($currentPage,$state);

                            } else {
                                $currentPage = 1;
                                $this->_backController->allCommentsPagination($currentPage,$state);
                            }
                            
                        } elseif ($_GET['action'] === 'addPost') {

                            if (isset($_POST['newPost'])) {
                                if (isset($_POST['newTitle']) AND isset($_POST['newContents']) AND isset($_POST['authorOfPost'])) {
                                    $this->_backController->addPost($_POST['newTitle'], $_POST['newContents'], $_POST['authorOfPost']);
                                }
                            } elseif (isset($_POST['inWaiting'])) {
                                if (isset($_POST['newTitle']) AND isset($_POST['newContents']) AND isset($_POST['authorOfPost'])) {
                                    $this->_backController->postWaiting($_POST['newTitle'], $_POST['newContents'], $_POST['authorOfPost']);
                                }
                            } else {
                                $this->_backController->addPostView();
                            }
                        } elseif ($_GET['action'] === 'updatePost') {
                            if (isset($_POST['update']) AND isset($_GET['postId']) AND !empty($_GET['postId'])) {
                                $this->_backController->updatePost($_GET['postId'], $_POST['newTitle'], $_POST['newContents'], $_POST['authorOfPost']);

                            } elseif (isset($_POST['putInLine']) AND isset($_GET['postId']) AND !empty($_GET['postId']) ) {
                                $this->_backController->putInLine($_GET['postId'], $_POST['newTitle'], $_POST['newContents'], $_POST['authorOfPost']);
                                
                            } elseif (isset($_GET['postId']) AND !empty($_GET['postId'])) {
                                $this->_backController->getPost($_GET['postId']);
                            }
                        } elseif ($_GET['action'] === 'deletePost') {
                            if (isset($_GET['postId']) AND !empty($_GET['postId'])) {

                                $this->_backController->deletePostWithComments($_GET['postId']);
                            }
                        } elseif ($_GET['action'] === 'deleteComment') {
                            if (isset($_GET['commentId']) AND !empty($_GET['commentId'])) {
                                $this->_backController->deleteComment($_GET['commentId']);
                            }
                        } elseif ($_GET['action'] === 'logout') {
                            $this->_backController->logout();
                        }
                } else {
                    header('Location:./index.php');
                }
            } else {
                $this->_frontController->home();  
            }
        } else {
            $this->_frontController->home();
        }
    }
}

$router = new Router();
$router->run();
