<?php
// Connexion BD (exemple)
$conn = mysqli_connect("localhost", "root", "", "");

// Nombre total d'élèves
$res_total = mysqli_query($conn, "SELECT COUNT(*) as total FROM eleves");
$total = mysqli_fetch_assoc($res_total)['total'];

// Nombre présents
$res_present = mysqli_query($conn, "SELECT COUNT(*) as present FROM eleves WHERE present=1");
$present = mysqli_fetch_assoc($res_present)['present'];

// Taux d'absence
$taux_absence = ($total > 0) ? (($total - $present) / $total) * 100 : 0;

// Nombre classes
$res_classes = mysqli_query($conn, "SELECT COUNT(*) as classes FROM classes");
$classes = mysqli_fetch_assoc($res_classes)['classes'];

// Enseignants présents
$enseignants = mysqli_query($conn, "SELECT nom FROM enseignants WHERE present=1");

// Top élèves
$top_eleves = mysqli_query($conn, "SELECT nom, moyenne FROM eleves ORDER BY moyenne DESC LIMIT 5");
?>

<!DOCTYPE html>
<html lang="fr">
<head>
<meta charset="UTF-8">
<title>Dashboard</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body class="bg-light">

<div class="container mt-4">

<h2 class="mb-4">📊 Tableau de bord</h2>

<div class="row">

/* Taux d'absence */
<div class="col-md-4">
<div class="card text-center p-3">
<h5>Taux d'absence</h5>
<h3 class="text-danger"><?php echo round($taux_absence,2); ?> %</h3>
</div>
</div>

/* Nombre élèves */
<div class="col-md-4">
<div class="card text-center p-3">
<h5>Nombre d'élèves</h5>
<h3><?php echo $total; ?></h3>
</div>
</div>

/* Nombre classes */
<div class="col-md-4">
<div class="card text-center p-3">
<h5>Nombre de classes</h5>
<h3><?php echo $classes; ?></h3>
</div>
</div>

</div>

/*Enseignants présents */
<div class="mt-4">
<h4>👨‍🏫 Enseignants présents</h4>
<ul class="list-group">
<?php while($row = mysqli_fetch_assoc($enseignants)) { ?>
<li class="list-group-item"><?php echo $row['nom']; ?></li>
<?php } ?>
</ul>
</div>

<!-- Top élèves -->
<div class="mt-4">
<h4>🏆 Meilleurs élèves</h4>
<table class="table table-bordered">
<tr>
<th>Nom</th>
<th>Moyenne</th>
</tr>

<?php while($row = mysqli_fetch_assoc($top_eleves)) { ?>
<tr>
<td><?php echo $row['nom']; ?></td>
<td><?php echo $row['moyenne']; ?></td>
</tr>
<?php } ?>

</table>
</div>

</div>

</body>
</html>