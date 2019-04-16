<?php

include '../conexion.php';


$id = $_POST['patientId'];
$lastname = $_POST['lastname'];
$firstname = $_POST['firstname'];
$birthdate = $_POST['birthdate'];
$phone = $_POST['phone'];
$mail = $_POST['mail'];

$req = $bdd->prepare("UPDATE patients
                      SET lastname = ?, firstname = ?, birthdate = ?, phone = ?,
                          mail = ?
                      WHERE id = ?");

$req->execute(array($lastname, $firstname, $birthdate, $phone, $mail, $id));


header('Location: liste-patient.php');