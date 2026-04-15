<?php
$enseignantController = new App\Controllers\EnseignantController();
$classes = $enseignantController->getClasses();
?>

<form action="" method="post">
    <fieldset>
        <legend>Choisir une classe et une matière</legend>
        
        <div class="row">
            <!-- Dropdown Classe -->
            <div class="col-md-6 mb-3">
                <label class="form-label">Classe</label>
                <div class="dropdown">
                    <button class="btn btn-outline-secondary dropdown-toggle w-100 text-start" 
                            type="button" 
                            data-bs-toggle="dropdown" 
                            aria-expanded="false"
                            id="btnClasse">
                        Sélectionner une classe
                    </button>
                    <ul class="dropdown-menu w-100" id="classeMenu">
                        <?php foreach($classes as $classe): ?>
                            <li>
                                <a class="dropdown-item" href="#" data-value="<?= $classe['id'] ?>">
                                    <?= htmlspecialchars($classe['nomClasse']) ?>
                                </a>
                            </li>
                        <?php endforeach; ?>
                    </ul>
                    <input type="hidden" name="classe" id="classeInput">
                </div>
            </div>
            
            <!-- Dropdown Matière -->
            <div class="col-md-6 mb-3">
                <label class="form-label">Matière</label>
                <div class="dropdown">
                    <button class="btn btn-outline-secondary dropdown-toggle w-100 text-start" 
                            type="button" 
                            data-bs-toggle="dropdown" 
                            aria-expanded="false"
                            id="btnMatiere">
                        Sélectionner une matière
                    </button>
                    <ul class="dropdown-menu w-100">
                        <li><a class="dropdown-item" href="#" data-value="mathematiques">Mathématiques</a></li>
                        <li><a class="dropdown-item" href="#" data-value="francais">Français</a></li>
                        <li><a class="dropdown-item" href="#" data-value="anglais">Anglais</a></li>
                        <li><a class="dropdown-item" href="#" data-value="physique">Physique</a></li>
                        <li><a class="dropdown-item" href="#" data-value="informatique">Informatique</a></li>
                        <li><a class="dropdown-item" href="#" data-value="histoire">Histoire</a></li>
                    </ul>
                    <input type="hidden" name="matiere" id="matiereInput">
                </div>
            </div>
        </div>
        
        <button type="submit" class="btn btn-primary mt-2">Valider</button>
    </fieldset>
</form>

<script>
// JavaScript pour gérer les dropdowns
document.querySelectorAll('#classeMenu .dropdown-item').forEach(item => {
    item.addEventListener('click', function(e) {
        e.preventDefault();
        const value = this.getAttribute('data-value');
        const text = this.textContent;
        document.getElementById('btnClasse').textContent = text;
        document.getElementById('classeInput').value = value;
    });
});

document.querySelectorAll('#matiereMenu .dropdown-item').forEach(item => {
    item.addEventListener('click', function(e) {
        e.preventDefault();
        const value = this.getAttribute('data-value');
        const text = this.textContent;
        document.getElementById('btnMatiere').textContent = text;
        document.getElementById('matiereInput').value = value;
    });
});
</script>