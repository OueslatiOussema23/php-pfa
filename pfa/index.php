<?php

    session_start();
    //j'appelle mon autoloader
    // (le truc qui sert a appeller les classes au moment d'instanciation automatiquemant   sans faire des requires)
    require_once __DIR__ . '/autoload.php';

    //j'appelle mes namespaces

    use App\Controllers\AuthController;
    use App\Controllers\EnseignantController;
    use App\Controllers\AdministrateurController;
    use App\Controllers\PageController;

    //je recupere l'url et la request method pour faire le routing

    $url = $_GET["url"] ?? '';
    $requestMethod = $_SERVER["REQUEST_METHOD"];

    //rouatage mannuel
    //je vais utiliser ca (->) pour dire rediriger
    switch ($url){
        //le cas par defaut -> Home (l'index)
        case 'Home';
        case '':
            require_once __DIR__ . '/Views/Partials/portail.php';
            break;

        case 'contact':
            require_once __DIR__ . '/Views/Partials/Contact.inc.php';
            break;
        
        case 'login':
            if($requestMethod === "POST"){
                $controller = new AuthController();
                $controller->login();
            }else{
                require_once __DIR__ . '/Views/Auth/log-in.php';
            }
            break;
            
    
        case 'logout':
            $controller = new AuthController();
            $controller->LogOut();
            break;
        //routage selon role
        //Enseignant
        case '/enseignant/dashboard':
            $view = "dashboard";
            require_once 'plain.inc.php';
            break;

        case 'enseignant/ficheAppel':
            $titre = "Fiche d'appel";
            $view = "ficheDAppel";
            require_once 'plain.inc.php';
            break;
        
        case 'enseignant/ajouterNotes':
            $titre = "Fiche des notes";
            $view = "ajouterNotes";
            require_once 'plain.inc.php';
            break;

        //Directeur
        case 'administrateur/dashboard':
            $controller = new AdministrateurController();
            $controller->dashboard();
            break;

        default :
            http_response_code(404);
            echo "<h1>ERROR-404 Page introvable</h1> <br>";
            echo "<p>La page demande n'existe pas</p> <br>";
            echo "<a href='/pfa'>Revenir a la page d'acceuille</a>";
            break;
        }