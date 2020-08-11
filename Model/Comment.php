<?php

require_once 'model.php';

class Comment extends Database {
    
    public function getCommentsFromPost($postId) {
        $result = $this->getConnection()->prepare('SELECT id,pseudo,contents,creation_date FROM comments WHERE id_post=?  ORDER BY creation_date DESC');
        $result->execute([$postId]);
        return $result;
    } 

    public function addCommentFromPost($postId, $contents, $author) {
        $result = $this->getConnection()->prepare('INSERT INTO comments(pseudo, contents, id_post, creation_date) VALUES(:pseudo, :contents, :id_post, NOW())');
        $result->execute(array(
            'pseudo' => $author,
            'contents' => $contents,
            'id_post' => $postId
        ));
        return $result;    
    }

    public function deleteComment($commentId) {
        $result = $this->getConnection()->prepare('DELETE FROM comments WHERE id= :id');
        $result->execute(array(
            'id' => $commentId
        ));
    }

    public function reportComment($commentID) {}
}