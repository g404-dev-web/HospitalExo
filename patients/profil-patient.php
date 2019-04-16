<?php
//connexion à la base de données
include '../conexion.php';
//récupération du numéro id du patient
$patientId = $_POST['patientId'];

// Préparation de la requête de récupération pars numéro id 
$patientInfobyId = $bdd->prepare("SELECT * FROM patients WHERE id = ?");

//remplacement des ? de la requête SQL par les données récuperé du formulaire
$patientInfobyId->execute(array(
    $patientId
));

//récupération des données de la requête (une seul réponse)
$patient = $patientInfobyId->fetch();


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
    <ul>
        <li>Nom : <?php echo $patient['lastname']?></li>
        <li>Prénom : <?php echo $patient['firstname']?></li>
        <li>Date de naissance : <?php echo $patient['birthdate']?></li>
        <li>Tél : <?php echo $patient['phone']?></li>
        <li>e-Mail : <?php echo $patient['mail']?></li>
    </ul>
  <!-- formulaire de modification qui contient en valeur les données existantes en base de donnée -->

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