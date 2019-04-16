<?php

include '../conexion.php';

$rdvId = $_POST['rdvId'];

$rdvInfobyId = $bdd->prepare("SELECT * FROM appointments WHERE id = ?");

$rdvInfobyId->execute(array(
    $rdvId
));


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
  
    <form action="modification_rdv.php" method="POST">

        <input type="datetime" name="date" value="<?php echo $rdv['dateHour']?>" required>
        <input type="hidden" name="rdvId" value="<?php echo $rdv['id']?>">
        <button type="submit">Envoyer</button>
    </form>
</body>
</html>