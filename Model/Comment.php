<?php

require_once 'model.php';

class Comment extends Database {
    
    Public function getLastComments() {
        $result = $this->getConnection()->query('SELECT id,pseudo,contents,creation_date FROM comments ORDER BY creation_date DESC LIMIT 0,5');
        return $result;
    }

    public function getCommentsFromPost($postId) {
        $result = $this->getConnection()->prepare('SELECT id,pseudo,contents,creation_date FROM comments WHERE id_post=?  ORDER BY creation_date DESC');
        $result->execute([$postId]);
        return $result;
    } 

    public function addCommentFromPost($postId, $contents, $author) {
        $pdo = $this->getConnection();
        $result = $pdo->prepare('INSERT INTO comments(pseudo, contents, id_post, creation_date) VALUES(:pseudo, :contents, :id_post, NOW())');
        $result = $result->execute(array(
            'pseudo' => $author,
            'contents' => $contents,
            'id_post' => $postId
        ));
        $commentId = $pdo->lastInsertId();
        $comment = $pdo->prepare('SELECT id,pseudo,contents,creation_date FROM comments WHERE id= ?');
        $comment->execute([$commentId]);
        return $comment->fetch(PDO::FETCH_ASSOC);
           
    }

    public function deleteComment($commentId) {
        $result = $this->getConnection()->prepare('DELETE FROM comments WHERE id= :id');
        $result->execute(array(
            'id' => $commentId
        ));
    }

    public function deleteCommentsFromPost($postId) {
        $result = $this->getConnection()->prepare('DELETE FROM comments WHERE id_post= :id_post');
        $result->execute(array(
            'id_post' => $postId
        )); 
    }

    public function reportComment($commentID) {}
}