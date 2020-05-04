<?php
//connexion à la base de données
require_once($_SERVER['DOCUMENT_ROOT'].'/connexion.php');
//récupération du numéro id du patient
$patientId = $_REQUEST['patientId'];

// Préparation de la requête de récupération pars numéro id 
$patientInfobyId = $bdd->prepare("  SELECT * FROM patients 
                                    WHERE id = ?");

//remplacement des ? de la requête SQL par les données récuperé du formulaire
$patientInfobyId->execute(array(
    $patientId
));

// Préparation de la requête de récupération des rendez vous 
//pour le client avec l'id contenu dans $patientId
$patientAppointments = $bdd->prepare("  SELECT * FROM appointments 
                                        WHERE idPatients = ?");

//remplacement des ? de la requête SQL 
$patientAppointments->execute(array(
    $patientId
));

//récupération des données de la requête (une seul réponse)
$patient = $patientInfobyId->fetch();
//récupération des données de la requête (toutes les réponses)
$appointments = $patientAppointments->fetchAll();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Profil du patient <?=$patient['lastname']?> <?=$patient['firstname']?></title>
    <?php include($_SERVER['DOCUMENT_ROOT'] . '/partials/head.php'); ?>
</head>
<body>

<?php include($_SERVER['DOCUMENT_ROOT'].'/partials/header.php'); ?>

<div class="container">

    <h1>Profil du patient <?=$patient['lastname']?> <?=$patient['firstname']?></h1>
    <!-- affichage des infos du patient -->
    <ul>
        <li>Nom : <?php echo $patient['lastname']?></li>
        <li>Prénom : <?php echo $patient['firstname']?></li>
        <li>Date de naissance : <?php echo $patient['birthdate']?></li>
        <li>Tél : <?php echo $patient['phone']?></li>
        <li>e-Mail : <?php echo $patient['mail']?></li>
    </ul>
    <h4>Liste des rendez vous :</h4>
    <?php
    //affichage de tous les rendez vous du patient
    foreach ($appointments as $appointment) {
        echo "<p>ce patient à rendez vous le : ".$appointment["dateHour"] ."</p>";
    }
    ?>

    <!-- formulaire de modification qui contient en valeur les données existantes en base de donnée -->

    <h3>Modifier le patient</h3>
    <form action="modification-patient.php" method="POST">
        <input type="text" name="lastname" value="<?php echo $patient['lastname']?>" required>
        <input type="text" name="firstname" value="<?php echo $patient['firstname']?>" required>
        <input type="date" name="birthdate" value="<?php echo $patient['birthdate']?>" required>
        <input type="text" name="phone" value="<?php echo $patient['phone']?>" required>
        <input type="text" name="mail" value="<?php echo $patient['mail']?>" required>
        <input type="hidden" name="patientId" value="<?php echo $patient['id']?>">
        <br>
        <button type="submit" class="btn btn-primary">Envoyer</button>
    </form>
</div>
<br><br><br>

</body>
</html>