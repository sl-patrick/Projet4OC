<?php

require('model.php');

class Comment extends Database {
    
    
    //Méthode pour récupérer les commentaires d'un article.
    public function getCommentsFromPost($postId) {
        //connexion a la base de données.
        $db = new Database();
        $connection = $db->getConnection();
        //requête pour recupérer les commentaires.


    } 

    //Méthode pour ajouter un commentaire.
    public function addComment() {
        $db = new Database();
        $connection = $db->getConnection();
        
    }

    //signaler commentaire.
    public function reportComment($commentID) {}
}