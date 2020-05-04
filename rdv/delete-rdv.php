<?php
//connexion à la base de données
require_once($_SERVER['DOCUMENT_ROOT'].'/connexion.php');

//récupération de la date de rendez-vous
$id = $_POST['rdvId'];

//préparation de la requête de suppression
$req = $bdd->prepare("DELETE FROM appointments
                      WHERE id = ?");
//remplacement des ? de la requête SQL par les données récuperé
$req->execute(array($id));

//redirection vers la liste des rendez vous
header('Location: liste-rdv.php');