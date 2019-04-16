<?php

include '../conexion.php';

$patientId = $_POST['patientId'];

$patientInfobyId = $bdd->prepare("SELECT * FROM patients WHERE id = ?");

$patientInfobyId->execute(array(
    $patientId
));


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