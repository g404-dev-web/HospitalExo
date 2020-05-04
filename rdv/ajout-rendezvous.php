<?php

include '../connexion.php';
$patients = $bdd->query('SELECT * FROM patients')->fetchAll();

?><!DOCTYPE html>
<html lang="en">
<head>
    <title>Créer un rendez-vous pour un patient</title>
    <?php include($_SERVER['DOCUMENT_ROOT'] . '/partials/head.php'); ?>
</head>
<body>
<?php include($_SERVER['DOCUMENT_ROOT'].'/partials/header.php'); ?>

<div class="container">
    <!-- Formulaire d'ajout des rendez vous avec 3 inputs -->
    <form action="enregistrement_rdv.php" method="post">
        <select name="idPatients">
            <?php foreach($patients as $patient) : ?>
                <option value="<?=$patient["id"]?>"><?=$patient["lastname"]?> <?=$patient["firstname"]?></option>
            <?php endforeach; ?>
        </select>
        <input type="date" name="date" required>
        <input type="time" name="hour" min="8:00" max="19:00" required>

        <button type="submit" class="btn btn-primary">Valider</button>
    </form>
</div>


<?php include($_SERVER['DOCUMENT_ROOT'].'/partials/footer.php'); ?>

</body>
</html>