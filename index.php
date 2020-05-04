<!DOCTYPE html>
<html lang="en">
<head>
    <title>Administration hopital</title>

    <?php include('partials/head.php'); ?>
</head>
<body>

    <?php include('partials/header.php'); ?>

    <div class="container">
        <a href="patients/liste-patients.php" class="btn btn-primary">Liste des patients</a>
        <br>
        <br>
        <!-- Liens vers les formulaires d'ajout -->
        <a href="patients/ajout-patient.php" class="btn btn-secondary">Création de patient</a>
        <br>
        <br>
        <a href="rdv/ajout-rendezvous.php" class="btn btn-secondary">Créer un RDV pour un patient</a>
        <br>
        <br>
        <a href="rdv/liste-rdv.php" class="btn btn-secondary">Liste des RDV</a>
    </div>

    <?php include('partials/footer.php'); ?>
</body>
</html>