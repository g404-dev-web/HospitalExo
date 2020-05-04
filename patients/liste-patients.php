<?php

//connexion à la base de donnée
require_once($_SERVER['DOCUMENT_ROOT'] . '/connexion.php');

// Paramètres de configuration
$page = isset($_REQUEST['p']) ? (int)$_REQUEST['p'] : 1;
$resultsPerPage = 5;

// Calcul du offset
$offset = ($page - 1) * $resultsPerPage;

// Compter le nombre de résultats pour la pagination
$patientsCount = $bdd->query('SELECT count(*) FROM patients')->fetchColumn();
$pageCount = ceil($patientsCount / $resultsPerPage);


if (isset($_REQUEST["s"])) {
    //requête de sélection de tous les patients
    $patientsStatement = $bdd->prepare(
        "SELECT * 
          FROM patients 
          WHERE firstname LIKE ?
          OR lastname LIKE ?
          OR phone LIKE ?
          OR mail LIKE ?"
    );
    $s = '%'.$_REQUEST["s"].'%';
    $patientsStatement->execute([$s,$s,$s,$s]);
} else {
    //requête de sélection de tous les patients
    $patientsStatement = $bdd->query("SELECT * FROM patients LIMIT $resultsPerPage OFFSET $offset");
}

//récupération des données de la requête
$patients = $patientsStatement->fetchAll();

?>
<!DOCTYPE html>
<html lang="fr">

<head>
    <title>Liste des patients</title>
    <?php include($_SERVER['DOCUMENT_ROOT'] . '/partials/head.php'); ?>
</head>

<body>

<?php include($_SERVER['DOCUMENT_ROOT'] . '/partials/header.php'); ?>


<div class="container">

    <h1>Liste des patients</h1>

    Il y a <?= $patientsCount ?> patient(s).<br>

    <a href="ajout-patient.php" class='btn btn-secondary'>Ajouter un patient</a>

    <form>
        <label for="search">Recherche</label> <input id="search" type="text" name="s">
        <button>🔍</button>
    </form>

    <br>
    <br>
    <?php
    // Boucle d'affichage des patients
    foreach ($patients as $patient)  : ?>
        <div class="card patient">
            <div class="card-body">
                <h5 class="card-title"><?= $patient['lastname'] ?> <?= $patient['firstname'] ?></h5>
                numéro client : <?= $patient['id'] ?><br>
                <form action='delete-patient.php' method='post' style="display:inline-block">
                    <input type='hidden' name='patientId' value="<?= $patient['id'] ?>">
                    <button type='submit' class='btn btn-small btn-danger btn-sm'>Supprimer</button>
                </form>
                <a href='profil-patient.php?patientId=<?= $patient['id'] ?>' class='btn btn-primary btn-sm'>Détails</a>
            </div>
        </div>
    <?php endforeach; ?>


    <?php if(!isset($_REQUEST["s"])) : ?>
    <br><br>
    <nav aria-label="Patients navigation">
        <ul class="pagination">
            <?php if ($page > 1) : ?>
                <li class="page-item"><a class="page-link" href="?p=<?= $page - 1 ?>">Précédent</a></li>
            <?php endif; ?>

            <?php for ($i = 1; $i < $pageCount + 1; $i++) : ?>
                <?php if ($i === $page) : ?>
                    <li class="page-item active">
                        <a class="page-link" href="#"><?= $i ?> <span class="sr-only">(page courante)</span></a>
                    </li>
                <?php else : ?>
                    <li class="page-item"><a class="page-link" href="?p=<?= $i ?>"><?= $i ?></a></li>
                <?php endif; ?>
            <?php endfor; ?>

            <?php if ($page < $pageCount) : ?>
                <li class="page-item"><a class="page-link" href="?p=<?= $page + 1 ?>">Suivant</a></li>
            <?php endif; ?>
        </ul>
    </nav>
    <?php endif; ?>
</div>

<?php include($_SERVER['DOCUMENT_ROOT'] . '/partials/footer.php'); ?>

</body>

</html>