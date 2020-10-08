<?php

require 'model.php';

class Post extends Database {

    public function getThreeLastPosts() {
        $result = $this->getConnection()->query('SELECT id,title,contents,creation_date,author,post_waiting FROM blog_posts WHERE post_waiting = 0 ORDER BY id DESC LIMIT 0, 3');
        $result = $result->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }
    
    public function getPosts() {
        $result = $this->getConnection()->query('SELECT id,title,contents,creation_date,author,post_waiting FROM blog_posts WHERE post_waiting = 0 ORDER BY id DESC');
        return $result;
    }

    public function countPosts($state) {
        $pdo = $this->getConnection();
        $allArticles = $pdo->prepare('SELECT COUNT(*) AS numberOfPosts FROM blog_posts WHERE post_waiting = ?');
        $allArticles->execute([$state]);
        $result = $allArticles->fetch();
        $numbers = intval($result['numberOfPosts']);
        return $numbers;
    }

    public function getPostsByState($firstArticle, $perPage, $state) {
        $pdo = $this->getConnection();
        $posts = $pdo->prepare('SELECT * FROM blog_posts WHERE post_waiting = :states ORDER BY creation_date DESC LIMIT :firstArticle, :perPage');          
        $posts->bindValue(':firstArticle', $firstArticle, PDO::PARAM_INT);
        $posts->bindValue(':perPage', $perPage, PDO::PARAM_INT);
        $posts->bindValue(':states', $state, PDO::PARAM_INT);
        $posts->execute();
        $result = $posts->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }

    public function getPost($postId) {
        $result = $this->getConnection()->prepare('SELECT id,title,contents,creation_date,author FROM blog_posts WHERE id = :id');
        $result->execute(array('id' => $postId));
        return $result;
    }

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

    public function putInLine($id,$title,$contents,$author) {
        $postPutInLine = $this->getConnection()->prepare('UPDATE blog_posts SET title = :title, contents = :contents, author = :author, creation_date = NOW(), post_waiting = :post_waiting WHERE id = :id');
        $postPutInLine->execute(array(
            'id' => $id,
            'title' => $title,
            'contents' => $contents,
            'author' => $author,
            'post_waiting' => 0,
        ));
    }
    
    public function deletePost($postId) {
        $result = $this->getConnection()->prepare('DELETE FROM blog_posts WHERE id= :id');
        $result->execute(array(
            'id' => $postId
        ));
    }
}