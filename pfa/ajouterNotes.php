<?php
    //en fonction de classe il y aura un tableau des etudiants donc autrement un autre formulaire de gestion (par requete sql)
    $etudiants = [
    "Jean Dupont" => "",
    "Marie Martin" => "",
    "Pierre Durand" => "",
    "Sophie Lambert" => "",
    "Lucas Bernard" => "",
    "Emma Petit" => "",
    "Hugo Robert" => "",
    "Chloe Richard" => "",
    "Thomas Dubois" => "",
    "Lea Moreau" => "",
    "Nathan Simon" => "",
    "Camille Laurent" => "",
    "Louis Michel" => "",
    "Julie Lefevre" => "",
    "Antoine Garcia" => "",
    "Alice Martinez" => "",
    "Maxime David" => "",
    "Laura Bertrand" => "",
    "Paul Roux" => "",
    "Sarah Vincent" => ""
];
    $erreur = [];
    $notes = [];
    if($_SERVER["REQUEST_METHOD"] === "POST"){
        foreach($etudiants as $nom => $note){
            if(isset($notes[$nom])){
                $notePost = $notes[$nom];
                if($notePost === ""){
                    $erreur[$nom] = 'Note requise';
                }elseif(!is_numeric($notePost) || $notePost < 0 || $notePost > 20){
                    $erreur[$nom] = 'La note doit être comprise entre 0 et 20';
                }else{
                    $etudiants[$nom] = $notePost;
                }
                
            }else{
                $erreur[$nom] = 'Note requise';
            }
        }
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <h2>Gestion des notes des étudiants</h2>

        <?php if ($_SERVER["REQUEST_METHOD"] === "POST" && empty($erreurs)): ?>
            <div class="alert alert-success" role="alert">
                Toutes les notes ont été enregistrées avec succès !
            </div>
        <?php elseif ($_SERVER["REQUEST_METHOD"] === "POST" && !empty($erreurs)): ?>
            <div class="alert alert-danger" role="alert">
                Veuillez corriger les erreurs ci-dessous.
            </div>
        <?php endif; ?>

    <form action="<?=htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post">

        <table class='table table-dark table-striped table-hover'>
            <thead>
                <tr>
                    <th>Nom</th>
                    <th>Notes</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <?php foreach($etudiants as $nom => $note): ?>
                    <td><strong><?= htmlspecialchars($nom);?></strong></td>
                    <td>
                        <div class="">
                            <label for="note">Note: </label>
                            <input type="number" name="notes[<?= htmlspecialchars($nom) ?>]" id="note" class="form-control">
            
                            <?php if(isset($erreur[$nom])): ?>
                                    <span class="text-danger"><?= htmlspecialchars($erreur[$nom]); ?></span>
                            <?php endif;?>
                        </div>
                    </td>
                </tr>
                <?php endforeach;?>
            </tbody>
        </table>
        <div class='d-grid gap-2 col-6 mx-auto'>
              <button class='btn btn-primary' type='button'>Soumettre</button>
        </div>

    </form>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>