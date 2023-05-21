<?php

    session_start();
    $loremIpsum = "Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.";

    $_SESSION["typeData"] = "battle";
    $_SESSION["loggedIn"] = true;
    $_SESSION["role"] = "etudiant";
    if ($_SESSION["role"] == "etudiant") {
        $_SESSION["inscrit"] = true;
        $_SESSION["chefEquipe"] = true;
    }

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
        <link rel="stylesheet" type="text/css" href="css/general.css" />
        <link rel="stylesheet" type="text/css" href="css/footer.css" />
        <link rel="stylesheet" type="text/css" href="css/podium.css" />
        <link rel="stylesheet" type="text/css" href="css/description-data-challenge.css" />
        <link rel="stylesheet" type="text/css" href="css/acces-equipe.css" />
    </head>
    <body>
        <header>
            <?php 
                include("php/header.php");
            ?>
        </header>
        <!-- main -->
        <main>
            <?php
                
                // description des data challenges/battles
                echo "<section>";
                include("php/description-data-challenge.php");
                echo "</section>";

                // podium (pour les data battles)
                echo "<section>";
                include("php/podium.php");
                echo "</section>";

                // gérer les équipes (admins, gestionnaires) ou accéder au profil de son équipe (étudiants)
                echo "<section>";
                include("php/partie-equipe.php");
                echo "</section>";

            ?>
        </main>
        <footer>
            <?php
                include("php/footer.php");
            ?>
        </footer>
    </body>
</html>

