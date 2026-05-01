<?php

    namespace App\Core;

    use PDO;
    use PDOException;
    class DataBase {
        private static ?PDO $instance = null;
        private $host;
        private $user;
        private $pwd;
        private $dbName;

        //un constructeur prive pour empecher l'utilisation directe (more security measures)
        private function __construct(){
            //importation de fichier config
            $config = require __DIR__ . '/../../Config/database.php';
            $this->host = $config["host"];
            $this->user = $config["username"];
            $this->pwd = $config["password"];
            $this->dbName = $config["dbname"];
        }

        public static function getConnection() : PDO {
            //fonction statique qui etablir la connexion s'il y en a pas
            if(self::$instance === null){
                $db = new self();
                self::$instance = $db->connect();
            }
            return self::$instance;
        }

        protected function connect(){
            //etablir la connexion dans un bloc try catch pour savoir c'est quoi l'erreur ou l'exception 
            try{
                $dsn = 'mysql:host=' . $this->host . ';dbname=' . $this->dbName;
                $pdo = new PDO($dsn, $this->user, $this->pwd);
                $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
                return $pdo;
            }catch(PDOException $e){
                die("Erreur de connexion à la base de données : " . $e->getMessage());
            }
        }
    }