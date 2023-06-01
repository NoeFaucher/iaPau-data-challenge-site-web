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


$idDataEvent = $_GET["idDataEvent"];

$mysqlClient = connexion($serveur, $bdd, $user, $pass);

$typeDataEvent = getTypeDataEventById($mysqlClient, $idDataEvent);

$typeDataEvent = $typeDataEvent["typeDataEvent"];


if (!empty($idDataEvent)){
    supDataEvent($mysqlClient, $idDataEvent);
}

$mysqlClient = deconnexion();

if ($typeDataEvent === "DataChallenge") {
    header("Location: profil.php#challenge");
    exit();
} else if ($typeDataEvent === "DataBattle"){
    header("Location: profil.php#battle");
    exit();
} else {
    header("Location: profil.php");
    exit();
}

function supDataEvent($mysqlClient, $idDataEvent){
    try {
        
        $sqlQuery = 'DELETE FROM DataEvent WHERE idDataEvent = :idDataEvent';

        $updateDataEvent = $mysqlClient -> prepare($sqlQuery);
        $updateDataEvent ->execute([
            'idDataEvent' => $idDataEvent,
        ]);
    } catch (Exception $e) {
        die('Erreur : ' . $e->getMessage());
    }
}