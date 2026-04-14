<?php

    class Surveillant extends User {
        protected ?string $employeId = null;
        protected ?DateTime $dateEmbauche = null;

        public function getEmployeId() : ?string {
            return $this->employeId;
        }

        public function getDateEmbauche() : ?DateTime {
            return $this->dateEmbauche;
        }

        public function getAnciennete() : ?DateTime {
            if(!$this->dateEmbauche){
                return "erreur: case vide\n";
            }else{
                $t0 = new DateTime; //instant t0 (maintennant)
                $dif = $t0->diff($this->dateEmbauche);
                return $dif->y; //on retourne juste les annees
            }
        }
    }