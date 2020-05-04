<?php
//connexion à la base de donnée
require_once($_SERVER['DOCUMENT_ROOT'].'/connexion.php');

//récupération des valeurs des inputs du formulaire dans ajout-rendezvous.php
$date = $_POST['date'];
$hour = $_POST['hour'];
$idPatients = $_POST['idPatients'];
//concaténation de la date et de l'heure pour avoir le bon format dans la base de donnée
$dateHour = $date. ' ' .$hour;

if($idPatients === "-1") {
    $idPatients = savePatient($bdd);
}

//préparation de la requête qui insert dans la table appointments, 
//dans les colones dateHour et idPatients, 
//les données récupérées du formulaire
$ajoutrdv = $bdd->prepare(" INSERT INTO appointments(dateHour, idPatients) VALUES(?,?)");

//on remplace les ? de la requête préparé par les variables définies au dessus
$ajoutrdv->execute(array($dateHour, $idPatients));

// une fois tout le code éxecuté, on renvoit vers la page liste-rdv.php
header('location: liste-rdv.php');