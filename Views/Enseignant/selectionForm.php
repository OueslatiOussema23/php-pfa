
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header bg-primary text-white">
                    <h4 class="mb-0">
                        <?= $action === 'notes' ? ' Ajouter des notes' : ' Feuille d\'appel' ?>
                    </h4>
                </div>
                <div class="card-body">
                    <?php if(isset($_SESSION['error'])): ?>
                        <div class="alert alert-danger"><?= $_SESSION['error']; unset($_SESSION['error']); ?></div>
                    <?php endif; ?>
                    
                    <form method="post" action="/pfa/index.php?url=enseignant/processSelection">
                        <input type="hidden" name="action" value="<?= $action ?>">
                        
                        <div class="mb-3">
                            <label for="classe" class="form-label">Classe</label>
                            <select name="classe" id="classe" class="form-select" required>
                                <option value="">Sélectionner une classe</option>
                                <?php if(!empty($classes) && is_array($classes)): ?>
                                    <?php foreach($classes as $classe): ?>
                                        <option value="<?= htmlspecialchars($classe['id']) ?>" >
                                            <?= htmlspecialchars($classe['nomClasse']) ?>
                                        </option>
                                    <?php endforeach; ?>
                                <?php else: ?>
                                    <option value="">Aucune classe disponible</option>
                                <?php endif; ?>
                            </select>
                        </div>
                        
                        <div class="mb-3">
                            <label for="matiere" class="form-label">Matière</label>
                            <select name="matiere" id="matiere" class="form-select" required>
                                <option value="">Sélectionner une matière</option>
                                <?php foreach($matieres as $matiere): ?>
                                    <option value="<?= $matiere['id'] ?>">
                                        <?= $matiere['nom'] ?>
                                    </option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        
                        <div class="d-grid gap-2">
                            <button type="submit" class="btn btn-primary">Continuer</button>
                            <a href="/pfa/index.php?url=enseignant/dashboard" class="btn btn-secondary">Annuler</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>