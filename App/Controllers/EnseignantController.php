<?php

    namespace App\Controllers;
    use App\Models\Enseignant;

    class EnseignantController{
        private ?Enseignant $enseignant;

        //constructeur: initialisation d'objet avec la creation d'une session
        //public function __construct(){}

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

        //rouer proprement chaque enseignant
        public function routerEns() : bool {
            if(isset($_SESSION["user"]) && !empty($_SESSION["user"])){
                if($_SESSION["user"]['role'] === "ENS"){
                    return TRUE;
                }else{
                    http_response_code(403);
                    echo "<h1>ERROR-403 Accès interdit</h1> <br>";
                    echo "<p>Vous n'avez pas les droits pour accéder à cette page</p> <br>";
                    echo "<a href='/pfa'>Revenir a la page d'acceuille</a>";
                    
                    return FALSE;
                }
            }else{
                header('Location: /pfa/index.php?url=login');
                exit;
            }
        }



    }