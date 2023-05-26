<?php

    session_start();
    include("../php/bdd.php");
    $loremIpsum = "Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.";
    $texte1 = "Entrez ci-dessous le nom de l'équipe que vous voulez créer. Vous deviendrez chef de cette équipe.";
    $texte2 = "Invitez des étudiants à rejoindre votre équipe (max. 7 personnes)";

    $idProjetData = $_GET["idProjetData"];
    $conn = connexion($serveur, $bdd, $user, $pass);
    $requeteProjetData = "SELECT * FROM ProjetData WHERE idProjetData='".$idProjetData."';";
    $resultatProjetData = getAllFromRequest($conn, $requeteProjetData)[0]; // "[0] parce qu'on en aura toujours qu'un
    $conn = deconnexion();
?>

<!DOCTYPE HTML>
<html>
    <head>
        <meta charset="utf-8">
        <title>IA PAU</title>
        <link rel="stylesheet" type="text/css" href="../css/general.css" />
        <link rel="stylesheet" type="text/css" href="../css/header.css" />
        <link rel="stylesheet" type="text/css" href="../css/footer.css" />
        <link rel="stylesheet" type="text/css" href="../css/inscription-projet-data.css" />
        <script src="../js/header.js"></script>
        <script src="../js/inscription-projet-data.js"></script>
    </head>
    <body>
        <?php 
            include("header.php");
        ?>
        <!-- main -->
        <main>
            <?php
            
                // affichage du questionnaire
                echo "
                <div id='inscription-projet-data'>
                    <h1>Projet data ".$resultatProjetData["idProjetData"]." - créer une équipe</h1>
                    <p>Vous allez vous inscrire au projet data suivant : 
                    
                        ".$resultatProjetData["descriptProjet"]."
                    </p>
                    <form method='POST'>
                        <div class='question'>
                            <label for='nom-equipe'>".$texte1."</label>
                            <input type='text' name='nom_equipe' placeholder='Nom de votre équipe...' required>
                        </div>
                        <div class='question' id='ajout-etudiants'>
                            <label for='membres-equipes'>".$texte2."</label>
                            <input type='text' id='nouveau-membre-equipe' name='membres_equipes' list='datalist-etudiants' placeholder=\"Nom de l'étudiant...\" required>
                            <datalist id='datalist-etudiants'>
                                <option value='John Doe'>
                                <option value='Marie Dupuis'>
                                <option value='Germain Dupont'>
                            </datalist>
                            <div id='etudiants-ajoutes'></div>
                            <div id='bouton-ajout-etudiant' onclick='ajouterEtudiant()'>
                                <button type='button'>Ajouter l'étudiant</button>    
                            </div>    
                        </div>
                        <div id='bouton-envoi-inscription-projet-data'>
                            <button type='submit'>Créer mon équipe</button>
                        </div>
                    </form>
                </div>
                ";
            ?>
        </main>
        <footer>
            <?php
                include("footer.php");
            ?>
        </footer>
    </body>
</html>