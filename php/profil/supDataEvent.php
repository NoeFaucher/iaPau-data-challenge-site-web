<?php

include "../varSession.inc.php";
include "../verification.php";
include "../bdd.php";

if ($_SESSION["estConnecte"]) {
    if ($_SESSION["typeUtilisateur"] != 'administrateur'){
        header("Location: profil.php");
    }
} else {
    header("Location: ../connexion/connexion.php");
}


$idDataEvent = $_GET["idDataEvent"];

$mysqlClient = connexion($serveur, $bdd, $user, $pass);

if (!empty($idDataEvent)){
    supDataEvent($mysqlClient, $idDataEvent);
}

header("Location: profil.php");



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