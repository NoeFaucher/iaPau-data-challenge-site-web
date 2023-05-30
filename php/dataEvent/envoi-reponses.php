<?php

    session_start();
    include("../bdd.php");
    include("varSession.inc.php");

    // récupération des 4 ou 5 réponses
    $tableauReponses = array();
    for ($i = 1; $i <= 5; $i++) {
        $nomVar = "question" . $i;
        if (isset($_POST[$nomVar])) {
            array_push($tableauReponses, $_POST[$nomVar]);
        }
    }

    // requ$ete SQL pour ajouter un nouveau rendu dans la BDD
    $conn = connexion($serveur, $bdd, $user, $pass);
    $requeteAjoutReponse = "INSERT INTO Reponse (note, reponse, idEquipe, idQuestion) VALUES ";
    for ($i=0; $i<count($_SESSION["questionsDataBattlePage"]); $i++) {
        $requeteAjoutReponse .= "(FLOOR(RAND() * 2), \"".$tableauReponses[$i]."\", ".$_SESSION["idEquipeUtilisateurPage"].", ".$_SESSION["questionsDataBattlePage"][$i]["idQuestion"].")";
        if ($i != count($_SESSION["questionsDataBattlePage"])-1) {
            $requeteAjoutReponse .= ", ";
        }
    }
    $requeteAjoutReponse .= ";";

    echo $requeteAjoutReponse;
    setFromRequest($conn, $requeteAjoutReponse);
    $conn = deconnexion();

    // redirection vers la page d'avant
    header("Location: data-event.php?idDataEvent=".$_SESSION["idDataEventPage"]);
    exit();

?>