<?php
//connexion à la base de donnée
include '../conexion.php';

//récupération des valeurs des inputs du formulaire dans ajout-patient.php
$lastname = $_POST['lastname'];
$firstname = $_POST['firstname'];
$birthdate = $_POST['birthdate'];
$phone = $_POST['phone'];
$mail = $_POST['mail'];

// requête en code 'brut' SQL
// $bdd->exec("INSERT INTO patients(lastname, firstname, birthdate, phone, mail) 
//             VALUES('".$lastname."', '".$firstname."','".$birthdate."','". $phone ."','". $mail ."') ");


//préparation de la requête qui insert dans la table appointments, 
//dans les colones dateHour et idPatients, 
//les données récupérées du formulaire
$insertclient = $bdd->prepare(" INSERT INTO patients(lastname, firstname, birthdate, phone, mail) 
                                VALUES(?,?,?,?,?)");

//on remplace les ? de la requête préparé par les variables définies au dessus
$insertclient->execute(array(   $lastname, 
                                $firstname, 
                                $birthdate, 
                                $phone, 
                                $mail));

// une fois tout le code éxecuté, on renvoit vers la page liste-rdv.php
header('Location: liste-patient.php');