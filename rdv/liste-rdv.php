<?php

//connexion à la base de donnée
require_once($_SERVER['DOCUMENT_ROOT'].'/connexion.php');

//Préparation de la requête avec jointure de table par l'id patients
$reponse = $bdd->query('SELECT * FROM patients
                        INNER JOIN appointments
                        WHERE patients.id = appointments.idPatients');
//récupération des données de la requête
$appointments = $reponse->fetchAll();
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
        echo "<a href='details-rdv.php?id=".$appointment['id']."' class='btn btn-primary'>Détails</a>";
    }
    ?>

    <br>
</div>

<?php include($_SERVER['DOCUMENT_ROOT'].'/partials/footer.php'); ?>
</body>
</html>