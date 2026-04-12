<?php

    class EnseignantController{
        private ?Enseignant $enseignant;

        //constructeur: initialisation d'objet avec la creation d'une session
        public function __construct(){
            
            //initialisation d'objet avec la creation d'une session
            if(session_status() === "PHP_SESSION_NONE"){
                session_start();
            }

            //verifiant que enseignant n'est pas connecte(dans ce cas on le rederige au log in)
            if(!isset($_SESSION["user_id"])){
                header('location: /login');
                exit();
            }

            //s'il est connecte et il existe dans ma base je recupere toutes ses donnees
            $this->enseignant = Enseignant::find($_SESSION["user_id"]);

            //une couche suplementaire de securite : on verifie s'il est vraiment un enseignant
            if(!$this->enseignant || $this->enseignant->getRole() !== 'enseignant'){
                header('location: /login');
                exit();
            }
        }

        //les methodes : Dashboard, faire l'appel, saisir les notes, et un to do list
        
        public function dashboard() : void {
            //fournir les donnees necessaires pour creer le dashboard
            $data = [
                'enseignant' => $this->enseignant,
                'classes' => $this->enseignant->getClasses(),
                'matieres' => $this->enseignant->getMatieres(),
                'prochainsCours' => $this->enseignant->getProchainsCours(),
                'nombreEtudiants' => $this->enseignant->getNombreTotalEtudiants(),
                'appelsAujourdhui' => $this->enseignant->getAppelsAujourdhui(),
                'devoirsARendre' => $this->enseignant->getDevoirsARendre()
            ];
            
            //l'appel au repertoire des vues "les interfaces"
            require_once __DIR__  . '/Views/Enseignant/Dashboard.php';
        }



    }