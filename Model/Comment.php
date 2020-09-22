<?php

require_once 'model.php';

class Comment extends Database {
    
    public function getCommentsFromPost($postId) {
        $result = $this->getConnection()->prepare('SELECT id,pseudo,contents,creation_date FROM comments WHERE id_post=?  ORDER BY creation_date DESC');
        $result->execute([$postId]);
        return $result;
    } 
    
    public function addCommentFromPost($postId, $contents, $author) {
        $pdo = $this->getConnection();
        $result = $pdo->prepare('INSERT INTO comments(pseudo, contents, id_post, creation_date, report_comment) VALUES(:pseudo, :contents, :id_post, NOW(), :report_comment)');
        $result = $result->execute(array(
            'pseudo' => $author,
            'contents' => $contents,
            'id_post' => $postId,
            'report_comment' => 0
        ));
        $commentId = $pdo->lastInsertId();
        $comment = $pdo->prepare('SELECT id,pseudo,contents,creation_date FROM comments WHERE id= ?');
        $comment->execute([$commentId]);
        return $comment->fetch(PDO::FETCH_ASSOC);   
    }

    Public function getLastComments() {
        $result = $this->getConnection()->query('SELECT id,pseudo,contents,creation_date FROM comments ORDER BY creation_date DESC LIMIT 0,5');
        return $result;
    }

    public function reportComment($commentId) {
        $pdo = $this->getConnection();
        $verify = $pdo->prepare('SELECT report_comment FROM comments WHERE id= ?');
        $verify->execute([$commentId]);
        $verify = $verify->fetch(PDO::FETCH_ASSOC);
        
        if (intval($verify['report_comment']) === 0) {
            $result = $pdo->prepare('UPDATE comments SET report_comment = 1 WHERE id= ?');
            $result->execute([$commentId]);
            return intval($verify['report_comment']);
        } else {
            $result = $pdo->prepare('UPDATE comments SET report_comment = 0 WHERE id= ?');
            $result->execute([$commentId]);
            return intval($verify['report_comment']);
        }
    }

    public function getLastReportComments() {
        $result = $this->getConnection()->query('SELECT pseudo,contents,creation_date FROM comments WHERE report_comment = 1');
        return $result;
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

}