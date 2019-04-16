<?php

include '../conexion.php';

$rdvHour = $_POST['date'];
$id = $_POST['rdvId'];


$req = $bdd->prepare("UPDATE appointments
                      SET dateHour = ?
                      WHERE id = ?");

$req->execute(array($rdvHour, $id));


header('Location: liste-rdv.php');