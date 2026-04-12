<?php

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

        public function getAnciennete() : ?DateTime {
            if(!$this->dateDemabauche){
                return "erreur: case vide\n";
            }else{
                $t0 = new DateTime; //instant t0 (maintennant)
                $dif = $t0->diff($this->dateDemabauche);
                return $dif->y; //on retourne juste les annees
            }
        }
    }