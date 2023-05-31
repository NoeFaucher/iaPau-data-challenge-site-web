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
$entreprise = valid($_POST["entreprise"]);
$donnees = valid($_POST["donnees"]);
$consignes = valid($_POST["consignes"]);
$conseils = valid($_POST["conseils"]);
$idGestionnaire = valid($_POST["idGestionnaire"]);

$idGestionnaire = 1;

$mysqlClient = connexion($serveur, $bdd, $user, $pass);

if (!empty($titre) and !empty($debut) and !empty($fin) and !empty($description) and !empty($entreprise) and !empty($donnees) and !empty($consignes) and !empty($conseils) and !empty($idGestionnaire) and !empty($idDataEvent)){
    addDataEvent($mysqlClient,$debut, $fin, $description ,$entreprise , $titre ,$donnees, $consignes ,$conseils ,$idGestionnaire);
}

header("Location: profil.php");



function addDataEvent($mysqlClient, $dateDebut, $dateFin, $descript, $entreprise, $titre , $donnees, $consignes, $conseils, $idGestionnaire){
    $date = date('d-m-y h:i:s');
    try {

        $sqlQuery = 'INSERT INTO DataEvent(dateDebut, dateFin , dateCreation , descript , entreprise ,titre , donnees , consignes , conseils , idGestionnaire)  VALUES  (:dateDebut, :dateFin , :dateCreation , :descript , :entreprise ,:titre , :donnees , :consignes , :conseils , :idGestionnaire)';

        $updateDataEvent = $mysqlClient -> prepare($sqlQuery);
        $updateDataEvent ->execute([
            'dateDebut' => $dateDebut,
            'dateFin' => $dateFin,
            'dateCreation' => $date,
            'descript' => $descript,
            'entreprise' => $entreprise,
            'titre' => $titre,
            'donnees' => $donnees,
            'consignes' => $consignes,
            'conseils' => $conseils,
            'idGestionnaire' => $idGestionnaire,
        ]);
    } catch (Exception $e) {
        die('Erreur : ' . $e->getMessage());
    }
}
