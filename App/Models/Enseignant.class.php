<?php
    namespace App\Models;
    use DateTime;
    class Enseignant extends User{
        
        //des informations de plus sur l'enseignant
        protected ?string $matierrePrincipale = null; //sa matrierre principale
        protected ?string $employeId = null; //un autre id pour ameliorer la securite
        protected ?DateTime $dateDemabauche = null; //pour savoir l'anciennete de prof
        protected ?string $diplome = null; //son diplome
        protected ?string $specialite = null; //sa specialite
        protected bool $estProfesseurPrincipale = FALSE; //sera plus util apres (tableau de bord de directeur)
        protected array $matierres = []; //les matierres qui enseigne I
        protected array $classes = []; //les classes qui enseigne II

        //I et II ca aide plus tard a selectioner les tables de la base de donnee
        
        public static function findByUserId(int $userId): ?Enseignant {
    $enseignant = new self();
    $sql = "SELECT * FROM enseignants WHERE user_id = ?";
    $data = $enseignant->fetchOne($sql, [$userId]);
    
    if($data && !empty($data)){
        // Hydrater les données de l'enseignant
        foreach($data as $key => $value){
            if(property_exists($enseignant, $key)){
                if(($key === 'dateDemabauche') && !empty($value)){
                    $enseignant->$key = new DateTime($value);
                } elseif($key !== 'dateDemabauche') {
                    $enseignant->$key = $value;
                }
            }
        }
        
        // Récupérer aussi les infos User (sans les dates problématiques)
        $sqlUser = "SELECT id, nom, prenom, email, numeroDeTelephon, role, passwordHash, failedAttempts FROM users WHERE id = ?";
        $userData = $enseignant->fetchOne($sqlUser, [$userId]);
        if($userData && !empty($userData)){
            foreach($userData as $key => $value){
                if(property_exists($enseignant, $key)){
                    $enseignant->$key = $value;
                }
            }
        }
        
        // Initialiser les dates à maintenant si elles sont null
        $enseignant->dateDeCreation = $enseignant->dateDeCreation ?? new DateTime();
        $enseignant->dernierLogin = $enseignant->dernierLogin ?? new DateTime();
        $enseignant->dateDeMiseAjour = $enseignant->dateDeMiseAjour ?? new DateTime();
        
        return $enseignant;
    }
    return null;
}

        //---GETERS---
        public function getMatierrePrincipale() : ?string {
            return $this->matierrePrincipale;
        }

        public function getEmployeId() : ?string {
            return $this->employeId;
        }

        public function getDateDemabauche() : ?DateTime {
            if($this->dateDemabauche === null){
                return 'case vide';
            }else{
                return $this->dateDemabauche->format('d/m/y');
            }
        }

        public function getAnciennete() : ?DateTime {
            if(!$this->dateDemabauche){
                return "erreur: case vide\n";
            }else{
                $t0 = new DateTime; //instant t0 (maintennant)
                $dif = $t0->diff($this->dateDemabauche);
                return $dif->y; //on retourne juste les annees
            }
        }

        public function getSpecialite() : ?string {
            return $this->specialite;
        }

        public function getEpp() : bool {
            return $this->estProffesseurPrincipale;
        }

        public function getMatierres() : array {
            return $this->matierres;
        }

        public function getClasses() : array {
            
            $sql = "SELECT nomClasse, c.id 
                    FROM classes c 
                    JOIN enseignants e 
                    ON c.idEns = e.id 
                    JOIN users u 
                    ON e.user_id = u.id 
                    WHERE u.id = ?";
            $userId = $_SESSION["user"]["id"];
            $resultat =  $this->fetchAll($sql, [$userId]);
            return $resultat ?: [];
        }

        

        public function getEnsId() : ?int {
            $sql = "SELECT e.id 
                    FROM enseignants e 
                    JOIN users u 
                    ON e.user_id = u.id
                    WHERE u.id = ?";
            $userId = $_SESSION["user"]['id'];
            $resultat =  $this->fetchOne($sql, [$userId]);
            return $resultat ? (int) $resultat['id'] : null;
        }

        public function getMatieres() : array {
            $ensId = $this->getEnsId();
            if(!$ensId){
                $ensId = [];
            }
            $sql = "SELECT nom
                    FROM matierres m
                    JOIN enseigner e 
                    ON m.id = e.idMatierre
                    WHERE e.idEns = ?";
            return $this->fetchAll($sql, [$ensId]) ?: [];
        }

        public function getElevesByClasse($id) : array {
            $classeId = $id;
            if(!$classeId){
                $classeId = [];
            }

            $sql = "SELECT nom, prenom, id
                    FROM eleves 
                    WHERE idClasse = ?
                    ORDER BY nom, prenom";
            return $this->fetchAll($sql, [$classeId]) ?: [];
        }

        

    }
