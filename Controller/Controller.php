<?php

require('Model/Post.php');


class FrontController {

    //Méthode pour afficher la page d'accueil.
    public function home() {
        $post = new Post();
        $posts = $post->getPosts();
        require('./View/homeView.php');
    }

    //Méthode pour afficher la page des chapitres.
    public function chapters() {
        require('./View/chapterView.php');
    }

    //Méthode pour afficher la page d'un article.
    public function post($id) {
        $post = new Post();
        $posts = $post->getPost($id);
        require('./View/postView.php');
    }

    //Méthode pour afficher les commentaires d'un article.
    public function comments() {}
}