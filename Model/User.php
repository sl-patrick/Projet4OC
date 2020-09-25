<?php

require_once 'model.php';


class User extends Database {
    /* 
    Vérifier si les variables pseudo et password correspondent à une entrée dans la table.
    Si ça ne correspond pas retourner false.
    Si ça correspond ouvrir une session.
    */
    public function checkUser($pseudo, $password) { 

        $query = $this->getConnection()->prepare('SELECT username, userpassword FROM users WHERE username = :username');
        $query->execute(array(
            'username' => $pseudo       
        ));
        $result = $query->fetch();

        if (!$result['username']) {
            echo 'Le pseudo est invalide';
            return false;
        } elseif (!password_verify($password, $result['userpassword'])) {
            echo 'mot de passe invalide';
            return false;
        } else {
            //ouvrir session
            $_SESSION['pseudo'] = $result['username'];
        }
        $query->closeCursor();

    }

}