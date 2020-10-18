<?php

require_once 'Model.php';


class User extends Database {
    
    public function checkUser($pseudo, $password) { 

        $query = $this->getConnection()->prepare('SELECT username, userpassword FROM users WHERE username = :username');
        $query->execute(array(
            'username' => $pseudo       
        ));
        $result = $query->fetch();

        if ($result === false) {
            return false;
        } elseif (!password_verify($password, $result['userpassword'])) {

            return false;
        } else {
            //ouvrir session
            $_SESSION['pseudo'] = $result['username'];
        }
        $query->closeCursor();

    }

}