<?php

    // à faire : questionnaire des data battle

    session_start();
    $_SESSION["typeData"] = "battle";
    $_SESSION["loggedIn"] = true;
    $_SESSION["inscrit"] = true;
    $_SESSION["role"] = "etudiant";
    if ($_SESSION["role"] == "etudiant") {
        $_SESSION["chefEquipe"] = true;
    }
?>

<!-- 
Récapitualif des droits : 
    - description-data-challenge : 
        - la description est accessible à tout le monde
        - le bouton "Inscrire mon équipe" s'affiche pour tous les utilisateurs connectés, mais il est grisé pour les utilisateurs qui ne sont pas chefs d'équipe
        - si une équipe est déjà inscrite, on aura à la place le bouton "Déposer mon rendu" (seulement pour le chef d'équipe, grisé pour les autres)
        - pour l'admin, le bouton se transforme en "Inscrire une équipe" ?
    - podium : 
        - accessible à tous
    - acces-equipe :
        - pour l'admin ou les gestionnaire, ce sera une liste des équipes qui participent au data challenge/battle
        - pour les utilisateurs connectés, on retrouvera le bouton "accéder à la page de mon équipe" -> un peu vide ?
-->

<!DOCTYPE HTML>
<html>
    <head>
        <link rel="stylesheet" type="text/css" href="css/general.css" />
        <link rel="stylesheet" type="text/css" href="css/footer.css" />
        <link rel="stylesheet" type="text/css" href="css/podium.css" />
        <link rel="stylesheet" type="text/css" href="css/description-data-challenge.css" />
        <link rel="stylesheet" type="text/css" href="css/acces-equipe.css" />
        <script src="js/description-data-challenge.js"></script>
    </head>
    <body>
        <!-- main -->
        <main>
            <?php
                
                // description des data challenges/battle - accessible à tous 
                echo "<section>";
                include("php/description-data-challenge.php");
                echo "</section>";

                // podium (pour les data battle) - accessible à tous
                if ($_SESSION["typeData"] == "battle") {
                    echo "<section>";
                    include("php/podium.php");
                    echo "</section>";
                }

                // questionnaire (pour les data battle) - accessible aux chefs d'équipe

                // gérer les équipes (admins, gestionnaires) ou accéder au profil de son équipe (étudiants)
                echo "<section>";
                include("php/acces-equipe.php");
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

