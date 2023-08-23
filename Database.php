<?php

require_once "config.php";

class Database{
    private $host = HOST;
    private $db = DB;
    private $user = USER;
    private $pass = PASS;

    public function connect(){
        try {
            $dsn = "mysql:host=".$this->host.";dbname=".$this->db;
            // make a database connection
            $pdo = new PDO($dsn, $this->user, $this->pass, [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]);
            
        } catch (PDOException $e) {
            die($e->getMessage());
        } finally {
            if (!$pdo) {
                $pdo = null;
            }
        }
        return $pdo;
    }
}