<?php
session_start();
include "../php/varSession.inc.php";
include "../php/verification.php";
include "../php/bdd.php";

$email= valid($_POST["email_participant"]);
$mdp = valid($_POST["mot_de_passe_participant"]);

$mysqlClient = connexion($serveur, $bdd, $user, $pass);

var_dump($mysqlClient);

?>