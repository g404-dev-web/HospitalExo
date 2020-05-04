<?php


//connexion à la base de données
require_once($_SERVER['DOCUMENT_ROOT'].'/connexion.php');

$appointmentStatement = $bdd->prepare(
    'SELECT * FROM appointments INNER JOIN patients ON patients.id = appointments.idPatients WHERE appointments.id = ? '
);

$appointmentStatement->execute([$_GET["id"]]);

$appointment = $appointmentStatement->fetch(PDO::FETCH_ASSOC);

//echo "<pre>";
//var_dump($appointment["dateHour"]);exit;

$dateHourExploded = explode(' ', $appointment["dateHour"]);
//print_r($dateHourExploded);exit;
$date = $dateHourExploded[0];
$hour = $dateHourExploded[1];

$patients = $bdd->query('SELECT * FROM patients')->fetchAll();
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <title>création de patients</title>

    <?php include($_SERVER['DOCUMENT_ROOT'].'/partials/head.php'); ?>
</head>
<body>

<?php include($_SERVER['DOCUMENT_ROOT'].'/partials/header.php'); ?>

<div class="container">
    <h1>Détails du RDV de <?=$appointment['lastname']." ". $appointment['firstname']?> </h1>

    <br><?=$appointment['id']?>
    <br><?=$appointment['dateHour']?>
    <br>Patient : <?=$appointment['lastname']?> <?=$appointment['firstname']?><br>
    <br>

    <h1>Modification du rdv</h1>

    <form action="modification_rdv.php" method="post">
        <input type="hidden" name="id" value="<?=$appointment['id']?>">

        <select name="idPatients" onchange="checkNewPatient(event)">
            <option></option>
            <option value="-1">Nouveau patient</option>
            <?php foreach($patients as $patient) : ?>
                <option value="<?=$patient["id"]?>" <?=$patient["id"]===$appointment["idPatients"]?'selected':''?>>
                    <?=$patient["lastname"]?> <?=$patient["firstname"]?>
                </option>
            <?php endforeach; ?>
        </select>
        <input type="date" name="date" value="<?=$date?>" required>
        <input type="time" name="hour" min="8:00" max="19:00" value="<?=$hour?>" required>

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