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
                            <h6 class="card-title">Mes classes</h6>
                            <h2 class="mb-0"><?= $nbClasses ?? 0 ?></h2>
                        </div>
                        <i class="bi bi-people fs-1 opacity-50"></i>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="col-md-3 mb-3">
            <div class="card text-white bg-success">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <h6 class="card-title">Matières enseignées</h6>
                            <h2 class="mb-0"><?= $nbMatieres ?? 0 ?></h2>
                        </div>
                        <i class="bi bi-book fs-1 opacity-50"></i>
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

    <!-- Section des actions rapides -->
    <div class="row mb-4">
        <div class="col-12">
            <div class="card">
                <div class="card-header bg-secondary text-white">
                    <i class="bi bi-lightning"></i> Actions rapides
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6 mb-2">
                            <a href="/pfa/index.php?url=enseignant/selectForm&action=appel" class="btn btn-outline-primary w-100 py-3">
                                <i class="bi bi-journal fs-4 d-block"></i>
                                Faire l'appel
                            </a>
                        </div>
                        <div class="col-md-6 mb-2">
                            <a href="/pfa/index.php?url=enseignant/selectForm&action=notes" class="btn btn-outline-success w-100 py-3">
                                <i class="bi bi-pencil-square fs-4 d-block"></i>
                                Saisir des notes
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Liste des classes -->
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header bg-dark text-white">
                    <i class="bi bi-people"></i> Mes classes
                </div>
                <div class="card-body">
                    <?php if(!empty($classes)): ?>
                        <div class="table-responsive">
                            <table class="table table-hover">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Classe</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $i = 1; foreach($classes as $classe): ?>
                                    <tr>
                                        <td><?= $i++ ?></td>
                                        <td><?= htmlspecialchars($classe['nomClasse']) ?></td>
                                        <td>
                                            <a href="/pfa/index.php?url=enseignant/selectForm&action=appel&classe_id=<?= $classe['id'] ?>" 
                                               class="btn btn-sm btn-outline-primary">
                                                <i class="bi bi-journal"></i> Appel
                                            </a>
                                            <a href="/pfa/index.php?url=enseignant/selectForm&action=notes&classe_id=<?= $classe['id'] ?>" 
                                               class="btn btn-sm btn-outline-success">
                                                <i class="bi bi-pencil-square"></i> Notes
                                            </a>
                                        </td>
                                    </tr>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                        </div>
                    <?php else: ?>
                        <div class="alert alert-info">Aucune classe affectée.</div>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
</div>