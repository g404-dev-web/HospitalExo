<?php
//connexion à la base de données
include '../conexion.php';

//récupération de la date de rendez-vous
$id = $_POST['patientId'];

//préparation de la requête de suppression du patient
$req = $bdd->prepare("  DELETE FROM patients 
                        WHERE id = ?");
//remplacement des ? de la requête SQL par les données récuperé
$test = $req->execute(array($id));

//préparation de la requête de suppression du rdv
$req = $bdd->prepare("  DELETE FROM appointments 
                        WHERE idPatients = ?");
//remplacement des ? de la requête SQL par les données récuperé
$test = $req->execute(array($id));

//redirection vers la liste des rendez vous
header('Location: liste-patient.php');