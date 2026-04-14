<?php

    class AdministrateurController {
        private ?Administrateur $admin;

        public function __construct(){
            
            //initialisation d'objet avec la creation d'une session
            if(session_status() === "PHP_SESSION_NONE"){
                session_start();
            }

            //verifiant que l'administrateur n'est pas connecte(dans ce cas on le rederige au log in)
            if(!isset($_SESSION["user_id"])){
                header('Location: /login');
                exit();
            }

            //s'il est connecte et il existe dans ma base je recupere toutes ses donnees
            $this->admin = Administrateur::find($_SESSION["user_id"]);

            //une couche suplementaire de securite : on verifie s'il est vraiment un administrateur
            if(!$this->admin || $this->admin->getRole() !== 'administrateur'){
                header('Location: /login');
                exit();
            }
        }
    }