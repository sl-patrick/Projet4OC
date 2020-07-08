<?php

require('model.php');

class Post extends Database {
    //Méthode pour récupérer les articles.
    public function getPosts() {
        $db = new Database();
        $connection = $db->getConnection();
        //requête
        $result = $connection->query('SELECT id,title,contents,creation_date,author FROM blog_posts ORDER BY id DESC');
        return $result;
    }

    //Méthode pour récupérer un article par son id.
    public function getPost($idPost) {
        $db = new Database();
        $connection = $db->getConnection();
        //requête préparé
        $result = $connection->prepare('SELECT id,title,contents,creation_date,author FROM blog_posts WHERE id=?');
        $result->execute([$idPost]);
        return $result;
    }

    //Méthode pour ajouter un article. 
    
    //Méthode pour supprimer un article.
}