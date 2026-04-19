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