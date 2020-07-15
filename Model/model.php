<?php

class Database {

    const host = 'mysql:host=localhost;dbname=db_jeanf;charset=utf8';
    const login = 'root';
    const password = '';

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
        try {
            $this->_connectionDb = new PDO(self::host,self::login,self::password);
            $this->_connectionDb->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            return $this->_connectionDb;
        } catch (Exception $errorConnectionDb) {
            echo $errorConnectionDb->getMessage();
        }
    }
}