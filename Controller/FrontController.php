<?php

require 'Model/Post.php';
require 'Model/Comment.php';
require_once './Model/User.php';



class FrontController
{

    private $_post;
    private $_comment;

    public function __construct() {
        $this->_post = new Post();
        $this->_comment = new Comment();
    }

    public function home() {
        $posts = $this->_post->getThreeLastPosts();
        require './View/homeView.php';
    }

    public function chapters($currentPage, $state) {
       
        $countPosts = $this->_post->countPosts($state);
        $perPage = 5;
        $firstPost = ($currentPage * $perPage) - $perPage;
        $posts = $this->_post->getPostsByState($firstPost, $perPage, $state);
        $totalPage = ceil(intval($countPosts) / $perPage);
        if ($totalPage == 0) {
            $totalPage = 1;
        } elseif ($currentPage > $totalPage) {
            header('Location:./index.php');
        }
        require './View/chapterView.php';
    }

    public function articleWithComments($id) {
        $posts = $this->_post->getPost($id);
        $comments = $this->_comment->getCommentsFromPost($id);
        if ($posts[0]['id'] === null) {
            header('Location:./index.php');
        } else {
            require './View/postView.php';
            
        }
        
    }

    public function postComment($postId, $contents, $author) {

        if (empty($author) OR empty($contents)) {
            $errorMessage = 'Tous les champs ne sont pas remplis';
            echo json_encode($errorMessage);  
            return false;
        } else {

            $comments = $this->_comment->addCommentFromPost($postId, $contents, $author);
            ob_start();
            require './View/instantCommentView.php';
            $page = ob_get_contents();
            ob_get_clean();
            echo json_encode($page);   
        }
    }

    public function reportComment($commentId) {
        $report = $this->_comment->reportComment($commentId);
        echo json_encode($report);
    }

    public function login() {
        require './View/loginView.php';
    }

}
