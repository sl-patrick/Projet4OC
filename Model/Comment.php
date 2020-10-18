<?php

require_once 'Model.php';

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

    public function reportComment($commentId) {
        $pdo = $this->getConnection();
        $verify = $pdo->prepare('SELECT report_comment FROM comments WHERE id= ?');
        $verify->execute([$commentId]);
        $verify = $verify->fetch(PDO::FETCH_ASSOC);
        
        if (intval($verify['report_comment']) === 0) {
            $result = $pdo->prepare('UPDATE comments SET report_comment = 1 WHERE id= ?');
            $result->execute([$commentId]);
            return "commentaire signalé";
        } else {
            $result = $pdo->prepare('UPDATE comments SET report_comment = 0 WHERE id= ?');
            $result->execute([$commentId]);
            return "commentaire non signalé";
        }
    }
    
    public function countAllComments($state) {
        $pdo = $this->getConnection();
        $allComments = $pdo->prepare('SELECT COUNT(*) AS numberOfComments FROM comments WHERE report_comment = ?');
        $allComments->execute([$state]);
        $result = $allComments->fetch();
        $numberOfComments = intval($result['numberOfComments']);
        return $numberOfComments;
    }

    public function getCommentsByState($firstComment, $perPage, $state) {
        $pdo = $this->getConnection();
        $comments = $pdo->prepare('SELECT * FROM comments WHERE report_comment = :states ORDER BY creation_date DESC LIMIT :firstComment, :perPage');
        $comments->bindValue(':firstComment', $firstComment, PDO::PARAM_INT);
        $comments->bindValue(':perPage', $perPage, PDO::PARAM_INT);
        $comments->bindValue(':states', $state, PDO::PARAM_INT);
        $comments->execute();
        $result = $comments->fetchAll(PDO::FETCH_ASSOC);
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