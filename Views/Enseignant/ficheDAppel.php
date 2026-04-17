<?php
// Vérifier que $eleves est disponible
if(empty($eleves)): ?>
    <div class="alert alert-warning">Aucun élève trouvé pour cette classe.</div>
<?php else: ?>
    
    <form action='' method='post'>
    <h2>Fiche d'appel</h2>
        <table class='table table-dark table-striped table-hover'>
            <thead>    
                <tr>
                    <th>Numéro</th>
                    <th>Nom</th>
                    <th>Présent(e)</th>
                    <th>Absent(e)</th>
                </tr>        
                    
            </thead>
            <tbody>
                <?php $i=1; foreach($eleves as $eleve): ?>
                <tr>
                    <td><?= $i++ ?></td>
                    <td><?= ($eleve['prenom'] . ' ' . $eleve['nom']) ?></td>
                    <td>
                        <input type='radio' class='btn-check' name='etudiant_" . $i . "' id='present_" . $i . "' autocomplete='off' checked>
                        <label class='btn btn-outline-success' for='present_" . $i . "'>Présent(e)</label>
                    </td>
                    <td>
                        <input type='radio' class='btn-check' name='etudiant_" . $i . "' id='absent_" . $i . "' autocomplete='off'>
                        <label class='btn btn-outline-danger' for='absent_" . $i . "'>Absent(e)</label>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
        <div class='d-grid gap-2 col-6 mx-auto'>
              <button class='btn btn-primary' type='button'>Soumettre</button>
        </div>
    </form>
<?php endif; ?>