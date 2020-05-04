<?php
//connexion à la base de données
require_once($_SERVER['DOCUMENT_ROOT'].'/connexion.php');


//préparation de la requête de modification
$req = $bdd->prepare("UPDATE appointments
                      SET dateHour = ?
                      WHERE id = ?");

//remplacement des ? de la requête SQL par les données récuperé du formulaire
$req->execute(array($_POST['date'], $_POST['id']));

//redirection vers la liste des rendez vous
header('Location: liste-rdv.php');