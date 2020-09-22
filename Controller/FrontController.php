<?php

require 'Model/Post.php';
require 'Model/Comment.php';
require_once './Model/User.php';



class FrontController
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

    public function home()
    {
        $posts = $this->_post->getPosts();
        require './View/homeView.php';
    }

    public function chapters()
    {
        $posts = $this->_post->getPosts();
        require './View/chapterView.php';
    }

    public function articleWithComments($id)
    {
        $posts = $this->_post->getPost($id);
        $comments = $this->_comment->getCommentsFromPost($id);
        require './View/postView.php';
    }

    public function postComment($postId, $contents, $author)
    {
        $comments = $this->_comment->addCommentFromPost($postId, $contents, $author);
        ob_start();
        require './View/instantCommentView.php';
        $page = ob_get_contents();
        ob_get_clean();
        echo json_encode($page);
    }

    public function reportComment($commentId) {
        $report = $this->_comment->reportComment($commentId);
        echo json_encode($report);
    }

    public function login()
    {
        require './View/loginView.php';
    }

    public function signUp()
    {
        require './View/signUpForm.php';
    }

    public function createUser($pseudo, $password)
    {
        $verifyPseudo = htmlspecialchars(strip_tags($pseudo));
        $verifyPassword = htmlspecialchars(strip_tags(password_hash($password, PASSWORD_DEFAULT)));

        $users = $this->_user->addUser($verifyPseudo, $verifyPassword);

        if (!$users) {
            header('Location:./index.php?url=signup');
            exit;
        } else {
            header('Location:./index.php?url=login');
            exit;
        }


    }
}
