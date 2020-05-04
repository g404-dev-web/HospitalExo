<?php
//connexion à la base de données

include '../connexion.php';

//récupération des données du patient

$id = $_POST['patientId'];
$lastname = $_POST['lastname'];
$firstname = $_POST['firstname'];
$birthdate = $_POST['birthdate'];
$phone = $_POST['phone'];
$mail = $_POST['mail'];

//préparation de la requête de modification
$req = $bdd->prepare("UPDATE patients
                      SET lastname = ?, firstname = ?, birthdate = ?, phone = ?,
                          mail = ?
                      WHERE id = ?");
//remplacement des ? de la requête SQL par les données récuperé du formulaire
$req->execute(array($lastname, $firstname, $birthdate, $phone, $mail, $id));

//redirection vers la liste des rendez vous
header('Location: liste-patient.php');