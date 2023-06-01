<?php

include "../varSession.inc.php";
include "../verification.php";
include "../bdd.php";

if ($_SESSION["estConnecte"]) {
    if ($_SESSION["typeUtilisateur"] != 'administrateur'){
        header("Location: profil.php");
        exit();
    }
} else {
    header("Location: ../connexion/connexion.php");
    exit();
}

$cnx = connexion($serveur, $bdd, $user, $pass);

$reqidEvent = "SELECT idDataEvent from DataEvent where titre='".$_POST["titre"]."';";

$residEvent = getAllFromRequest($cnx, $reqidEvent);

$idDataEvent = $residEvent[0]["idDataEvent"];


$req = "INSERT INTO ProjetData (idDataEvent, titreProjetData, descriptProjet, idImage) 
        VALUES (".$idDataEvent.",'".$_POST["titreProjetData"]."','".$_POST["descriptProjet"]."',1);";


setFromRequest($cnx, $req);

header("Location: profil.php#projetdata");














?>