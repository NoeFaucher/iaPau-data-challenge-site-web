<?php
    session_start();
    include("./php/header.php");
    include("./css/menu-vert.css");

    // l'utilisateur doit être connecté pour afficher cette section
    if ((isset($_SESSION["estConnecte"])) && ($_SESSION["estConnecte"] == true)) {

        echo "<div class='menu-vert'>";
        echo "<h2>{$_SESSION['prenom']} {$_SESSION['nom']}</h2>";
        echo "<ul>";

            // l'utilisateur est un etudiant
            if ((isset($_SESSION["typeUtilisateur"])) && ($_SESSION["typeUtilisateur"] == "normal")) {
                
                // L'étudiant est inscrit
                echo "<li><a title='Informations' href='info.php'>Informations</a></li>";
                echo "<li><a title='Equipe(s)' href='partie-equipe.php'>Equipe(s)</a></li>";
                echo "<li><a title='Challenge' href='challenge.php'>Challenge</a></li>";
                echo "<li><a title='Battle' href='battle.php'>Battle</a></li>";
                echo "<li><a title='Messagerie' href='messagerie.php'>Messagerie</a></li>";

            } 

            // l'utilisateur est un admin
            if ((isset($_SESSION["typeUtilisateur"])) && ($_SESSION["typeUtilisateur"] == "administrateur")) {
                echo "<li><a title='Utilisateurs' href='utilisateurs.php'>Utilisateurs</a></li>";
                echo "<li><a title='Equipe(s)' href='partie-quipe.php'>Equipe(s)</a></li>";
                echo "<li><a title='Challenge' href='challenge.php'>Challenge</a></li>";
                echo "<li><a title='Battle' href='battle.php'>Battle</a></li>";
                echo "<li><a title='Ressource' href='ressource.php'>Ressource</a></li>";
                echo "<li><a title='Messagerie' href='messagerie.php'>Messagerie</a></li>";
            }

            // l'utilisateur est un gestionnaire
            if ((isset($_SESSION["typeUtilisateur"])) && ($_SESSION["typeUtilisateur"] == "gestionnaire")) {
                echo "<li><a title='Challenge' href='challenge.php'>Challenge</a></li>";
                echo "<li><a title='Battle' href='battle.php'>Battle</a></li>";
                echo "<li><a title='Messagerie' href='messagerie.php'>Messagerie</a></li>";
            }

            echo "</ul>";
            echo "</div>";

        }        

    include("./php/footer.php");
?>