<?php
include("header.php");
?>
<?php
    $nom = 'sacha';
    $prenom = 'gru';
    $typeUtilisateur = 'normal';
    echo("test");



// l'utilisateur doit être connecté pour afficher cette section
    if ((isset($_SESSION["estConnecte"])) && ($_SESSION["estConnecte"] == true)) {
        echo("test");

        echo "<div class='menu-vert'>";
        echo "<h2>{$_SESSION['prenom']} {$_SESSION['nom']}</h2>";
        echo "<ul>";

            // l'utilisateur est un etudiant
            if ((isset($_SESSION["typeUtilisateur"])) && ($_SESSION["typeUtilisateur"] == "normal")) {
                
                // L'étudiant est inscrit
                echo "<li><a title='Informations' href='../php/info.php'>Informations</a></li>";
                echo "<li><a title='Equipe(s)' href='../php/partie-equipe.php'>Equipe(s)</a></li>";
                echo "<li><a title='Challenge' href='../php/challenge.php'>Challenge</a></li>";
                echo "<li><a title='Battle' href='../php/battle.php'>Battle</a></li>";
                echo "<li><a title='Messagerie' href='../php/messagerie.php'>Messagerie</a></li>";

            } 

            // l'utilisateur est un admin
            if ((isset($_SESSION["typeUtilisateur"])) && ($_SESSION["typeUtilisateur"] == "administrateur")) {
                echo "<li><a title='Utilisateurs' href='../php/utilisateurs.php'>Utilisateurs</a></li>";
                echo "<li><a title='Equipe(s)' href='../php/partie-equipe.php'>Equipe(s)</a></li>";
                echo "<li><a title='Challenge' href='../php/challenge.php'>Challenge</a></li>";
                echo "<li><a title='Battle' href='../php/battle.php'>Battle</a></li>";
                echo "<li><a title='Ressource' href='../php/ressource.php'>Ressource</a></li>";
                echo "<li><a title='Messagerie' href='../php/messagerie.php'>Messagerie</a></li>";
            }

            // l'utilisateur est un gestionnaire
            if ((isset($_SESSION["typeUtilisateur"])) && ($_SESSION["typeUtilisateur"] == "gestionnaire")) {
                echo "<li><a title='Challenge' href='../php/challenge.php'>Challenge</a></li>";
                echo "<li><a title='Battle' href='../php/battle.php'>Battle</a></li>";
                echo "<li><a title='Messagerie' href='../php/messagerie.php'>Messagerie</a></li>";
            }

            echo "</ul>";
            echo "</div>";

        }        

    include("footer.php");
?>