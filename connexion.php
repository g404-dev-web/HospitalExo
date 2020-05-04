<?php
// connexion à la base de données hospitalE2N
try
{
    $bdd = new PDO('mysql:host=127.0.0.1;dbname=hospitalE2N','root','');
    $bdd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
}
catch (Exception $e)
{
    die('Erreur : ' . $e->getMessage());
}

/** @var PDO $bdd */
function savePatient(PDO $bdd)
{
    //récupération des valeurs des inputs du formulaire dans ajout-patient.php
    $lastname = $_POST['lastname'];
    $firstname = $_POST['firstname'];
    $birthdate = $_POST['birthdate'];
    $phone = $_POST['phone'];
    $mail = $_POST['mail'];

    // requête en code 'brut' SQL
    // $bdd->exec("INSERT INTO patients(lastname, firstname, birthdate, phone, mail)
    //             VALUES('".$lastname."', '".$firstname."','".$birthdate."','". $phone ."','". $mail ."') ");


    //Requête préparée qui insère dans la table appointments,
    //dans les colones dateHour et idPatients,
    //les données récupérées du formulaire
    $insertPatient = $bdd->prepare(" INSERT INTO patients(lastname, firstname, birthdate, phone, mail) 
                                VALUES(?,?,?,?,?)");

    //on remplace les ? de la requête préparé par les variables définies au dessus
    $insertPatient->execute([
        $lastname,
        $firstname,
        $birthdate,
        $phone,
        $mail
    ]);

    $patientId = $bdd->query('SELECT id FROM patients ORDER BY id DESC LIMIT 1')->fetchColumn();

    return $patientId;
}