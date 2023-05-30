<?php

    session_start();
    include("../php/bdd.php");

    // variables temporaires
    $_SESSION["estConnecte"] = true; // partie de Marc-Antoine
    $_SESSION["idUtilisateur"] = 2; // partie de Marc-Antoine
    $_SESSION["typeUtilisateur"] = "etudiant"; // partie de Marc-Antoine
    if ($_SESSION["typeUtilisateur"] == "etudiant") {
        $_SESSION["inscrit"] = false; // faire la requête lorsque la BDD sera refaite
    }
    $loremIpsum = "Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.";

    // récupération de l'id du data event
    $idDataEvent = $_GET["idDataEvent"];

    // connexion
    $conn = connexion($serveur, $bdd, $user, $pass);

    // récupération des informations liées au data event voulu
    $requeteDataEvent = "SELECT * FROM DataEvent WHERE idDataEvent=".$idDataEvent.";";
    $resultatDataEvent = getAllFromRequest($conn, $requeteDataEvent)[0]; // on peut mettre "[0]" car il n'y en aura toujours qu'un seul
    $_SESSION["typeDataEvent"] = $resultatDataEvent["typeDataEvent"];

    // récupération des utilisateurs inscrits au data challenge
    /* ---------- À FAIRE ---------- */
    $requeteInscrits = "SELECT * FROM Table;";
    /* ----------------------------- */

    // récupération des chefs d'équipe pour voir si l'utilisateur en est un
    $requeteChefsEquipe = "SELECT idChefEquipe FROM Equipe WHERE idChefEquipe=".$_SESSION["idUtilisateur"].";";
    $resultatChefsEquipe = getAllFromRequest($conn, $requeteChefsEquipe);
    if (!empty($resultatChefsEquipe)) {
        $_SESSION["chefEquipe"] = true;
    }
    else {
        $_SESSION["chefEquipe"] = false;
    }
    
    // récupération des projets data associés au data battle/challenge
    $requeteProjetsData = "SELECT * FROM ProjetData WHERE idDataEvent=".$idDataEvent.";";
    $resultatProjetsData = getAllFromRequest($conn, $requeteProjetsData);

    // récupération du classement pour le podium (que les trois premières équipes)
    $requeteScoresEquipes = "SELECT nomEquipe, SUM(note) AS score FROM Reponse NATURAL JOIN Equipe GROUP BY idEquipe ORDER BY score DESC LIMIT 3;";
    $resultatScoresEquipes = getAllFromRequest($conn, $requeteScoresEquipes);

    // déconnexion
    $conn = deconnexion();

?>

<!-- 
Récapitualif des droits : 
    - description-data-challenge : 
        - la description est accessible à tout le monde
        - le bouton "Inscrire mon équipe" s'affiche pour tous les utilisateurs connectés, mais il est grisé pour les utilisateurs qui ne sont pas chefs d'équipe
        - si une équipe est déjà inscrite, on aura à la place le bouton pour déposer une URL GitLab (seulement pour le chef d'équipe, grisé pour les autres)
        - pour l'admin, le bouton se transforme en "Inscrire une équipe" ?
    - podium : 
        - accessible à tous
    - acces-equipe :
        - pour l'admin ou les gestionnaire, ce sera une liste des équipes qui participent au data challenge/battle
        - pour les utilisateurs connectés, on retrouvera le bouton "accéder à la page de mon équipe" -> un peu vide ?

Questions : 
    - seul le chef d'équipe peut rendre l'URL GitLab ?
    - podium : proportionnel au nombre de points des trois premiers ou non ?
    - "récupérer/visualiser les réponses des équipes" -> à faire pour les gestionnaires ?
-->

<!DOCTYPE HTML>
<html>
    <head>
        <meta charset="utf-8">
        <title>IA PAU</title>
        <link rel="stylesheet" type="text/css" href="../css/general.css" />
        <link rel="stylesheet" type="text/css" href="../css/header.css" />
        <link rel="stylesheet" type="text/css" href="../css/footer.css" />
        <link rel="stylesheet" type="text/css" href="../css/podium.css" />
        <link rel="stylesheet" type="text/css" href="../css/description-data.css" />
        <link rel="stylesheet" type="text/css" href="../css/partie-equipe.css" />
        <link rel="stylesheet" type="text/css" href="../css/data-event.css" />
    </head>
    <body>
        <?php
            include("header.php");
        ?>
        <!-- main -->
        <main>
            <?php
                
                // description des data challenges/battles
                echo "<section>";
                include("../php/description-data.php");
                echo "</section>";

                // podium (pour les data battles)
                echo "<section>";
                include("../php/podium.php");
                echo "</section>";

                // gérer les équipes (admins, gestionnaires) ou accéder au profil de son équipe (étudiants)
                echo "<section>";
                include("../php/partie-equipe.php");
                echo "</section>";

            ?>
        </main>
        <footer>
            <?php
                include("footer.php");
            ?>
        </footer>
    </body>
</html>