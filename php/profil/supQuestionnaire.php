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

$idQuestionnaire = $_GET["idQuestionnaire"];

supQuestionnaire($mysqlClient, $idQuestionnaire);

$mysqlClient = deconnexion();

header("Location: profil.php#questionnaire");

function supQuestionnaire($mysqlClient, $idQuestionnaire){
    try {
        $sqlQuery = 'DELETE FROM Questionnaire WHERE idQuestionnaire = :idQuestionnaire';
        $updateDataEvent = $mysqlClient -> prepare($sqlQuery);
        $updateDataEvent ->execute([
            'idQuestionnaire' => $idQuestionnaire,
        ]);
    } catch (Exception $e) {
        die('Erreur : ' . $e->getMessage());
    }
}
