<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>création de patients</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <a href="liste-patient.php">liste des patients</a>
    <br>
    <br>
    
<!-- Formulaire d'ajout des rendez vous avec 5 inputs -->
    <form action="enregistrement_patient.php" method="post">
        <input type="text" placeholder="prénom" name="firstname" required>
        <input type="text" placeholder="nom" name="lastname" required>
        <input type="date" placeholder="date de naissance" name="birthdate" required>
        <input type="text" placeholder="téléphone" name="phone" required>
        <input type="text" placeholder="adresse" name="mail" required>
        <button type="submit"> Valider </button>
    </form>
</body>
</html>