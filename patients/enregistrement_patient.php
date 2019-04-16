<?php
include '../conexion.php';

$lastname = $_POST['lastname'];
$firstname = $_POST['firstname'];
$birthdate = $_POST['birthdate'];
$phone = $_POST['phone'];
$mail = $_POST['mail'];

// $bdd->exec("INSERT INTO patients(lastname, firstname, birthdate, phone, mail) 
//             VALUES(".$lastname.", ".$firstname.",'".$birthdate."') ");

$insertclient = $bdd->prepare(" INSERT INTO patients(lastname, firstname, birthdate, phone, mail) 
                                VALUES(?,?,?,?,?)");

$insertclient->execute(array(   $lastname, 
                                $firstname, 
                                $birthdate, 
                                $phone, 
                                $mail));

header('Location: liste-patient.php');