
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $titre ?? 'Acceuil'; ?></title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.min.css">
</head>
<body>
    <?php
        if(isset($_SESSION["user"]) && !empty($_SESSION["user"])){
            switch($_SESSION["user"]['role']){
                case 'ENS':
                    $role = 'Enseignant';
                    $opt = "<a class='nav-link text-white' href='/pfa/enseignant/dashboard'>
                            <i class='bi bi-speedometer2'></i><span class='d-none d-sm-inline ms-2'>Dashboard</span>
                        </a>
                        <a class='nav-link text-white' href='/pfa/enseignant/calendar'>
                            <i class='bi bi-calendar-fill'></i><span class='d-none d-sm-inline ms-2'>Calendrier</span>
                        </a>
                        <a class='nav-link text-white' href='/pfa/enseignant/ficheAppel'>
                            <i class='bi bi-journal'></i><span class='d-none d-sm-inline ms-2'>Feuille d'appel</span>
                        </a>
                        <a class='nav-link text-white' href='/pfa/enseignant/ajouterNotes'>
                            <i class='bi bi-pencil-square'></i><span class='d-none d-sm-inline ms-2'>Saisir notes</span>
                        </a>";
                    break;
                case 'ADMIN':
                    $role = 'Administrateur';
                    break;
                case 'SURV':
                    $role = 'Surveillant';
                    break;
            }
            require_once 'Views/Partials/toolbar.inc.php';
        }else{
            require_once 'Views/Partials/navbar.inc.php';
        }
    ?>
    <div class="container-fluid">
    
        <div class="row" style="height: 100vh;">
            <div class="col-2 col-sm-3 col-xl-2 bg-dark">
                <div class="container">
                    <nav class="navbar bg-dark border-bottom border-white mb-3" data-bs-theme="dark">
                        <div class="container-fluid">
                            <a href="" class="navbar-brand"><?= $role; ?></a>
                        </div>
                    </nav>
                    <nav class="nav flex-column">
                
                    <?= $opt; ?>
                    </nav>
                </div>
            </div>
            
            <div class="col-10 col-sm-9 col-md-10">
                <nav class="navbar navbar-expand-lg bg-body-tertiary mb-3">
                    <div class="container-fluid">
                        
                    </div>
                </nav>
                <div class="container">
                

        <?php 
        
        $viewPath = __DIR__ . '/Views/Enseignant/' . $view . '.php';
        
        if(file_exists($viewPath)) {
            require_once $viewPath;
        } else {
            // Si pas trouvé, essayer à la racine
            $viewPath = __DIR__ . '/' . $view . '.php';
            if(file_exists($viewPath)) {
                require_once $viewPath;
            } else {
                echo "<div class='alert alert-danger'>";
                echo "<strong>Erreur :</strong> Vue non trouvée : " . htmlspecialchars($view) . "<br>";
                echo "Chemin recherché : " . $viewPath;
                echo "</div>";
            }
        }
        ?>

                </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js" integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI" crossorigin="anonymous"></script>
</body>
</html>