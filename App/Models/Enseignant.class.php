<?php

    class Enseignant extends User{
        
        //des informations de plus sur l'enseignant
        protected ?string $matierrePrincipale = null; //sa matrierre principale
        protected ?string $employeId = null; //un autre id pour ameliorer la securite
        protected ?DateTime $dateDemabauche = null; //pour savoir l'anciennete de prof
        protected ?string $diplome = null; //son diplome
        protected ?string $specialite = null; //sa specialite
        protected bool $estProffesseurPrincipale = FALSE; //sera plus util apres (tableau de bord de directeur)
        protected array $matierres = []; //les matierres qui enseigne I
        protected array $classes = []; //les classes qui enseigne II

        //I et II ca aide plus tard a selectioner les tables de la base de donnee

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
            return $this->classes;
        }
    }