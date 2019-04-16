<?php

include '../conexion.php';

$reponse = $bdd->query('SELECT * FROM patients
                        INNER JOIN appointments
                        WHERE patients.id = appointments.idPatients');

$appointments = $reponse->fetchAll();

foreach($appointments as $appointment){
    echo "<br>".$appointment['id']; 
    echo "<br>".$appointment['dateHour']; 
    echo "<br>". $appointment['lastname']."<br>";
}
?>
<br>
<h3>Selection d'un rdv pour plus d'informations</h3>

<form action="profil-rdv.php" method="POST">
    <select name="rdvId">
        <?php 
        foreach($appointments as $appointment){
            echo "<option>". $appointment['id'] ."</option>";
        }
        ?>
    </select>
    <button>Ok</button>
</form>