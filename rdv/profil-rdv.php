<?php
//connexion à la base de données
include '../conexion.php';
//récupération du numéro id du rendez vous
$rdvId = $_POST['rdvId'];

// Préparation de la requête de récupération pars numéro id 
$rdvInfobyId = $bdd->prepare("SELECT * FROM appointments WHERE id = ?");

//remplacement des ? de la requête SQL par les données récuperé du formulaire
$rdvInfobyId->execute(array($rdvId));

//récupération des données de la requête (une seul réponse)
$rdv = $rdvInfobyId->fetch();

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
  <!-- formulaire de modification qui contient en valeur les données existantes en base de donnée -->
    <form action="modification_rdv.php" method="POST">

        <input type="datetime" name="date" value="<?php echo $rdv['dateHour']?>" required>
        <input type="hidden" name="rdvId" value="<?php echo $rdv['id']?>">
        <button type="submit">Envoyer</button>
    </form>
</body>
</html>