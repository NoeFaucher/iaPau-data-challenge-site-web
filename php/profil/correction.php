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

$idQuestionnaire = $_POST["idQuestionnaire"];
$nomEquipe = $_POST["nomEquipe"];

if ($nomEquipe == ""){
    header("Location: correcQuestionnaire.php?idQuestionnaire=".$idQuestionnaire);
    exit();
}


$reqReponse = 'SELECT Reponse.idReponse
                FROM Question JOIN Reponse ON Question.idQuestion = Reponse.idQuestion
                JOIN Questionnaire ON Questionnaire.idQuestionnaire = Question.idQuestionnaire
                JOIN ProjetData ON ProjetData.idDataEvent = Questionnaire.idDataEvent
                JOIN Equipe ON Equipe.idProjetData = ProjetData.idProjetData
                WHERE Questionnaire.idQuestionnaire = '.$idQuestionnaire.' AND Equipe.nomEquipe = "'.$nomEquipe.'";';
                

$mysqlClient = connexion($serveur, $bdd, $user, $pass);

$tabReponse = getAllFromRequest($mysqlClient, $reqReponse);

foreach($tabReponse as $reponse) {
    $idRep = "reponse-".$reponse["idReponse"];
    $VFrep = $_POST[$idRep];
    correction($mysqlClient, $VFrep, $reponse["idReponse"]);
}

$mysqlClient = deconnexion();

header("Location: profil.php#questionnaire");
exit();

function correction($mysqlClient, $note, $idReponse) {
    try {

        $sqlQuery = 'UPDATE Reponse SET note = :note WHERE idReponse = :idReponse';
        $updateCorrection = $mysqlClient -> prepare($sqlQuery);
        $updateCorrection ->execute([
            'note' => $note,
            'idReponse' => $idReponse,
        ]);
    } catch (Exception $e) {
        die('Erreur : ' . $e->getMessage());
    }
}

?>
