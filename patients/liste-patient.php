<?php
include '../conexion.php';

$reponse = $bdd->query("SELECT * FROM patients");
$patients = $reponse->fetchAll()
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>

<body>

    <a href="ajout-patient.php">Ajouter un patient</a>
    <br>
    <br>
    <?php
    foreach ($patients as $patient) {
        echo " numéro client : " . $patient['id'] . "<br>";
        echo " nom : " . $patient['lastname'] . "<br>";
        echo " prenom : " . $patient['firstname'] . "<br>";
        echo "<br>";
    }
    ?>
    <h3>Selection du Patient pour plus d'informations</h3>
    <form action="profil-patient.php" method="POST">
        <select name="patientId">
           <?php 
            foreach($patients as $patient){
                echo "<option>". $patient['id'] ."</option>";
            }
           ?>
        </select>
        <button>Ok</button>
    </form>
</body>

</html>