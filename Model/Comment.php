<?php

require_once 'model.php';

class Comment extends Database {
    
    
    //Méthode pour récupérer les commentaires d'un article.
    public function getCommentsFromPost($postId) {
        //connexion a la base de données.
        $db = new Database();
        $connection = $db->getConnection();
        //requête pour recupérer les commentaires.
        $result = $connection->prepare('SELECT id,pseudo,contents,creation_date FROM comments WHERE id_post=?  ORDER BY creation_date DESC');
        $result->execute([$postId]);
        return $result;

    } 

    //Méthode pour ajouter un commentaire.
    public function addCommentFromPost($postId, $contents, $author) {
        $db = new Database();
        $connection = $db->getConnection();
        $result = $connection->prepare('INSERT INTO comments(pseudo, contents, id_post, creation_date) VALUES(:pseudo, :contents, :id_post, NOW())');
        $result->execute(array(
            'pseudo' => $author,
            'contents' => $contents,
            'id_post' => $postId
        ));    
    }

    public function deleteComment($commentId) {
        $result = $this->_connection->prepare('DELETE FROM comments WHERE id= :id');
        $result->execute(array(
            'id' => $commentId
        ));
    }
    //signaler commentaire.
    public function reportComment($commentID) {}
}