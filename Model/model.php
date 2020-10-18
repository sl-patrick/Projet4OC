<?php

class Database {

    const HOST = 'mysql:host=localhost;dbname=db_jeanf;charset=UTF8';
    const LOGIN = 'root';
    const PASSWORD = '';

    private $_connectionDb;

    //Méthode qui vérifie si une connexion est présente.
    private function checkConnection() {
        if ($this->_connectionDb === null) {
            return $this->getConnection();
        }
        return $this->_connectionDb;
    }
    
    //Méthode connexion à la base de données avec PDO.
    public function getConnection() {
            $this->_connectionDb = new PDO(self::HOST,self::LOGIN,self::PASSWORD);
            $this->_connectionDb->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            return $this->_connectionDb;
    }
}