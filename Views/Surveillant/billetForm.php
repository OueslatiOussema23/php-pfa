<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card">
                <div class="card-header bg-primary text-white">
                    <h4>Générer un billet d'absence</h4>
                </div>
                <div class="card-body">
                    <?php if(isset($_SESSION['error'])): ?>
                        <div class="alert alert-danger"><?= $_SESSION['error']; unset($_SESSION['error']); ?></div>
                    <?php endif; ?>
                    
                    <p><strong>Élève :</strong> <?= htmlspecialchars($eleve['prenom'] . ' ' . $eleve['nom']) ?></p>
                    <p><strong>Classe :</strong> <?= htmlspecialchars($eleve['nomClasse'] ?? 'Non définie') ?></p>
                    
                    <form method="post" action="/pfa/index.php?url=surveillant/sauvegarderBillet">
                        <input type="hidden" name="eleve_id" value="<?= $eleve['id'] ?>">
                        
                        <div class="mb-3">
                            <label for="date_absence" class="form-label">Date d'absence</label>
                            <select name="date_absence" id="date_absence" class="form-select" required>
                                <option value="">Sélectionner une date</option>
                                <?php foreach($datesAbsences as $date): ?>
                                    <option value="<?= $date['dateAppel'] ?>"><?= date('d/m/Y', strtotime($date['dateAppel'])) ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        
                        <div class="mb-3">
                            <label for="motif" class="form-label">Motif (optionnel)</label>
                            <textarea name="motif" id="motif" class="form-control" rows="3" placeholder="Raison de l'absence..."></textarea>
                        </div>
                        
                        <div class="mb-3 form-check">
                            <input type="checkbox" name="justifie" id="justifie" class="form-check-input" value="1">
                            <label for="justifie" class="form-check-label">Absence justifiée</label>
                        </div>
                        
                        <button type="submit" class="btn btn-primary">Générer le billet</button>
                        <a href="/pfa/index.php?url=surveillant/dashboard" class="btn btn-secondary">Annuler</a>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>