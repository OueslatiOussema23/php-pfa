<div class="container">
    <!-- En-tête -->
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">
            <i class="bi bi-speedometer2"></i> Dashboard
        </h1>
        <div class="btn-toolbar mb-2 mb-md-0">
            <div class="btn-group me-2">
                <span class="badge bg-primary fs-6 p-2">
                    <?= date('d/m/Y H:i') ?>
                </span>
            </div>
        </div>
    </div>

    <!-- Cartes statistiques -->
    <div class="row mb-4">
        <div class="col-md-3 mb-3">
            <div class="card text-white bg-primary">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <h6 class="card-title">Taux de presence</h6>
                            <h2 class="mb-0"><?= $tauxPresence ?? 0 ?></h2>
                        </div>
                        <i class="bi bi-people fs-1 opacity-50"></i>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="col-md-3 mb-3">
            <div class="card text-white bg-danger">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <h6 class="card-title">Taux d'absense</h6>
                            <h2 class="mb-0"><?= $tauxAbsense . "%" ?? 0 ?></h2>
                        </div>
                        <i class="bi bi-people fs-1 opacity-50"></i>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="col-md-3 mb-3">
            <div class="card text-white bg-info">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <h6 class="card-title">Total élèves</h6>
                            <h2 class="mb-0"><?= $nbEleves ?? 0 ?></h2>
                        </div>
                        <i class="bi bi-mortarboard fs-1 opacity-50"></i>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="col-md-3 mb-3">
            <div class="card text-white bg-warning">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <h6 class="card-title">Aujourd'hui</h6>
                            <h2 class="mb-0"><?= date('d/m') ?></h2>
                        </div>
                        <i class="bi bi-calendar fs-1 opacity-50"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

    
    <div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header bg-dark text-white">
                <i class="bi bi-people"></i> Les absents
            </div>
            <div class="card-body">
                <?php if(!empty($absents)): ?>
                    <div class="table-responsive">
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Nom</th>
                                    <th>Prénom</th>
                                    <th>Billet</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $i = 1; foreach($absents as $absent): ?>
                                <tr>
                                    <td><?= $i++ ?></td>
                                    <td><?= htmlspecialchars($absent['nom']) ?></td>
                                    <td><?= htmlspecialchars($absent['prenom']) ?></td>
                                    <td>
                                        <a href="/pfa/index.php?url=surveillant/billet&eleve_id=<?= $absent['id'] ?>" 
                                           class="btn btn-outline-danger btn-sm">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-ticket me-1" viewBox="0 0 16 16">
                                                <path d="M0 4.5A1.5 1.5 0 0 1 1.5 3h13A1.5 1.5 0 0 1 16 4.5V6a.5.5 0 0 1-.5.5 1.5 1.5 0 0 0 0 3 .5.5 0 0 1 .5.5v1.5a1.5 1.5 0 0 1-1.5 1.5h-13A1.5 1.5 0 0 1 0 11.5V10a.5.5 0 0 1 .5-.5 1.5 1.5 0 1 0 0-3A.5.5 0 0 1 0 6zM1.5 4a.5.5 0 0 0-.5.5v1.05a2.5 2.5 0 0 1 0 4.9v1.05a.5.5 0 0 0 .5.5h13a.5.5 0 0 0 .5-.5v-1.05a2.5 2.5 0 0 1 0-4.9V4.5a.5.5 0 0 0-.5-.5z"/>
                                            </svg>
                                            Billet
                                        </a>
                                    </td>
                                </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                <?php else: ?>
                    <div class="alert alert-info">Aucun absent aujourd'hui.</div>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>
</div>