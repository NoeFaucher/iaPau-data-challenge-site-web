<?php

    session_start();
    include("../bdd.php");
    include("../varSession.inc.php");

    $nomEquipeVoulu = $_POST["nomEquipe"];
    $equipeExiste = false;

    // connexion à la base de données
    $conn = connexion($serveur, $bdd, $user, $pass);

    // récupération de tous les noms d'équipe
    $requeteNomsEquipes = "SELECT nomEquipe FROM Equipe;";
    $resultatNomsEquipes = getAllFromRequest($conn, $requeteNomsEquipes);

    // on regarde : 
    //    - si une autre équipe possède déjà ce nom (en prenant les majuscules en compte)
    //    - si le nom de l'équipe est vide ou rempli d'espaces
    $tableauNomsEquipes = array();
    foreach ($resultatNomsEquipes as $equipe) {
        if ((strtolower($nomEquipeVoulu) == strtolower($equipe["nomEquipe"])) && ($nomEquipeVoulu != "")) {
            $equipeExiste = true;
        }
    }

    if ($equipeExiste) {
        echo "existe";
    } 
    else {
        echo "existe_pas";
    }
      
    // déconnexion de la base de données
    $conn = deconnexion();

?>