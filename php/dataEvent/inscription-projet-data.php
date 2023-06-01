<?php
    session_start();
    include("../bdd.php");
    $idProjetData = $_GET["idProjetData"];
    $_SESSION["idProjetData"] = $idProjetData; // pour creer-equipe.php
?>

<!DOCTYPE HTML>
<html>
    <head>
        <meta charset="utf-8">
        <title>IA PAU</title>
        <link rel="stylesheet" type="text/css" href="../../css/general-data-event.css" />
        <link rel="stylesheet" type="text/css" href="../../css/header.css" />
        <link rel="stylesheet" type="text/css" href="../../css/footer.css" />
        <link rel="stylesheet" type="text/css" href="../../css/inscription-projet-data.css" />
        <script src="../../js/inscription-projet-data.js"></script>
    </head>
    <body>
        <?php 
            include("../header.php");
        ?>
        <main>
            <?php

                // connexion à la base de données
                $conn = connexion($serveur, $bdd, $user, $pass);

                // récupération des informations liées au projet data considéré
                $requeteProjetData = "SELECT * FROM ProjetData WHERE idProjetData='".$idProjetData."';";
                $resultatProjetData = getAllFromRequest($conn, $requeteProjetData)[0]; // "[0] parce qu'on en aura toujours qu'un

                // récupération de tous les utilisateurs "ajoutables"
                $requeteUtilisateursAjoutables = "SELECT idUtilisateur, prenom, nom FROM Utilisateur WHERE typeUtilisateur='normal' AND idUtilisateur!=".$_SESSION["idUtilisateur"]." AND idUtilisateur NOT IN (SELECT idUtilisateur FROM UtilisateurAppartientEquipe);";
                $resultatUtilisateursAjoutables = getAllFromRequest($conn, $requeteUtilisateursAjoutables);

                // déconnexion de la base de données
                $conn = deconnexion();
            
                // affichage du questionnaire
                echo "
                <div id='inscription-projet-data'>
                    <h1>Créer une équipe</h1>
                    <p>Vous allez vous inscrire au projet data suivant :</p> 
                    <p class='italique'>".$resultatProjetData["descriptProjet"]."</p>
                    <p>Pour cela, vous devez soit être ajouté par un chef d'équipe lors de son inscription à un projet data, soit créer un nouvelle équipe ci-dessous.</p>
                    <form method='POST' id='formulaire-equipe' action='creer-equipe.php' onsubmit='verifierEquipe(event)'>
                        <div class='question'>
                            <label for='nom-equipe'>Entrez le nom de l'équipe que vous voulez créer :</label>
                            <input type='text' name='nom_equipe' placeholder='Nom de votre équipe...' required>
                        </div>
                        <div class='question' id='ajout-etudiants'>
                        <label for='membres-equipes'>Invitez des étudiants à rejoindre votre équipe (min. 2 personnes, max. 7 personnes) :</label>
                            <input type='text' id='nouveau-membre-equipe' name='membres_equipes' list='datalist-etudiants' placeholder=\"Nom de l'étudiant...\">
                            <datalist id='datalist-etudiants'>";

                foreach ($resultatUtilisateursAjoutables as $utilisateur) {
                    echo "
                    <option value='".$utilisateur["prenom"]." ".$utilisateur["nom"]."' data-info='".$utilisateur["idUtilisateur"]."'>";
                }
                echo "
                            </datalist>
                            <div id='etudiants-ajoutes'></div>
                            <div id='bouton-ajout-etudiant' class='bouton-data-event' onclick='ajouterEtudiant()'>
                                <button type='button'>Ajouter l'étudiant</button>    
                            </div>    
                        </div>
                        <div id='bouton-envoi-inscription-projet-data' class='bouton-data-event'>
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