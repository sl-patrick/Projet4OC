<?php

require 'model.php';

class Post extends Database {
    
    //Méthode pour récupérer les articles.
    public function getPosts() {
        $result = $this->getConnection()->query('SELECT id,title,contents,creation_date,author,post_waiting FROM blog_posts WHERE post_waiting = 0 ORDER BY id DESC');
        return $result;
    }

    public function countAllPosts() {
        $pdo = $this->getConnection();
        //Nombre d'articles en attentes
        $allArticles = $pdo->query('SELECT COUNT(*) FROM blog_posts');
        $allArticles = $allArticles->fetch();
        return $allArticles;
    }

    public function getPostsByState($firstArticle, $perPage, $state) {
        $pdo = $this->getConnection();
        if ($state === 0) {
            $limitArticles = $pdo->prepare('SELECT * FROM blog_posts WHERE post_waiting = :states ORDER BY creation_date DESC LIMIT :firstArticle, :perPage');
        } elseif($state === 1) {
            $limitArticles = $pdo->prepare('SELECT * FROM blog_posts WHERE post_waiting = :states ORDER BY creation_date DESC LIMIT :firstArticle, :perPage');
        }    
        $limitArticles->bindValue(':firstArticle', $firstArticle, PDO::PARAM_INT);
        $limitArticles->bindValue(':perPage', $perPage, PDO::PARAM_INT);
        $limitArticles->bindValue(':states', $state, PDO::PARAM_INT);
        $limitArticles->execute();
        $articles = $limitArticles->fetchAll(PDO::FETCH_ASSOC);
        return $articles;
    }

    //Méthode pour récupérer un article par son id.
    public function getPost($postId) {
        $result = $this->getConnection()->prepare('SELECT id,title,contents,creation_date,author FROM blog_posts WHERE id = :id');
        $result->execute(array('id' => $postId));
        return $result;
    }

    //Méthode pour ajouter un article.
    public function addPost($title, $contents, $author) {
        $result = $this->getConnection()->prepare('INSERT INTO blog_posts(title, contents, author, creation_date, post_waiting) VALUES(:title, :contents, :author, NOW(), :post_waiting)');
        $result->execute(array(
            'title' => $title,
            'contents' => $contents,
            'author' => $author,
            'post_waiting' => 0
        ));
    }

    public function inWaiting($title, $contents, $author) {
        $result = $this->getConnection()->prepare('INSERT INTO blog_posts(title, contents, author, creation_date, post_waiting) VALUES(:title, :contents, :author, NOW(), :post_waiting)');
        $result->execute(array(
            'title' => $title,
            'contents' => $contents,
            'author' => $author,
            'post_waiting' => 1
        ));
    }

    //Méthode pour modifier un article(id).
    public function updatePost($id,$title,$contents,$author) {
        $result = $this->getConnection()->prepare('UPDATE blog_posts SET title = :title, contents = :contents, author = :author WHERE id = :id');
        $result->execute(array(
            'id' => $id,
            'title' => $title,
            'contents' => $contents,
            'author' => $author
        ));
        return $result;
    }
    
    //Méthode pour supprimer un article(id).
    public function deletePost($postId) {
        $result = $this->getConnection()->prepare('DELETE FROM blog_posts WHERE id= :id');
        $result->execute(array(
            'id' => $postId
        ));
    }
}