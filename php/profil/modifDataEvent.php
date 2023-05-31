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


$titre = valid($_POST["titre"]);
$debut = valid($_POST["debut"]);
$fin = valid($_POST["fin"]);
$description = valid($_POST["description"]);
$donnees = valid($_POST["donnees"]);
$consignes = valid($_POST["consignes"]);
$conseils = valid($_POST["conseils"]);
$idGestionnaire = valid($_POST["idGestionnaire"]);
$idDataEvent = $_POST["idDataEvent"];

$mysqlClient = connexion($serveur, $bdd, $user, $pass);

if (!empty($titre) and !empty($debut) and !empty($fin) and !empty($description) and !empty($donnees) and !empty($consignes) and !empty($conseils) and !empty($idGestionnaire) and !empty($idDataEvent)){
    modifDataEvent($mysqlClient,$debut, $fin, $description , $titre ,$donnees, $consignes ,$conseils ,$idGestionnaire , $idDataEvent);
}

header("Location: profil.php");



function modifDataEvent($mysqlClient, $dateDebut, $dateFin, $descript, $titre , $donnees, $consignes, $conseils, $idGestionnaire, $idDataEvent){
    try {
        
        $sqlQuery = 'UPDATE DataEvent SET dateDebut = :dateDebut, dateFin = :dateFin, descript = :descript, titre = :titre, donnees = :donnees, consignes = :consignes, conseils = :conseils, idGestionnaire = :idGestionnaire WHERE idDataEvent = :idDataEvent';

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


