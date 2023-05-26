<?php
    session_start();
    include("../header.php");
     

        echo "<div class='menu-vert'>";
        echo "<h2>{$_SESSION['prenom']} {$_SESSION['nom']}</h2>";
        echo "<ul>";

            // l'utilisateur est un etudiant
            if ((isset($_SESSION["typeUtilisateur"])) && ($_SESSION["typeUtilisateur"] == "normal")) {
                
                // L'étudiant est inscrit
                echo "<li><a title='Informations' href='info.php'>Informations</a></li>";
                echo "<li><a title='Equipe(s)' href='#'>Equipe(s)</a></li>";
                echo "<li><a title='Challenge' href='challenge.php'>Challenge</a></li>";
                echo "<li><a title='Battle' href='battle.php'>Battle</a></li>";
                echo "<li><a title='Messagerie' href='../messagerie.php'>Messagerie</a></li>";

            } 

            // l'utilisateur est un admin
            if ((isset($_SESSION["typeUtilisateur"])) && ($_SESSION["typeUtilisateur"] == "administrateur")) {
                echo "<li><a title='Utilisateurs' href='utilisateurs.php'>Utilisateurs</a></li>";
                echo "<li><a title='Equipe(s)' href='#'>Equipe(s)</a></li>";
                echo "<li><a title='Challenge' href='challenge.php'>Challenge</a></li>";
                echo "<li><a title='Battle' href='battle.php'>Battle</a></li>";
                echo "<li><a title='Ressource' href='ressource.php'>Ressource</a></li>";
                echo "<li><a title='Messagerie' href='../messagerie.php'>Messagerie</a></li>";
            }

            // l'utilisateur est un gestionnaire
            if ((isset($_SESSION["typeUtilisateur"])) && ($_SESSION["typeUtilisateur"] == "gestionnaire")) {
                echo "<li><a title='Challenge' href='challenge.php'>Challenge</a></li>";
                echo "<li><a title='Battle' href='battle.php'>Battle</a></li>";
                echo "<li><a title='Messagerie' href='../messagerie.php'>Messagerie</a></li>";
            }

            echo "</ul>";
            echo "</div>";


    if ((isset($_SESSION["typeUtilisateur"])) && ($_SESSION["typeUtilisateur"] == "etudiant")) {

        echo 'Prenom:'.$_SESSION['prenom'] . ', Nom:' . $_SESSION['nom'];
        echo 'Niveau etude:'.$_SESSION['nivEtude']. ', Etablissement:' . $_SESSION['ecole']. ', Ville:' . $_SESSION['ville'];
    }

    // l'utilisateur est un gestionnaire
    if ((isset($_SESSION["typeUtilisateur"])) && ($_SESSION["typeUtilisateur"] == "gestionnaire")) {

        echo 'Prenom:'.$_SESSION['prenom'] . ', Nom:' . $_SESSION['nom'];
    }

    // l'utilisateur est un admin
    if ((isset($_SESSION["typeUtilisateur"])) && ($_SESSION["typeUtilisateur"] == "administrateur")) {

        echo 'Prenom:'.$_SESSION['prenom'] . ', Nom:' . $_SESSION['nom'];
    }

include("../php/footer.php");

?>