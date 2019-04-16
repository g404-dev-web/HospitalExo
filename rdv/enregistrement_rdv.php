<?php

include '../conexion.php';

$date = $_POST['date'];
$hour = $_POST['hour'];
$idPatients = $_POST['idPatients'];
$dateHour = $date. ' ' .$hour;


$ajoutrdv = $bdd->prepare(" INSERT INTO appointments(dateHour, idPatients) 
                                VALUES(?,?)");

$ajoutrdv->execute(array($dateHour, $idPatients));

header('location: liste-rdv.php');