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

        public function billetForm() : void {
            $eleveId = $_GET['eleve_id'] ?? 0;
    
            $eleve = $this->surv->getEleveById((int)$eleveId);
            $datesAbsences = $this->surv->getDatesAbsenceByEleve((int)$eleveId);
    
            $titre = "Générer un billet d'absence";
            $view = "billetForm";
            require_once __DIR__ . '/../../plain.inc.php';
        }

        public function sauvegarderBillet() : void {
            if($_SERVER["REQUEST_METHOD"] !== "POST") {
                header('Location: /pfa/index.php?url=surveillant/dashboard');
                exit;
            }
            
            $eleveId = (int)($_POST['eleve_id'] ?? 0);
            $dateAbsence = $_POST['date_absence'] ?? '';
            $motif = $_POST['motif'] ?? '';
            $justifie = isset($_POST['justifie']) ? 1 : 0;
            
            // Valider
            if(empty($dateAbsence)) {
                $_SESSION['error'] = "Veuillez sélectionner une date";
                header("Location: /pfa/index.php?url=surveillant/billet&eleve_id=$eleveId");
                exit;
            }
            
            // Sauvegarder
            $billetId = $this->surv->creerBillet($eleveId, $dateAbsence, $motif, $justifie);
            
            $_SESSION['success'] = "Billet d'absence généré avec succès";
            header('Location: /pfa/index.php?url=surveillant/dashboard');
            exit;
        }
    }