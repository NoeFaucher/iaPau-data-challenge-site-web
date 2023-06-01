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
$entreprise = valid($_POST["entreprise"]);
$donnees = valid($_POST["donnees"]);
$consignes = valid($_POST["consignes"]);
$conseils = valid($_POST["conseils"]);
$prenom_nom = valid($_POST["gestionnaire"]);

$typeDataEvent = $_POST["typeDataEvent"];

$words = explode(" ", $prenom_nom);

$prenom = $words[0]; // "prenom"
$nom = $words[1]; // "nom"


$mysqlClient = connexion($serveur, $bdd, $user, $pass);

$idGestionnaire = getIdUtilisateurByNom($mysqlClient, $prenom, $nom);

$idGestionnaire = $idGestionnaire["idUtilisateur"];

$fin = $fin . " 23:59:59";
if (!empty($titre) and !empty($debut) and !empty($fin) and !empty($description) and !empty($entreprise) and !empty($donnees) and !empty($consignes) and !empty($conseils) and !empty($idGestionnaire)){
    addDataEvent($mysqlClient, $typeDataEvent, $debut, $fin, $description ,$entreprise , $titre ,$donnees, $consignes ,$conseils ,$idGestionnaire);
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


function addDataEvent($mysqlClient, $typeDataEvent, $dateDebut, $dateFin, $descript, $entreprise, $titre , $donnees, $consignes, $conseils, $idGestionnaire){
    $date = date('y-m-d h:i:s');
    try {

        $sqlQuery = 'INSERT INTO DataEvent(typeDataEvent, dateDebut, dateFin , dateCreation , descript , entreprise ,titre , donnees , consignes , conseils , idGestionnaire)  VALUES  (:typeDataEvent, :dateDebut, :dateFin , :dateCreation , :descript , :entreprise ,:titre , :donnees , :consignes , :conseils , :idGestionnaire)';

        $updateDataEvent = $mysqlClient -> prepare($sqlQuery);
        $updateDataEvent ->execute([
            'typeDataEvent' => $typeDataEvent,
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
