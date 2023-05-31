<?php

    session_start();
    include("../bdd.php");
    include("varSession.inc.php");   

    // récupération de chacune des données à insérer
    $nomEquipe = $_POST["nom_equipe"];
    $idProjetData = $_SESSION["idProjetData"];
    $idChefEquipe = $_SESSION["idUtilisateur"];
    $listeEtudiantsEquipe = $_POST["tableauEtudiants"];

    // connexion à la base de données
    $conn = connexion($serveur, $bdd, $user, $pass);

    // requête SQL pour ajouter un nouveau rendu dans la base de données
    $requeteAjoutEquipe = "INSERT INTO Equipe (nomEquipe, idProjetData, idChefEquipe) VALUES (\"".$nomEquipe."\", ".$idProjetData.", ".$idChefEquipe.");";
    setFromRequest($conn, $requeteAjoutEquipe);

    // récupération de l'identifiant de l'équipe
    $requeteIdEquipe = "SELECT idEquipe FROM Equipe WHERE idProjetData=".$idProjetData." AND idChefEquipe=".$idChefEquipe.";";
    $resultatIdEquipe = getAllFromRequest($conn, $requeteIdEquipe)[0]["idEquipe"];

    // ajout des membres dans l'équipe
    $requeteAjoutMembresEquipe = "INSERT INTO UtilisateurAppartientEquipe (idUtilisateur, idEquipe) VALUES (".$idChefEquipe.", ".$resultatIdEquipe."), ";
    for ($i=0; $i<count($listeEtudiantsEquipe); $i++) {
        if ($i != count($listeEtudiantsEquipe)-1) {
            $requeteAjoutMembresEquipe .= "(".$listeEtudiantsEquipe[$i].", ".$resultatIdEquipe."), ";
        }
        else {
            $requeteAjoutMembresEquipe .= "(".$listeEtudiantsEquipe[$i].", ".$resultatIdEquipe.");";
        }
    }
    echo $requeteAjoutMembresEquipe;
    setFromRequest($conn, $requeteAjoutMembresEquipe);

    // requête SQL pour retrouver le data event et rediriger l'utilisateur vers la page
    $requeteDataEvent = "SELECT idDataEvent FROM ProjetData WHERE idProjetData=".$idProjetData.";";
    $resultatDataEvent = getAllFromRequest($conn, $requeteDataEvent)[0]["idDataEvent"];

    // déconnexion de la base de données
    $conn = deconnexion();

    // redirection vers la page d'avant
    header("Location: data-event.php?idDataEvent=".$resultatDataEvent);
    exit();

?>