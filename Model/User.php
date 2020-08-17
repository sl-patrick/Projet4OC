<?php

require_once 'model.php';


class User extends Database {
    /* 
    Vérifier si les variables pseudo et password correspondent à une entrée dans la table.
    Si ça ne correspond pas retourner false.
    Si ça correspond ouvrir une session.
    */
    public function getUser($pseudo, $password) { //changer nom méthode

        $query = $this->getConnection()->prepare('SELECT username, userpassword FROM users WHERE username = :username');
        $query->execute(array(
            'username' => $pseudo       
        ));
        $result = $query->fetch();

        // $passwordVerify = password_verify($result['password'], $password);

        if (!$result['username']) {
            echo 'Le pseudo est invalide';
        } elseif ($result['userpassword'] !== $password) {
            echo 'mot de passe invalide';
        } else {
            //ouvrir une session.        
        } 
    }

    public function addUser($pseudo,$password) {
        //verifier si le pseudo existe déjà.
        $result = $this->getConnection()->prepare('INSERT INTO users(username, userpassword) VALUES(:username, :userpassword)');
        $result->execute(array(
            'username' => $pseudo,
            'userpassword' => $password
        ));
        return $result; 
    }
}