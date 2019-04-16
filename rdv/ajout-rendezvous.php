<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>rdv</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" media="screen" href="main.css">
    <script src="main.js"></script>
</head>
<body>

    <a href="liste-rdv.php"> liste des RDV</a>
    <form action="enregistrement_rdv.php" method="post">
        <input type="date" name="date" required>
        <input type="time" name="hour" min="8:00" max="19:00" required>
        <input type="text" name="idPatients" required>
        <button type="submit">pousse</button>
    </form>  
</body>
</html>