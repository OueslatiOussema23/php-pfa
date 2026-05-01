<?php

    namespace App\Controllers;
    use App\Models\Administrateur;

    class AdministrateurController {
        private ?Administrateur $admin;

        public function __construct(){
            if(isset($_SESSION["user"]['id'])){
                $this->admin = Administrateur::findByUserId($_SESSION["user"]['id']);
            }  
        }

        public function dashboard(){
            $nbEleves = $this->admin->nombreTotaleEleve();
            
            $nbClasses = $this->admin->nombreTotaleClasse();
            
            $nbEns = $this->admin->nombreTotaleEns();
            $results = $this->admin->top5();
            $titre = "Dashboard Admin";
            $view = "dashboard";
            require_once __DIR__ . '/../../plain.inc.php';
        }

            
    }