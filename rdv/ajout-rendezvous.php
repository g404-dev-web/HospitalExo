<?php

require_once($_SERVER['DOCUMENT_ROOT'].'/connexion.php');
$patients = $bdd->query('SELECT * FROM patients')->fetchAll();

?><!DOCTYPE html>
<html lang="fr">
<head>
    <title>Créer un rendez-vous pour un patient</title>
    <?php include($_SERVER['DOCUMENT_ROOT'] . '/partials/head.php'); ?>
</head>
<body>
<?php include($_SERVER['DOCUMENT_ROOT'].'/partials/header.php'); ?>

<div class="container">
    <!-- Formulaire d'ajout des rendez vous avec 3 inputs -->
    <form action="enregistrement_rdv.php" method="post">
        <select name="idPatients" onchange="checkNewPatient(event)">
            <option></option>
            <option value="-1">Nouveau patient</option>
            <?php foreach($patients as $patient) : ?>
                <option value="<?=$patient["id"]?>"><?=$patient["lastname"]?> <?=$patient["firstname"]?></option>
            <?php endforeach; ?>
        </select>
        <input type="date" name="date" required>
        <input type="time" name="hour" min="8:00" max="19:00" required>

        <div id="newPatient" style="display:none">
            <h5>Nouveau patient : </h5>
            <input type="text" placeholder="prénom" name="firstname">
            <input type="text" placeholder="nom" name="lastname">
            <input type="date" placeholder="date de naissance" name="birthdate">
            <input type="text" placeholder="téléphone" name="phone">
            <input type="text" placeholder="adresse" name="mail">
        </div>

        <button type="submit" class="btn btn-primary">Valider</button>
    </form>
</div>


<?php include($_SERVER['DOCUMENT_ROOT'].'/partials/footer.php'); ?>
<script>
    function checkNewPatient(event) {
        document.querySelector('#newPatient').style.display = event.target.value === '-1' ? "block" : "none";
    }
</script>

</body>
</html>