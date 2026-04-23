<?php
    namespace App\Models;
    use DateTime;

    class Administrateur extends User {

        //information supplementaire sur l'administrateur
        protected ?string $employeId = null; //un autre id pour ameliorer la securite
        protected ?DateTime $dateDemabauche = null; //pour savoir l'anciennete de administrateur

        public function getEmployeId() : ?string {
            return $this->employeId;
        }

        public function getDateDembauche() : ?DateTime {
            return $this->dateDemabauche;
        }

        //remplissage des donnees
        public static function findByUserId(int $userId) : ?Administrateur {
            $admin = new self();
            $sql = "SELECT * FROM admins WHERE user_id = ?";
            $data = $admin->fetchOne($sql, [$userId]);

            if($data && !empty($data)){
                foreach($data as $key => $value){
                    if(property_exists($admin, $key)){
                        if(($key === 'dateDemabauche') && !empty($value)){
                            $admin->$key = new DateTime($value);
                        }elseif($key !== 'dateDemabauche') {
                            $admin->$key = $value;
                        }
                    }
                }
            }

            $sqlUser = "SELECT id, nom, prenom, email, numeroDeTelephon, role, passwordHash, failedAttempts FROM users WHERE id = ?";
            $userData = $admin->fetchOne($sqlUser, [$userId]);
            
            if($userData && !empty($userData)){
                foreach($userData as $key => $value){
                    if(property_exists($admin, $key)){
                        $admin->$key = $value;
                    }
                }
            }
            return $admin;
        }

        //des infos pour le tableau de bord
        public function nombreTotaleEleve() : int {
            $result = $this->fetchIt("SELECT COUNT(id) as totale FROM eleves");
            return $result ? (int)$result['totale'] : 0;
        }

        public function nombreTotaleClasse() : int {
            $result = $this->fetchIt("SELECT COUNT(id) as totale FROM classes");
            return $result ? (int)$result['totale'] : 0;
        }

        public function nombreTotaleEns() : int {
            $result = $this->fetchIt("SELECT COUNT(id) as totale FROM enseignants");
            return $result ? (int)$result['totale'] : 0;
        }

        public function top5() : array {
            $result = $this->fetchThem("SELECT e.nom, e.prenom, n.note
                                      FROM eleves e
                                      JOIN notes n 
                                      ON e.id = n.eleveId
                                      ORDER BY n.note DESC
                                      LIMIT 5;");
            return $result;
        }
    }