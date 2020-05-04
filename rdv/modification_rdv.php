<?php
//connexion à la base de données
include '../connexion.php';

//récupération de la date de rendez-vous
$rdvHour = $_POST['date'];
$id = $_POST['rdvId'];

//préparation de la requête de modification
$req = $bdd->prepare("UPDATE appointments
                      SET dateHour = ?
                      WHERE id = ?");
//remplacement des ? de la requête SQL par les données récuperé du formulaire
$req->execute(array($rdvHour, $id));

//redirection vers la liste des rendez vous
header('Location: liste-rdv.php');