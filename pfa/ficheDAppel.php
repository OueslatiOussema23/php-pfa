
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

<?php
    $etudiants = [
        "Amira",
        "Youssef", 
        "Sofia",
        "Rayan",
        "Lina",
        "Ilyas",
        "Maya",
        "Adam",
        "Ines",
        "Walid",
        "Zineb",
        "Sami",
        "Nour",
        "Karim",
        "Rim",
        "Mehdi",
        "Hiba",
        "Omar",
        "Salma",
        "Anas"
    ];

    function faireAppel($etudiants){
        echo "
                <table class='table table-dark table-striped table-hover'>
                    <tr>
                        <th>Numéro</th>
                        <th>Nom</th>
                        <th>Présent(e)</th>
                        <th>Absent(e)</th>
                    </tr>        
        ";
        echo"
            <form action='' method='post'>
            <h2>Fiche d'appel</h2>
            ";

        for($i = 0; $i < count($etudiants); $i++){
            $numero = $i + 1;
            echo "
                    <tr>
                        <td>" . $numero . "</td>
                        <td>" . $etudiants[$i] . "</td>
                        <td>
                            <input type='radio' class='btn-check' name='etudiant_" . $i . "' id='present_" . $i . "' autocomplete='off' checked>
                            <label class='btn btn-outline-success' for='present_" . $i . "'>Présent(e)</label>
                        </td>
                        <td>
                            <input type='radio' class='btn-check' name='etudiant_" . $i . "' id='absent_" . $i . "' autocomplete='off'>
                            <label class='btn btn-outline-danger' for='absent_" . $i . "'>Absent(e)</label>
                        </td>
                    </tr>
                ";
        }

        echo "</table>
        <div class='d-grid gap-2 col-6 mx-auto'>
              <button class='btn btn-primary' type='button'>Soumettre</button>
        </div>
        </form>";
    }

faireAppel($etudiants);