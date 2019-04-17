<?php
//connexion à la base de données
include '../conexion.php';
//récupération du numéro id du patient
$patientId = $_POST['patientId'];

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
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="style.css">
    <title>Document</title>
</head>
<body>
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
        <button type="submit">Envoyer</button>
    </form>
</body>
</html>