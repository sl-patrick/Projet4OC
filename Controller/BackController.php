<?php
require_once './Model/Post.php';
require_once './Model/Comment.php';
require_once './Model/User.php';


class BackController {

    private $_post;
    private $_comment;
    private $_user;

    public function __construct() {
        $this->_post = new Post();
        $this->_comment = new Comment();
        $this->_user = new User();
    }

    public function addPostView() {
        require './View/addPostView.php';
    }

    public function addPost($title, $contents, $author) {
        if (empty($title) OR empty($contents) OR empty($author)) {
            $errorMessage = 'Tous les champs ne sont pas remplis';
            require './View/addPostView.php';
        } else {
            $verifyTitle = htmlspecialchars(strip_tags($title));
            $verifyContents = htmlspecialchars($contents);
            $post = $this->_post->addPost($verifyTitle, $verifyContents, $author);
            header('Location:./index.php?url=dashboard&action=posts');
        }
    }

    public function postWaiting($title, $contents, $author) {
        if (empty($title) OR empty($contents) OR empty($author)) {
            $errorMessage = 'Tous les champs ne sont pas remplis';
            require './View/addPostView.php';
        } else {
            $verifyTitle = htmlspecialchars(strip_tags($title));
            $verifyContents = htmlspecialchars($contents);
            $post = $this->_post->inWaiting($verifyTitle, $verifyContents, $author);
            header('Location:./index.php?url=dashboard&action=inWaiting');
        }

    }

    public function getPost($postId) {
        $getArticle = $this->_post->getPost($postId);
        require './View/updatePost.php';
    }

    public function updatePost($id, $title, $contents, $author) {   
        if (empty($title) OR empty($contents) OR empty($author)) {
            header('Location:./index.php?url=dashboard&action=updatePost&postId='. $id .'');
        } else {
        $verifyTitle = htmlspecialchars(strip_tags($title));
        $verifyContents = htmlspecialchars($contents);
        $updateArticle = $this->_post->updatePost($id, $verifyTitle, $verifyContents, $author);
        header('Location:./index.php?url=dashboard&action=inWaiting');
        }
    }

    public function putInLine($id, $title, $contents, $author) {
        if (empty($title) OR empty($contents) OR empty($author)) {
            header('Location:./index.php?url=dashboard&action=updatePost&postId='. $id .'');
        } else {
            $verifyTitle = htmlspecialchars(strip_tags($title));
            $verifyContents = htmlspecialchars($contents);
            $postPutInLine = $this->_post->putInLine($id, $verifyTitle, $verifyContents, $author);
            header('Location:./index.php');
        }
    }

    public function deletePostWithComments($postId) {
        $deletePost = $this->_post->deletePost($postId);
        $deleteComment = $this->_comment->deleteCommentsFromPost($postId);
        header('Location:./index.php?url=dashboard&action=posts');
    }

    public function deleteComment($commentId) {
        $deleteComment = $this->_comment->deleteComment($commentId);
        header('Location:./index.php?url=dashboard&action=reportComments');
    }

    public function allPostsPagination($currentPage,$state) {    
        $countPosts = $this->_post->countPosts($state);
        $perPage = 5;
        $firstArticle = ($currentPage * $perPage) - $perPage;
        $posts = $this->_post->getPostsByState($firstArticle, $perPage,$state);
        $totalPage = ceil(intval($countPosts) / $perPage);
        if ($totalPage == 0) {
            $totalPage = 1;
        }
        if ($currentPage > $totalPage) {
            header('Location:./index.php');
        } elseif ($state === 0) {
            require './View/postsPublished.php';
        } elseif ($state === 1) {
            require './View/postsInWaiting.php';
        }
    }

    public function allCommentsPagination($currentPage,$state) {
        $countComments = $this->_comment->countAllComments($state);
        $perPage = 5;
        $firstComment = ($currentPage * $perPage) - $perPage;
        $comments = $this->_comment->getCommentsByState($firstComment, $perPage, $state);
        $totalPage = ceil(intval($countComments) / $perPage);
        if ($totalPage == 0) {
            $totalPage = 1;
        }
        if ($currentPage > $totalPage) {
            header('Location:./index.php');
        } elseif ($state === 0) {
            require './View/comments.php'; 
        } elseif ($state === 1) {
            require './View/reportComments.php';
        }
    }
   
    public function connectUser($pseudo, $password) {
        if (empty($pseudo) OR empty($password)) {
            $errorMessage = 'Tous les champs ne sont pas remplis';
            require './View/loginView.php';
        } elseif (!empty($pseudo) AND !empty($password)) {
            $verifyPseudo = htmlspecialchars(strip_tags($pseudo));
            $verifyPassword = htmlspecialchars(strip_tags($password));
    
            $user = $this->_user->checkUser($verifyPseudo, $verifyPassword);
    
            if ($user === false) {
                $errorMessage = 'Le pseudo ou le mot de passe est invalide';
                require './View/loginView.php';
            } else {
            header('Location:./index.php');
            exit;
            }
        }
    }

    public function logout() {
        session_destroy();
        header('Location:./index.php');
    }
}
