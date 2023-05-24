<?php
session_start();
$_SESSION["POST"] = NULL;
$_SESSION["estConnecte"] = false;
$_SESSION["idUtilisateur"] = NULL;
$_SESSION["email"] = NULL;
$_SESSION["typeUtilisateur"] = NULL;
$_SESSION["nom"] = NULL;
$_SESSION["prenom"] = NULL;
header("Location: ../../index.php")
?>
