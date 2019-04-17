<?php

//connexion à la base de donnée
include '../conexion.php';

//requête de sélection de tous les patients
$reponse = $bdd->query("SELECT * FROM patients");
//récupération des données de la requête
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
    //boucle d'affichage des patients
    foreach ($patients as $patient) {
        echo " numéro client : " . $patient['id'] . "<br>";
        echo " nom : " . $patient['lastname'] . "<br>";
        echo " prenom : " . $patient['firstname'] . "<br>";
        echo    "<form action='delete-patient.php' method='post'>
        <input type='hidden' name='patientId' value=".$patient['id'].">
        <button type='submit'>Supprimer ce patient</button>
        
        </form>";
        echo "<br>";
    }
    ?>
    <h3>Selection du Patient pour plus d'informations</h3>
    <form action="profil-patient.php" method="POST">
        <select name="patientId">
           <?php 
            //boucle qui affiche une liste d'option pour chaque id patients
            foreach($patients as $patient){
                echo "<option>". $patient['id'] ."</option>";
            }
           ?>
        </select>
        <button>Ok</button>
    </form>
</body>

</html>