<?php

    namespace App\Models;
    use DateTime;

    class Surveillant extends User {
        protected ?string $employeId = null;
        protected ?DateTime $dateEmbauche = null;

        public function getEmployeId() : ?string {
            return $this->employeId;
        }

        public function getDateEmbauche() : ?DateTime {
            return $this->dateEmbauche;
        }

        public static function findByUserId(int $userId) : ?Surveillant {
            $surv = new self();
            $sql = "SELECT * FROM surveillants WHERE user_id = ?";
            $data = $surv->fetchOne($sql, [$userId]);

            if($data && !empty($data)){
                foreach($data as $key => $value){
                    if(property_exists($surv, $key)){
                        if(($key === 'dateDemabauche') && !empty($value)){
                            $surv->$key = new DateTime($value);
                        }elseif($key !== 'dateDemabauche') {
                            $surv->$key = $value;
                        }
                    }
                }
            }

            $sqlUser = "SELECT id, nom, prenom, email, numeroDeTelephon, role, passwordHash, failedAttempts FROM users WHERE id = ?";
            $userData = $surv->fetchOne($sqlUser, [$userId]);
            
            if($userData && !empty($userData)){
                foreach($userData as $key => $value){
                    if(property_exists($surv, $key)){
                        $surv->$key = $value;
                    }
                }
            }
            return $surv;
        }

        public function getTauxAbsense() : float {
            $nbEleve = $this->fetchIt("SELECT COUNT(id) AS totale FROM eleves");
            $resut = $this->fetchIt("SELECT COUNT(*) AS abs FROM appels WHERE statut = 0");
            $nbAbsent = ($resut['abs'] > 0) ? $resut['abs'] : 1;
            $tauxAbsense = round($nbEleve['totale'] / $nbAbsent, 2);
            return $tauxAbsense;
        }

        public function getNbEleve() : int {
            $nbEleve = $this->fetchIt("SELECT COUNT(id) AS totale FROM eleves");
            return $nbEleve['totale'];
        }

        public function getAbsent(){
            $absents = $this->fetchThem("SELECT nom, prenom, e.id
                            FROM eleves e 
                            JOIN appels a 
                            ON e.id = a.eleveId
                            WHERE a.statut = 0");
            return $absents;
        }

       

        public function getEleveById(int $eleveId): ?array {
            $sql = "SELECT e.id, e.nom, e.prenom, c.nomClasse
                    FROM eleves e
                    LEFT JOIN classes c ON e.idClasse = c.id
                    WHERE e.id = ?";
            $result = $this->fetchOne($sql, [$eleveId]);
            return is_array($result) ? $result : null;
        }       

        public function creerBillet(int $eleveId, string $dateAbsence, string $motif, int $justifie): int {
            $sql = "INSERT INTO billets (eleveId, dateAbsence, motif, justifie) VALUES (?, ?, ?, ?)";
            $this->execute($sql, [$eleveId, $dateAbsence, $motif, $justifie]);
            return $this->db->lastInsertId();
        }

        public function getDatesAbsenceByEleve(int $eleveId): array {
            $sql = "SELECT DISTINCT dateAppel 
                    FROM appels 
                    WHERE eleveId = ? AND statut = 0
                    ORDER BY dateAppel DESC";
            return $this->fetchAll($sql, [$eleveId]) ?: [];
        }

    }