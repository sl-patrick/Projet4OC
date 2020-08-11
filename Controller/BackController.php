<?php

require_once './Model/Post.php';
require_once './Model/Comment.php';
require './Model/User.php';


class BackController {

    private $_post;
    private $_comment;
    private $_user;

    public function __construct()
    {
        $this->_post = new Post();
        $this->_comment = new Comment();
        $this->_user = new User();
    }


    public function addPost($title, $contents, $author) {
        //Ajouter un article.
        $post = $this->_post->addPost($title, $contents, $author);
    }

    public function updatePost() {}

    public function deletePostWithComments() {}

    public function deleteComment() {}

    public function connectUser($pseudo, $password) {
        /*
        Transmettre les variables à la méthode getUser de la classe User.
        Si la variable retourne FALSE rester sur la page loginView avec un message d'erreur.
        Si la variable retourne TRUE afficher la vue administration avec un message de bienvenue.  
        */ 
        $getUser = $this->_user->getUser($pseudo, $password);

        if ($getUser === false) {   
            // loginView

        } else {
            
            // dashboard
        }
    }

    public function disconnectedUser() {}
    
}