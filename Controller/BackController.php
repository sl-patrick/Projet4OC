<?php

require_once './Model/Post.php';
require_once './Model/Comment.php';
require_once './Model/User.php';


class BackController
{

    private $_post;
    private $_comment;
    private $_user;

    public function __construct()
    {
        $this->_post = new Post();
        $this->_comment = new Comment();
        $this->_user = new User();
    }

    public function addPostView()
    {
        require './View/addPostView.php';
    }

    public function addPost($title, $contents, $author)
    {
        $verifyTitle = htmlspecialchars(strip_tags($title));
        $verifyContents = htmlspecialchars(strip_tags($contents));

        $post = $this->_post->addPost($verifyTitle, $verifyContents, $author);
        header('Location:./index.php?url=dashboard&action=posts');
    }

    public function postWaiting($title, $contents, $author)
    {
        $verifyTitle = htmlspecialchars(strip_tags($title));
        $verifyContents = htmlspecialchars(strip_tags($contents));

        $post = $this->_post->inWaiting($verifyTitle, $verifyContents, $author);
        header('Location:./index.php?url=dashboard');
    }

    public function getPost($postId)
    {
        $getArticle = $this->_post->getPost($postId);
        require './View/updatePost.php';
    }

    public function updatePost($id, $title, $contents, $author)
    {

        $verifyTitle = htmlspecialchars(strip_tags($title));
        $verifyContents = htmlspecialchars(strip_tags($contents));

        $updateArticle = $this->_post->updatePost($id, $verifyTitle, $verifyContents, $author);
        header('Location:./index.php?url=dashboard&action=posts');
    }

    public function deletePostWithComments($postId)
    {

        $deletePost = $this->_post->deletePost($postId);
        $deleteComment = $this->_comment->deleteCommentsFromPost($postId);
        header('Location:./index.php?url=dashboard');
    }

    public function deleteComment($commentId)
    {
        $deleteComment = $this->_comment->deleteComment($commentId);
        header('Location:./index.php?url=dashboard&action=posts');

    }

    public function allPostsPagination($currentPage,$state)
    {    
        $countPosts = $this->_post->countPosts($state);
        $perPage = 5;
        $firstArticle = ($currentPage * $perPage) - $perPage;
        $posts = $this->_post->getPostsByState($firstArticle, $perPage,$state);
        $totalPage = ceil(intval($countPosts) / $perPage);
        if ($currentPage > $totalPage) {
            header('Location:./index.php');
        } elseif ($state === 0) {
            require './View/postsPublished.php';
        } elseif ($state === 1) {
            require './View/postsInWaiting.php';
        }
    }

    public function allCommentsPagination($currentPage,$state)
    {

        $countComments = $this->_comment->countAllComments($state);
        $perPage = 5;
        $firstComment = ($currentPage * $perPage) - $perPage;
        $comments = $this->_comment->getCommentsByState($firstComment, $perPage, $state);
        $totalPage = ceil(intval($countComments) / $perPage);
        if ($currentPage > $totalPage) {
            header('Location:./index.php');
        } elseif ($state === 0) {
            require './View/comments.php'; 
        } elseif ($state === 1) {
            require './View/reportComments.php';
        }

    }
   
    public function connectUser($pseudo, $password)
    {
        $verifyPseudo = htmlspecialchars(strip_tags($pseudo));
        $verifyPassword = htmlspecialchars(strip_tags($password));
        // $verifyPassword = htmlspecialchars(strip_tags(password_hash($password, PASSWORD_DEFAULT)));

        $user = $this->_user->checkUser($verifyPseudo, $verifyPassword);

        if ($user === false) {
            require './View/loginView.php';
        } else {
        header('Location:./index.php');
        exit;
        }
    }

    public function logout()
    {
        session_destroy();

        header('Location:./index.php');
    }
}
