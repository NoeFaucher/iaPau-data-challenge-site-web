<?php
    session_start();
    include("../bdd.php");
    $idProjetData = $_GET["idProjetData"];
?>

<!DOCTYPE HTML>
<html>
    <head>
        <meta charset="utf-8">
        <title>IA PAU</title>
        <link rel="stylesheet" type="text/css" href="../../css/general.css" />
        <link rel="stylesheet" type="text/css" href="../../css/header.css" />
        <link rel="stylesheet" type="text/css" href="../../css/footer.css" />
        <link rel="stylesheet" type="text/css" href="../../css/inscription-projet-data.css" />
        <script src="../../js/header.js"></script>
        <script src="../../js/inscription-projet-data.js"></script>
    </head>
    <body>
        <?php 
            include("../header.php");
        ?>
        <main>
            <?php

                // récupération des informations liées au projet data considéré
                $conn = connexion($serveur, $bdd, $user, $pass);
                $requeteProjetData = "SELECT * FROM ProjetData WHERE idProjetData='".$idProjetData."';";
                $resultatProjetData = getAllFromRequest($conn, $requeteProjetData)[0]; // "[0] parce qu'on en aura toujours qu'un
                $conn = deconnexion();
            
                // affichage du questionnaire
                echo "
                <div id='inscription-projet-data'>
                    <h1>Créer une équipe</h1>
                    <p>Vous allez vous inscrire au projet data suivant :</p> 
                    <p class='italique'>".$resultatProjetData["descriptProjet"]."</p>
                    <p>Pour cela, vous devez soit être invité par un chef d'équipe lors de son inscription à un projet data, soit créer un nouvelle équipe ci-dessous.</p>
                    <form method='POST'>
                        <div class='question'>
                            <label for='nom-equipe'>Entrez le nom de l'équipe que vous voulez créer :</label>
                            <input type='text' name='nom_equipe' placeholder='Nom de votre équipe...' required>
                        </div>
                        <div class='question' id='ajout-etudiants'>
                            <label for='membres-equipes'>Invitez des étudiants à rejoindre votre équipe (min. 3 personnes, max. 7 personnes) :</label>
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
                include("../footer.php");
            ?>
        </footer>
    </body>
</html>