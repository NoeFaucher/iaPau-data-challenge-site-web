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

$idProjetData = $_POST["idDataEvent"];


modifProjetData($cnx,$_POST["titreProjetData"], $_POST["descriptProjet"], $idProjetData);

function modifProjetData($mysqlClient, $titreProjetData, $descriptProjet, $idProjetData){
    try {

        $sqlQuery = 'UPDATE ProjetData SET descriptProjet = :descriptProjet, titreProjetData = :titreProjetData WHERE idProjetData = :idProjetData';

        $updateDataEvent = $mysqlClient -> prepare($sqlQuery);
        $updateDataEvent ->execute([
            'descriptProjet' => $descriptProjet,
            'titreProjetData' => $titreProjetData,
            'idProjetData' => $idProjetData,
        ]);
    } catch (Exception $e) {
        die('Erreur : ' . $e->getMessage());
    }
}


header("Location: profil.php#projetdata");
?>