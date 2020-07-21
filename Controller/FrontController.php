<?php

require 'Model/Post.php';
require 'Model/Comment.php';


class FrontController {

    private $_post;
    private $_comment;

    public function __construct()
    {
        $this->_post = new Post();
        $this->_comment = new Comment();
    }

    //Méthode pour afficher la page d'accueil.
    public function home() {
        $posts = $this->_post->getPosts();
        require './View/homeView.php';
    }

    //Méthode pour afficher la page des chapitres.
    public function chapters() {
        $posts = $this->_post->getPosts();
        require './View/chapterView.php';
    }

    //Méthode pour afficher la page d'un article.
    public function post($id) {
        $posts = $this->_post->getPost($id);
        $comments = $this->_comment->getCommentsFromPost($id);
        require './View/postView.php';
    }
}

