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


$titre = valid($_POST["titre"]);
$debut = valid($_POST["debut"]);
$fin = valid($_POST["fin"]);
$description = valid($_POST["description"]);
$donnees = valid($_POST["donnees"]);
$consignes = valid($_POST["consignes"]);
$conseils = valid($_POST["conseils"]);


$idDataEvent = $_POST["idDataEvent"];

$prenom_nom = valid($_POST["gestionnaire"]);

$words = explode(" ", $prenom_nom);

$prenom = $words[0]; // "prenom"
$nom = $words[1]; // "nom"

$mysqlClient = connexion($serveur, $bdd, $user, $pass);



$idGestionnaire = getIdUtilisateurByNom($mysqlClient, $prenom, $nom);


$typeDataEvent = getTypeDataEventById($mysqlClient, $idDataEvent);

$typeDataEvent = $typeDataEvent["typeDataEvent"];

$idGestionnaire = $idGestionnaire["idUtilisateur"];


if (!empty($titre) and !empty($debut) and !empty($fin) and !empty($description) and !empty($donnees) and !empty($consignes) and !empty($conseils) and !empty($idGestionnaire) and !empty($idDataEvent)){

    modifDataEvent($mysqlClient,$debut, $fin, $description , $titre ,$donnees, $consignes ,$conseils ,$idGestionnaire , $idDataEvent);
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


