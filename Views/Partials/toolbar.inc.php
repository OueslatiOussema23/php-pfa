<nav class="navbar navbar-expand-lg bg-body-tertiary" data-bs-theme="dark">
    <div class="container-fluid">
        <a class="navbar-brand" href="Home">Madresty</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent">
            <span class="navbar-toggler-icon"></span>
        </button>
        
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <li class="nav-item">
                    
                </li>
            </ul>
            
            <form class="d-flex me-3" role="search">
                <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
                <button class="btn btn-outline-success" type="submit">Search</button>
            </form>
            
            <!-- Menu utilisateur connecté -->
            <?php if(isset($_SESSION["user"])): ?>
                <div class="dropdown">
                    <button class="btn btn-outline-light dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                        <?= htmlspecialchars($_SESSION["user"]['prenom'] ?? $_SESSION["user"]['nom']) ?>
                    </button>
                    <ul class="dropdown-menu dropdown-menu-end">
                        <li><span class="dropdown-item-text text-muted">
                            Connecté en tant que<br>
                            <strong><?= htmlspecialchars($_SESSION["user"]['nom']) ?></strong>
                        </span></li>
                        <li><hr class="dropdown-divider"></li>
                        <li><a class="dropdown-item text-danger" href="/pfa/index.php?url=logout">
                            <i class="bi bi-box-arrow-right"></i> Déconnexion
                        </a></li>
                    </ul>
                </div>
            <?php else: ?>
                <a href="login" class="btn btn-outline-primary">Se connecter</a>
            <?php endif; ?>
        </div>
    </div>
</nav>
