<!DOCTYPE html>
<html lang="fr">
<head>
    <title>création de patients</title>

    <?php include($_SERVER['DOCUMENT_ROOT'].'/partials/head.php'); ?>
</head>
<body>

    <?php include($_SERVER['DOCUMENT_ROOT'].'/partials/header.php'); ?>

    <div class="container">

        <h1>Ajouter un patient</h1>

        <!-- Formulaire d'ajout des rendez vous avec 5 inputs -->
        <form action="enregistrement_patient.php" method="post">
            <input type="text" placeholder="prénom" name="firstname" required>
            <input type="text" placeholder="nom" name="lastname" required>
            <input type="date" placeholder="date de naissance" name="birthdate" required>
            <input type="text" placeholder="téléphone" name="phone" required>
            <input type="text" placeholder="adresse" name="mail" required>
            <button type="submit" class="btn btn-primary"> Valider </button>
        </form>
    </div>

    <?php include($_SERVER['DOCUMENT_ROOT'].'/partials/footer.php'); ?>
</body>
</html>