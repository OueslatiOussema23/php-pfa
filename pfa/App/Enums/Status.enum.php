<?php

    //etat de compte
    enum Status : string {
        case ACTIF = 'En-ligne';
        case INACTIF = 'Hors-ligne';
        case SUSPENDU = 'Suspendu';

        //si le compte est actif y aura pas raison de refaire le log-in
        public function canLogin() : bool{
        return $this === self::ACTIF;
        }

        public function getStatus() : Status{
            return $this->status;
        }
    }