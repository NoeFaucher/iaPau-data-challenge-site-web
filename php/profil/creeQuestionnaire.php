<?php
include "../varSession.inc.php";
include "../verification.php";
include "../bdd.php";

if ($_SESSION["estConnecte"]) {
    if ($_SESSION["typeUtilisateur"] != 'gestionnaire'){
        header("Location: profil.php");
        exit();
    }
} else {
    header("Location: ../connexion/connexion.php");
    exit();
}

$mysqlClient = connexion($serveur, $bdd, $user, $pass);

$id_titreDataEvent = valid($_POST["id_titreDataEvent"]);
$titre = valid($_POST["titre"]);
$q1 = valid($_POST["q1"]);
$q2 = valid($_POST["q2"]);
$q3 = valid($_POST["q3"]);
$q4 = valid($_POST["q4"]);
$q5 = valid($_POST["q5"]);
if (!isset($q1) || !isset($q2)  || !isset($q3)  || !isset($q4)) {
    //header("Location: profil.php#questionnaire");
    //exit();
}
$intitule = [$q1, $q2, $q3, $q4, $q5];
$words = explode(" ", $id_titreDataEvent);

$idDataEvent = $words[0]; // "idDataEvent"
$titreDataEvent = $words[1]; // "titreDataEvent"

$req = 'SELECT idGestionnaire FROM DataEvent WHERE idDataEvent ='.$idDataEvent.';';

$tab = getAllFromRequest($mysqlClient,$req);

if ($tab[0]["idGestionnaire"] != $_SESSION["idUtilisateur"]){
    header("Location: profil.php#questionnaire");
    exit();
}
addQuestionnaire($mysqlClient, $titre, $idDataEvent);

$idQuestionnaire = getLastInsertId($mysqlClient);
foreach ($intitule as $question) {
    if (isset($question)) {
        addQuestion($mysqlClient, $question, $idQuestionnaire);
    }
}



$mysqlClient = deconnexion();
header("Location: profil.php#questionnaire");

function addQuestionnaire($mysqlClient,$titre,$idDataEvent){
    $dateCreation = date('y-m-d h:i:s');
    try {
        $sqlQuery = 'INSERT INTO Questionnaire (titre, idDataEvent, dateCreation)  VALUES  (:titre, :idDataEvent, :dateCreation)';

        $updateDataEvent = $mysqlClient -> prepare($sqlQuery);
        $updateDataEvent ->execute([
            'titre' => $titre,
            'idDataEvent' => $idDataEvent,
            'dateCreation' => $dateCreation,
        ]);

    } catch (Exception $e) {
        die('Erreur : ' . $e->getMessage());
    }
}

function addQuestion($mysqlClient, $intitule, $idQuestionnaire){
    try {
        $sqlQuery = 'INSERT INTO Question (intitule, idQuestionnaire)  VALUES  (:intitule, :idQuestionnaire)';

        $updateDataEvent = $mysqlClient -> prepare($sqlQuery);
        $updateDataEvent ->execute([
            'intitule' => $intitule,
            'idQuestionnaire' => $idQuestionnaire,
        ]);

    } catch (Exception $e) {
        die('Erreur : ' . $e->getMessage());
    }
}
?>