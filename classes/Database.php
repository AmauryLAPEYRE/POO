<?php

class Database {

    private $servername;
    private $username;
    private $password;
    private $dbname;
    private $charset;

    public function connect()
    {
        $this->servername = "localhost";
        $this->username = "root";
        $this->password = "0000";
        $this->dbname = "rpg";
        $this->charset ="utf8mb4";

        try {
            $db ="mysql:host=".$this->servername.";dbname=".$this->dbname.";charset=".$this->charset;
            $pdo = new PDO($db, $this->username, $this->password);
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            return $pdo;
        } catch (PDOException $e) {
            echo "Erreur de connexion". $e->getMessage();
        }
    }
}