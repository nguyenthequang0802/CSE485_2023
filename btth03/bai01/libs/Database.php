<?php
    require_once "../bai01/config.php";
    class Database{
        private $host = DB_HOST;
        private $user = DB_USER;
        private $pass = DB_PASS;
        private $dbname = DB_NAME;
        private $conn;

        public function __construct(){
            try {
                $this->conn = new PDO("mysql:host={$this->host};dbname={$this->dbname}", $this->user, $this->pass);
            } catch (PDOException $e) {
                $this->conn = null;
                echo $e;
            }
        }
        public  function getConn(){
            return $this->conn;
        }
    }