<?php if(empty($eleves)): ?>
    <div class="alert alert-warning">Aucun élève trouvé pour cette classe.</div>
<?php else: ?>
    <form method="post" action="/pfa/index.php?url=enseignant/sauvegarderAppel">
        <input type="hidden" name="classe_id" value="<?= htmlspecialchars($_GET['classe'] ?? '') ?>">
        <input type="hidden" name="matiere_id" value="<?= htmlspecialchars($_GET['matiere'] ?? '') ?>">
        <h2>Fiche d'appel</h2>
        <table class="table table-dark table-striped table-hover">
            <thead>
                <tr><th>#</th><th>Nom</th><th>Présent(e)</th><th>Absent(e)</th></tr>
            </thead>
            <tbody>
                <?php $i = 1; foreach($eleves as $eleve): ?>
                <tr>
                    <td><?= $i++ ?></td>
                    <td><?= htmlspecialchars($eleve['prenom'] . ' ' . $eleve['nom']) ?></td>
                    <td>
                        <input type="radio" class="btn-check" name="presence[<?= $eleve['id'] ?>]" id="present_<?= $eleve['id'] ?>" value="present" checked>
                        <label class="btn btn-outline-success" for="present_<?= $eleve['id'] ?>">Présent(e)</label>
                    </td>
                    <td>
                        <input type="radio" class="btn-check" name="presence[<?= $eleve['id'] ?>]" id="absent_<?= $eleve['id'] ?>" value="absent">
                        <label class="btn btn-outline-danger" for="absent_<?= $eleve['id'] ?>">Absent(e)</label>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
        <button type="submit" class="btn btn-primary">Soumettre</button>
    </form>
<?php endif; ?>