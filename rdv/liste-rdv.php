<?php

//connexion à la base de donnée
include '../connexion.php';

//Préparation de la requête avec jointure de table par l'id patients
$reponse = $bdd->query('SELECT * FROM patients
                        INNER JOIN appointments
                        WHERE patients.id = appointments.idPatients');
//récupération des données de la requête
$appointments = $reponse->fetchAll();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>création de patients</title>

    <?php include($_SERVER['DOCUMENT_ROOT'].'/partials/head.php'); ?>
</head>
<body>

<?php include($_SERVER['DOCUMENT_ROOT'].'/partials/header.php'); ?>

<div class="container">
    <?php

    //boucle d'affichage des rendez vous
    foreach($appointments as $appointment){
        echo "<br>".$appointment['id'];
        echo "<br>".$appointment['dateHour'];
        echo "<br>Patient : ". $appointment['lastname']." ". $appointment['firstname']."<br>";
        echo    "<form action='delete-rdv.php' method='post'>
                <input type='hidden' name='rdvId' value=".$appointment['id'].">
                <button type='submit'>Supprimer ce rdv</button>
                
                </form>";
    }
    ?>

    <br>
</div>

<?php include($_SERVER['DOCUMENT_ROOT'].'/partials/footer.php'); ?>
</body>
</html>