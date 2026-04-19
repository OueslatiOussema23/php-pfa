<?php if(empty($eleves)): ?>
    <div class="alert alert-warning">Aucun élève trouvé pour cette classe.</div>
<?php else: ?>

<h2>Gestion des notes des étudiants</h2>

<?php if ($_SERVER["REQUEST_METHOD"] === "POST" && empty($erreurs)): ?>
    <div class="alert alert-success">Toutes les notes ont été enregistrées avec succès !</div>
<?php elseif ($_SERVER["REQUEST_METHOD"] === "POST" && !empty($erreurs)): ?>
    <div class="alert alert-danger">Veuillez corriger les erreurs ci-dessous.</div>
<?php endif; ?>

<form method="post" action="/pfa/index.php?url=enseignant/sauvegarderNotes">
    <input type="hidden" name="classe_id" value="<?= htmlspecialchars($_GET['classe'] ?? '') ?>">
    <input type="hidden" name="matiere_id" value="<?= htmlspecialchars($_GET['matiere'] ?? '') ?>">

    <table class="table table-dark table-striped table-hover">
        <thead>
            <tr><th>Nom</th><th>Note (0-20)</th></tr>
        </thead>
        <tbody>
            <?php foreach($eleves as $eleve): ?>
            <tr>
                <td><strong><?= htmlspecialchars($eleve['prenom'] . ' ' . $eleve['nom']) ?></strong></td>
                <td>
                    <input type="number" name="notes[<?= $eleve['id'] ?>]" step="0.25" min="0" max="20" class="form-control" required>
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>

    <div class="d-grid gap-2 col-6 mx-auto">
        <button type="submit" class="btn btn-primary">Soumettre</button>
    </div>
</form>

<?php endif; ?>