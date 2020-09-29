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
        header('Location:./index.php?url=dashboard');
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
        header('Location:./index.php?url=dashboard');
    }

    public function deletePostWithComments($postId)
    {

        $deletePost = $this->_post->deletePost($postId);
        $deleteComment = $this->_comment->deleteCommentsFromPost($postId);
        header('Location:./index.php?url=dashboard');
    }

    public function deleteComment()
    {}

    public function allPostsPagination($currentPage,$state)
    {    
        $perPage = 1;
        $firstArticle = ($currentPage * $perPage) - $perPage;
        // $state = 0;    
        if ($state === 0) {
            $postsPublished = $this->_post->getPostsByState($firstArticle, $perPage, $state);
            var_dump($postsPublished[0]['post_waiting']);
            $totalPage = ceil(intval($postsPublished) / $perPage);
            require './View/postsPublished.php';
        } elseif ($state === 1) {
            $postsInWaiting = $this->_post->getPostsByState($firstArticle, $perPage,$state);
            $totalPageWaiting = ceil(intval($postsInWaiting) / $perPage);
            require './View/postsInWaiting.php';
        }
    }

    public function allCommentsPagination($currentPage,$state)
    {
        $perPage = 1;
        $firstComment = ($currentPage * $perPage) - $perPage;
        
        if ($state === 0) {
            $lastComments = $this->_comment->commentsPublished($firstComment, $perPage, $state);
            $totalPage = ceil(intval($lastComments) / $perPage);
            require './View/comments.php';
        } elseif ($state === 1) {
            $lastReportComments = $this->_comment->commentsPublished($firstComment, $perPage, $state);
            $totalPage = ceil(intval($lastReportComments) / $perPage);
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
