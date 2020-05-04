<?php

//connexion à la base de donnée
include '../connexion.php';

$page = isset($_REQUEST['p']) ? (int)$_REQUEST['p'] : 1;
$resultsPerPage = 5;
$offset = ($page - 1) * $resultsPerPage;

// Compter le nombre de résultats pour la pagination
$patientsCount = $bdd->query('SELECT count(*) FROM patients')->fetchColumn();
$pageCount = ceil($patientsCount / $resultsPerPage);

//requête de sélection de tous les patients
$reponse = $bdd->query("SELECT * FROM patients LIMIT $resultsPerPage OFFSET $offset");
//récupération des données de la requête
$patients = $reponse->fetchAll();

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <title>Liste des patients</title>
    <?php include($_SERVER['DOCUMENT_ROOT'] . '/partials/head.php'); ?>
</head>

<body>

<?php include($_SERVER['DOCUMENT_ROOT'] . '/partials/header.php'); ?>

<div class="container">

    Il y a <?= $patientsCount ?> patient(s).<br>
    <a href="ajout-patient.php" class='btn btn-secondary'>Ajouter un patient</a>
    <br>
    <br>
    <?php
    // Boucle d'affichage des patients
    foreach ($patients as $patient)  : ?>
        <div class="card patient">
            <div class="card-body">
                <h5 class="card-title"><?= $patient['lastname'] ?> <?= $patient['firstname'] ?></h5>
                numéro client : <?= $patient['id'] ?><br>
                <form action='delete-patient.php' method='post'>
                    <input type='hidden' name='patientId' value="<?= $patient['id'] ?>">
                    <button type='submit' class='btn btn-small btn-danger'>Supprimer ce patient</button>
                </form>
                <a href='profil-patient.php?patientId=<?= $patient['id'] ?>' class='btn btn-primary'>Détails</a>
            </div>
        </div>
    <?php endforeach; ?>


    <br><br>
    <nav aria-label="Patients navigation">
        <ul class="pagination">
            <?php if($page > 1) : ?>
            <li class="page-item"><a class="page-link" href="?p=<?=$page-1?>">Précédent</a></li>
            <?php endif; ?>

            <?php for ($i = 1; $i < $pageCount + 1; $i++) : ?>
                <?php if ($i === $page) : ?>
                    <li class="page-item active">
                        <a class="page-link" href="#"><?=$i?> <span class="sr-only">(current)</span></a>
                    </li>
                <?php else : ?>
                    <li class="page-item"><a class="page-link" href="?p=<?= $i ?>"><?= $i ?></a></li>
                <?php endif; ?>
            <?php endfor; ?>

            <?php if($page < $pageCount) : ?>
                <li class="page-item"><a class="page-link" href="?p=<?=$page+1?>">Suivant</a></li>
            <?php endif; ?>
        </ul>
    </nav>
</div>

<?php include($_SERVER['DOCUMENT_ROOT'] . '/partials/footer.php'); ?>

</body>

</html>