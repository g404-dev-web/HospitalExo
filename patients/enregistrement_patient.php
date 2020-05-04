<?php

//connexion à la base de donnée
require_once($_SERVER['DOCUMENT_ROOT'].'/connexion.php');

savePatient($bdd);

// une fois tout le code éxecuté, on renvoit vers la page liste-rdv.php
header('Location: liste-patients.php');