<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.min.css">
  </head>
  <body>
    <!--Importation de la navbar-->
    <?php require_once 'includes/navabar.inc.php'; ?>
    <div class="container-fluid">
        <div class="row" style="height: 100vh;">
            <div class="col-2 col-sm-3 col-xl-2 bg-dark">
                <div class="container">
                    <nav class="navbar bg-dark border-bottom border-white mb-3" data-bs-theme="dark">
                        <div class="container-fluid">
                            <a href="#" class="navbar-brand">NavBar</a>
                            <i class="bi bi-columns-gap"></i><span>Directeur</span>
                        </div>
                    </nav>
                    <nav class="nav flex-column">
                        <a class="nav-link text-white" aria-current="page" href="#">
                            <i class="bi bi-speedometer2"></i><span class="d-none d-sm-inline ms-2">Dashboard</span>
                        </a>
                        <a class="nav-link text-white" href="#">Link</a>
                        <a class="nav-link text-white" href="#">Link</a>
                        <a class="nav-link text-white" aria-disabled="true">Disabled</a>
                    </nav>
                </div>
            </div>
            <div class="col-10 col-sm-9 col-xl-1 p-0 m-0">
                <nav class="navbar navbar-expand-lg bg-body-tertiary mb-3">
                    <div class="container-fluid">
                        
                    </div>
                </nav>
                <div class="px-3">
                    <p>Hello !</p>
                    <p>Hello !</p>
                    <p>Hello !</p>
                    <p>Hello !</p>
                </div>
            </div>
        </div>
    </div>
  </body>
</html>