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

    //Méthode pour afficher la page d'accueil.
    public function home()
    {
        $posts = $this->_post->getPosts();
        require './View/homeView.php';
    }

    //Méthode pour afficher la page des chapitres.
    public function chapters()
    {
        $posts = $this->_post->getPosts();
        require './View/chapterView.php';
    }

    //Méthode pour afficher la page d'un article.
    public function articleWithComments($id)
    {
        $posts = $this->_post->getPost($id);
        $comments = $this->_comment->getCommentsFromPost($id);
        require './View/postView.php';
    }

    public function postComment($postId, $contents, $author)
    {
        $comments = $this->_comment->addCommentFromPost($postId, $contents, $author);
        echo json_encode($_POST);
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
