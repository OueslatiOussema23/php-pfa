<?php

    namespace App\Controllers;
    use App\Models\User;

    class AuthController{

        //affichage de la page (appel de view)
        public function showLogin() : void {
            //verifier si l'utilisateur a deja fait le login
            if(isset($_SESSION["user_id"])){
                //afficher les interface (views) convenable selon son role
                $this->redirigerSelonRole($_SESSION["user_role"]);
                return;
            }

            require_once __DIR__ . '/../Views/Auth/log-in.php';
        }

        //rediriger selon role
        public function redirigerSelonRole(string $role) : void {
            switch ($role) {
                case 'ADMIN' :
                    header('Location: /Administrateur/Dashboard.php');
                    break;
                
                case 'ENS' :
                    header('Location: /pfa/enseignant/ajouterNotes');
                    break;
                
                case 'SURV' :
                    header('Location: /Surveillant/Dashboard.php');
                    break;
                default :
                    header('Location: /pfa/index.php?url=home');
            }
            exit;
        }

        //log files (pour les audits de securite)
        public function logger(string $log) : void {
            $logDir = __DIR__ . '/logs'; 
            if(!is_dir($logDir)){
                mkdir($logDir, 0755, TRUE);
            }
            
            //creation de fichier chaque jour automatiquement pour bien cibler quand viennent les attaques
            $logFile = $logDir . '/security_' . date('Y-m-d') . '.log';

            //les parametres a recuperer
            $ip = $_SERVER["REMOTE_ADDR"]?? '';
            $time = date('Y-m-d H:i:s');
            $userId = $_SESSION["user_id"] ?? 'GUEST';

            //mise en forme
            $content = "[TIME: $time]\t[USER: $userId]\t[IP: $ip]\t[LOG: $log]\r\n";

            //ecrire dans le fichier
            file_put_contents($logFile, $content, FILE_APPEND | LOCK_EX);
        }
        
        //fonction pour la deconexion (supprimer tous les variables de la session et supprimer la session)
        public function LogOut() : void {
            session_unset();
            session_destroy();
            header('Location: /pfa/');
            exit;
        }

        //traitment de la login (la logique)
        public function login() : void {
            //verification de request method 
            if($_SERVER["REQUEST_METHOD"] !== "POST"){
                //rediriger l'utilisateur s'il nutilise pas la methode post (donc il a eviter le formulaire)
                header('Location: /pfa/index.php?url=login');
                exit;
            }


            //recuperer ses donnees (@mail et mot de passe)
            $email = $_POST['email'] ?? '';
            $pwd = $_POST['pwd'] ?? '';
            

            //le handling des erreurs
            //verifier si les champs sont vides
            if(empty($email) || empty($pwd)){
                $_SESSION["login-error"] = "Veuillez remplir tous les champs";
                $this->logger("Failed to log in - empty fields ");
                header('Location: /pfa/login');
                exit;
            }

            //@mail erronee
            //chercher l'user dans la base des users avec son email
            $user = new User();
            $user = User::findByEmail($email);
            //si le resutat est 'null' (il n'existe pas dans la base des users)
            if(!$user){
                $_SESSION["login-error"] = "Email incorrect";
                $this->logger("Failed to log in - wrong email for " . $email);
                header('Location: /pfa/login');
                exit;
            }

            //mot de pass incorrecte
            //verifyPassword() est une fonction que j'ai creee dans la classe User
            if(!$user->verifyPassword($pwd)){
                $_SESSION["login-error"] = "Mot de passe incorrect";
                $user->failedToLogin();
                $this->logger("Failed to log in - wrong password for " . $email);
                header('Location: /pfa/login');
                exit;
            }

            //en cas ou il y aucune erreur
            
            $this->logger("logged in successfully for " . $email);
            unset($_SESSION["user"]);
            $_SESSION["user"] = [
                'id' => $user->getId(),
                'nom' => $user->getNom(),
                'prenom' => $user->getPrenom(),
                'email' => $user->getEmail(),
                'role' => $user->getRole()
            ];
            
            $this->redirigerSelonRole($user->getRole());
            $user->successfullLogin();
        }   
    }