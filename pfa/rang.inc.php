<?php
    $etudiants = [
        "Oussema" => ["17.5", "5%", "Anglais"],
        'Ahmed' => ["17.25", "15%", 'Francais'],
        'Khalil' => ["17.05", "5%", 'Arabe'],
        'Aysha' => ["17", "5%", 'Anglais'],
        'Doua' => ["16.90", "5%", 'Informatique'],
        'Mehdi' => ["16.75", "5%", 'Mathematique'],
        'Aziz' => ["16.5", "5%", 'Physique'],
        'Khouloud' => ["16.25", "5%", 'Anglais'],
        'Naomi' => ["15.5", "5%", 'Francais'],
        'Ru' => ["14.5", "5%", 'Anglais']
    ];

    function afficherTop10($etudiants){
        echo "
            <table class='table table-dark table-striped table-hover'>
                <tr>
                    <th>Nom</th>
                    <th>Moyenne</th>
                    <th>Taux d'absence</th>
                    <th>Meilleure matiere</th>
                </tr>        
        ";

        foreach($etudiants as $etudiant => $infos){
            echo "
                <tr>
                    <td>$etudiant</td>
                    <td>$infos[0]</td>
                    <td>$infos[1]</td>
                    <td>$infos[2]</td>
                </tr>
                ";
        }

        echo "</table>";
    }