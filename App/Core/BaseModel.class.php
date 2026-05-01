<?php
    
    namespace App\Core;
    use PDO;
    use App\Enums\Theme;
    use App\Enums\Status;
    use App\Enums\Langue;
    use DateTime;
    
    abstract class BaseModel {
        protected PDO $db;

        //constructeur pour initilaser la connexion
        public function __construct(){
            $this->db = DataBase::getConnection();
        }

        protected function query(string $sql, array $params = []){
            $stmt = $this->db->prepare($sql);
            $stmt->execute($params);
            return $stmt;
        }
        
        protected function get(string $sql){
            $stmt = $this->db->prepare($sql);
            $stmt->execute();
            return $stmt;
        }

        protected function fetchIt(string $sql){
            $stmt = $this->get($sql);
            return $stmt->fetch();
        }

        protected function fetchThem(string $sql){
            $stmt = $this->get($sql);
            return $stmt->fetchAll();
        }

        protected function fetchOne(string $sql, array $params = []){
            $stmt = $this->query($sql, $params);
            return $stmt->fetch();
        }

        protected function fetchAll(string $sql, array $params = []){
            $stmt = $this->query($sql, $params);
            return $stmt->fetchAll();
        }

        protected function execute(string $sql, array $params = []){
            $stmt = $this->query($sql, $params);
            return $stmt->rowCount();
        }

        //methode hydrate : automatisation de remplissage des donnees de l'utilisateur
        protected function hydrate(array $data) : void {
            foreach($data as $cle => $valeur){
               if(property_exists($this, $cle)){
                // Vérifier si la propriété attend un DateTime
                $reflection = new \ReflectionProperty($this, $cle);
                $type = $reflection->getType();
                
                // Si c'est un DateTime et que la valeur est une chaîne
                if($type && $type->getName() === 'DateTime') {
                    if(is_string($valeur) && !empty($valeur)){
                        $this->$cle = new DateTime($valeur);
                    } elseif($valeur instanceof DateTime) {
                        $this->$cle = $valeur;
                    }
                }else{
                    $this->$cle = $valeur;
                }
            }
        }
    }
}