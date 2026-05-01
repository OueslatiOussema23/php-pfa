<?php
    namespace App\Controllers;
    use App\Models\Enseignant;

    class EnseignantController{
        private ?Enseignant $enseignant;

        //constructeur: initialisation d'objet avec la creation d'une session
        public function __construct(){
            if(isset($_SESSION["user"]["id"])) {
            $this->enseignant = Enseignant::findByUserId($_SESSION["user"]["id"]);
            }
        }

            public function selectForm() : void {
            if(!$this->enseignant) {
                header('Location: /pfa/index.php?url=login');
                exit;
            }
        
            // Récupérer les classes et matières de l'enseignant
            $classes = $this->enseignant->getClasses();
            $matieres = $this->enseignant->getMatieres();
            
            // Récupérer l'action (notes ou appel) depuis l'URL
            $action = $_GET['action'] ?? '';
            
            $titre = "Sélectionner une classe et une matière";
            $view = "selectionForm";
            require_once __DIR__ . '/../../plain.inc.php';
        }

        public function processSelection() : void {
            ob_clean();
        if($_SERVER["REQUEST_METHOD"] !== "POST") {
            header('Location: /pfa/index.php?url=enseignant/dashboard');
            exit;
        }
        
        $classe = trim($_POST['classe']) ?? '';
        $matiere = trim($_POST['matiere']) ?? '';
        $action = trim($_POST['action']) ?? '';
        
        if(empty($classe) || empty($matiere) || empty($action)) {
            $_SESSION['error'] = "Veuillez sélectionner une classe et une matière";
            header("Location: /pfa/index.php?url=enseignant/selectForm&action=" . $action);
            exit;
        }
        
        // Rediriger vers la page spécifique
        switch($action) {
            case 'notes':
                $redirectUrl = "/pfa/index.php?url=enseignant/ajouterNotes&classe=". urlencode($classe) ."&matiere=" . urlencode($matiere);
                header("Location: " . trim($redirectUrl));
                
                break;
            case 'appel':
                $redirectUrl = "/pfa/index.php?url=enseignant/ficheAppel&classe=". urlencode($classe) ."&matiere=" . urlencode($matiere);
                header("Location: " . trim($redirectUrl));
                
                break;
            default:
                header('Location: /pfa/index.php?url=enseignant/dashboard');
        }
        exit;
    }
    
    // Page Ajouter Notes
    public function ajouterNotes() : void {
        $classe = $_GET['classe'] ?? '';
        $matiere = $_GET['matiere'] ?? '';
        
        if(empty($classe) || empty($matiere)) {
            header("Location: /pfa/index.php?url=enseignant/selectForm&action=notes");
            exit;
        }
        
        // Récupérer les élèves de la classe
        $eleves = $this->enseignant->getElevesByClasse($classe);
        
        $titre = "Ajouter des notes - ";
        $view = "ajouterNotes";
        require_once __DIR__ . '/../../plain.inc.php';
    }
    
    // Page Feuille d'appel
    public function ficheAppel() : void {
        $classe = $_GET['classe'] ?? '';
        $matiere = $_GET['matiere'] ?? '';
        
        if(empty($classe) || empty($matiere)) {
            header("Location: /pfa/index.php?url=enseignant/selectForm&action=appel");
            exit;
        }
        
        // Récupérer les élèves de la classe
        $eleves = $this->enseignant->getElevesByClasse($classe);
        
        $titre = "Feuille d'appel";
        $view = "ficheAppel";
        
        require_once __DIR__ . '/../../plain.inc.php';
    }

    public function sauvegarderAppel() : void {
            if($_SERVER["REQUEST_METHOD"] !== "POST"){
                header("Location: /pfa/index.php?url=enseignant/dashboard");
                exit;
            }

            $presences = $_POST['presence'];
            $classeId = $_POST['classe_id'];
            $matiereId = $_POST['matiere_id'];

            foreach($presences as $eleveId => $statut){
                $present = ($statut === "TRUE") ? 1 : 0; 
                $this->enseignant->enregistrerAppel($eleveId, $classeId, $matiereId, $present);
            }

            $_SESSION['success'] = TRUE;
            header("Location: /pfa/index.php?url=enseignant/dashboard");
            exit;
    }

    public function sauvegarderNotes() : void {
        if($_SERVER["REQUEST_METHOD"] !== "POST"){
            header("Location: /pfa/index.php?url=enseignant/dashboard");
                exit;
        }
        
        $notes = $_POST['notes'];
        $classeId = $_POST['classe_id'];
        $matiereId = $_POST['matiere_id'];

        foreach($notes as $eleveId => $note){
            $note = str_replace(',', '.', $note);
            if($note < 0 || $note > 20){
                $_SESSION['error'] = "La note pour l'élève ID $eleveId doit être comprise entre 0 et 20.";
                header("Location: /pfa/index.php?url=enseignant/ajouterNotes&classe=$classeId&matiere=$matiereId");
                exit;
            }
            $this->enseignant->enregistrerNote($eleveId, $classeId, $matiereId, $note);
        }
        $_SESSION['success'] = "Notes enregistrées avec succès.";
        header("Location: /pfa/index.php?url=enseignant/selectForm&action=notes");
        exit;
    }

        

        //les methodes : Dashboard, faire l'appel, saisir les notes, et un to do list
        
        
        public function dashboard() : void {
            if(!$this->enseignant) {
                header('Location: /pfa/index.php?url=login');
                exit;
            }
    
    // Récupérer les données pour le dashboard
            $classes = $this->enseignant->getClasses();
            $matieres = $this->enseignant->getMatieres();
            $nbClasses = count($classes);
            $nbMatieres = count($matieres);
        
        // Statistiques rapides (à adapter selon ta base)
            $nbEleves = 0;
            foreach($classes as $classe) {
            // Récupérer le nombre d'élèves par classe (à implémenter)
                $nbEleves += $this->enseignant->getNbElevesByClasse($classe['id']);
            }
        
            $titre = "Dashboard Enseignant";
            $view = "dashboard";
            require_once __DIR__ . '/../../plain.inc.php';
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