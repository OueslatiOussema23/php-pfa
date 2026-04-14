<?php
    
    //changement de theme selon les preferences
    enum Theme : string {
        case CLAIRE = 'claire';
        case SOMBRE = 'sombre';

        //fonction qui retourne quel theme l'utilisateur a choisi
        public function getTheme() : Theme{
            return $this->theme;
        }
    }