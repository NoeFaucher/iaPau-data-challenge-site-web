<?php

    session_start();
    include("../bdd.php");
    include("varSession.inc.php");

    // traitement du code par Noé

    // récupération de chacune des données à insérer
    $dateJour = date('Y-m-d H:i:s');
    $lienRendu = $_POST["lien_code_gitlab"];
    $resultatJson = "resultat.json"; // variable temporaire
    $idEquipe = $_SESSION["idEquipeUtilisateurPage"];

    // requ$ete SQL pour ajouter un nouveau rendu dans la BDD
    $conn = connexion($serveur, $bdd, $user, $pass);
    $requeteAjoutRendu = "INSERT INTO Rendu (dateRendu, lienRendu, resultatJson, idEquipe) VALUES ('".$dateJour."', '".$lienRendu."', '".$resultatJson."', ".$idEquipe.");";
    setFromRequest($conn, $requeteAjoutRendu);
    $conn = deconnexion();

    // redirection vers la page d'avant
    header("Location: data-event.php?idDataEvent=".$_SESSION["idDataEventPage"]);
    exit();
    
?>