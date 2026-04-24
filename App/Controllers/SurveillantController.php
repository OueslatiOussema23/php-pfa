<?php

    namespace App\Controllers;
    use App\Models\Surveillant;
    class SurveillantController {
        private ?Surveillant $surv;
        public function __construct(){
            if(isset($_SESSION["user"]['id'])){
                $this->surv = Surveillant::findByUserId($_SESSION["user"]['id']);
            }  
        }

        public function dashboard(){
            $tauxAbsense = $this->surv->getTauxAbsense();
            $tauxPresence = 100 - $tauxAbsense . "%";
            $nbEleves = $this->surv->getNbEleve();
            $absents = $this->surv->getAbsent();

            $titre = "Dashboard surveillant";
            $view = "dashboard";
            require_once __DIR__ . '/../../plain.inc.php';
        }
    }