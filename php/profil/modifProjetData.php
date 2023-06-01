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

function modifDataEvent($mysqlClient, $dateDebut, $dateFin, $descript, $titre , $donnees, $consignes, $conseils, $idGestionnaire, $idDataEvent){
    try {

        $sqlQuery = 'UPDATE ProjetData SET dateDebut = :dateDebut, dateFin = :dateFin, descript = :descript, titre = :titre, donnees = :donnees, consignes = :consignes, conseils = :conseils, idGestionnaire = :idGestionnaire WHERE idDataEvent = :idDataEvent';

        $updateDataEvent = $mysqlClient -> prepare($sqlQuery);
        $updateDataEvent ->execute([
            'dateDebut' => $dateDebut,
            'dateFin' => $dateFin,
            'descript' => $descript,
            'titre' => $titre,
            'donnees' => $donnees,
            'consignes' => $consignes,
            'conseils' => $conseils,
            'idGestionnaire' => $idGestionnaire,
            'idDataEvent' => $idDataEvent,
        ]);
    } catch (Exception $e) {
        die('Erreur : ' . $e->getMessage());
    }
}


?>