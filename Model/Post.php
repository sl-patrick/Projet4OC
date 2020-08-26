<?php

require 'model.php';

class Post extends Database {
    
    //Méthode pour récupérer les articles.
    public function getPosts() {
        $result = $this->getConnection()->query('SELECT id,title,contents,creation_date,author FROM blog_posts ORDER BY id DESC');
        return $result;
    }

    //Méthode pour récupérer un article par son id.
    public function getPost($postId) {
        $result = $this->getConnection()->prepare('SELECT id,title,contents,creation_date,author FROM blog_posts WHERE id = :id');
        $result->execute(array('id' => $postId));
        return $result;
    }

    //Méthode pour ajouter un article.
    public function addPost($title, $contents, $author) {
        $result = $this->getConnection()->prepare('INSERT INTO blog_posts(title, contents, author, creation_date) VALUES(:title, :contents, :author, NOW())');
        $result->execute(array(
            'title' => $title,
            'contents' => $contents,
            'author' => $author
        ));
    }

    //Méthode pour modifier un article(id).
    public function updatePost($postId) {
        $result = $this->getConnection()->prepare('UPDATE blog_posts SET title = :title, contents = :contents, author = :author WHERE id = :id');
        $result->execute(array(
            'id' => $_POST[$postId],
            'title' => $_POST['title'],
            'contents' => $_POST['contents'],
            'author' => $_POST['author']
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