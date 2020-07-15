<?php

require('model.php');

class Post extends Database {

    //Méthode pour récupérer les articles.
    public function getPosts() {
        //connexion a la base de données.
        $db = new Database();
        $connection = $db->getConnection();
        //requête.
        $result = $connection->query('SELECT id,title,contents,creation_date,author FROM blog_posts ORDER BY id DESC');
        return $result;
    }

    //Méthode pour récupérer un article par son id.
    public function getPost($postId) {
        $db = new Database();
        $connection = $db->getConnection();
        //requête préparé
        $result = $connection->prepare('SELECT id,title,contents,creation_date,author FROM blog_posts WHERE id=?');
        $result->execute([$postId]);
        return $result;
    }

    //Méthode pour ajouter un article.
    public function addPost() {
        $db = new Database();
        $connection = $db->getConnection();
        $result = $connection->prepare('INSERT INTO blog_posts(title,contents,author) VALUES(:title, :contents, :author)');
        $result->execute(array());
    }

    //Méthode pour modifier un article(id).
    public function updatePost($postId) {
        $db = new Database();
        $connection = $db->getConnection();
        $result = $connection->prepare('UPDATE blog_posts SET ');
        $result->execute(array());

    }
    
    //Méthode pour supprimer un article(id).
    public function deletePost($postId) {
        $db = new Database();
        $connection = $db->getConnection();
        $result = $connection->prepare('DELETE FROM blog_posts WHERE ');
        $result->execute(array());
    }
}