<?php
    session_start();
    include("header.php");
    include("bdd.php");

    $request = "SELECT prenom, nom, email, nivEtude, ecole, ville FROM Utilisateur WHERE typeUtilisateur= 'normal'";
    $cnx = connexion($serveur, $bdd, $user, $pass);
    $utilisateur = getAllFromRequest($cnx,$request);

        // l'utilisateur doit être connecté pour afficher cette section
        if ((isset($_SESSION["estConnecte"])) && ($_SESSION["estConnecte"] == true)) {

        echo "<div class='menu-vert'>";
        echo "<h2>{$_SESSION['prenom']} {$_SESSION['nom']}</h2>";
        echo "<ul>";
                
                // L'étudiant est inscrit
                echo "<li><a title='Informations' href='info.php'>Informations</a></li>";
                echo "<li><a title='Equipe(s)' href='partie-equipe.php'>Equipe(s)</a></li>";
                echo "<li><a title='Challenge' href='challenge.php'>Challenge</a></li>";
                echo "<li><a title='Battle' href='battle.php'>Battle</a></li>";
                echo "<li><a title='Messagerie' href='messagerie.php'>Messagerie</a></li>";

            echo "</ul>";
            echo "</div>";


    if ((isset($_SESSION["typeUtilisateur"])) && ($_SESSION["typeUtilisateur"] == "etudiant")) {

        echo 'Prenom:'.$_SESSION['prenom'] . ', Nom:' . $_SESSION['nom'];
        echo 'Niveau etude:'.$_SESSION['nivEtude']. ', Etablissement:' . $_SESSION['ecole']. ', Ville:' . $_SESSION['ville'];
    }
}

include("footer.php");

?>