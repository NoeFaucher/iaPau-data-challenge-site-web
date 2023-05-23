<?php 

    // variables temporaires pour l'instant
    $nomDataChallenge = "Data ".$_SESSION["typeDataEvent"]." d'exemple";
    $nomEntreprise = "Entreprise";
    $dateDebut = "22 mai 2023";
    $dateFin = "3 juin 2023";
    $presentation = $loremIpsum;

    // description du data challenge - accessible à tous
    echo "
    <div id='presentation-data-challenge'>
        <h3>".$nomDataChallenge."</h3>
        <div id='infos-data-challenge'>
            <span>Organisé par ".$nomEntreprise." - Du ".$dateDebut." au ".$dateFin."</span>
        </div>
        <p class='paragraphe-presentation'>".$presentation."</p>
    ";

    /*
    ----- droits -----
    - cas 1 : l'utilisateur est connecté
        - cas 1.1 : il est inscrit à l'évènement OU il est gestionnaire/admin 
            --> accès aux données, consignes et conseils
            - cas 1.1.1 : il est chef d'équipe
                --> accès à la section "rendu"
        - cas 1.2 : il n'est pas inscrit à l'évènement mais est étudiant, il peut donc s'inscrire en créant une équipe
            - cas 1.2.1 : l'évènement est un data challenge --> plusieurs projets data
            - cas 1.2.2 : l'évènement est une data battle --> un seul projet data
            --> renvoi vers un form pour créer une équipe
    - cas 2 : l'utilisateur n'est pas connecté
        --> message "vous n'êtes pas connecté"
    */

    // cas 1 : l'utilisateur est connecté
    if ((isset($_SESSION["estConnecte"])) && ($_SESSION["estConnecte"] == true)) {

        // cas 1.1 : l'utilisateur est inscrit à l'évènement OU il est gestionnaire/admin
        if ((((isset($_SESSION["inscrit"])) && ($_SESSION["inscrit"]) == true)) || ((isset($_SESSION["typeUtilisateur"])) && (($_SESSION["typeUtilisateur"] == "admin") || ($_SESSION["typeUtilisateur"] == "gestionnaire")))) {
            
            // partie données
            echo "
            <div class='sous-titre-evenement'>
                <span>Données</span>
            </div>
            <p class='paragraphe-presentation'>".$loremIpsum."</p>
            ";

            // partie consignes
            echo "
            <div class='sous-titre-evenement'>
                <span>Consignes</span>
            </div>
            <p class='paragraphe-presentation'>".$loremIpsum."</p>
            ";

            // partie conseils
            echo "
            <div class='sous-titre-evenement'>
                <span>Conseils</span>
            </div>
            <p class='paragraphe-presentation'>".$loremIpsum."</p>
            ";

            // cas 1.1.1 : l'utilisateur est étudiant et chef d'équipe, il peut donc rendre une archive GitLab
            // note : chefEquipe => etudiant donc pas besoin de vérifier qu'il est étudiant
            if ((isset($_SESSION["chefEquipe"])) && ($_SESSION["chefEquipe"] == true)) {

                // partie pour le lien gitlab
                echo "
                <div class='sous-titre-evenement'>
                    <span>Rendu</span>
                </div>
                <p class='paragraphe-presentation'>".$loremIpsum."</p>
                <form method='POST' id='lien-code-gitlab'>
                    <div id='texte-input-lien-gitlab'>
                        <label for='nom'>Lien d'hébergement de votre code :</label>
                        <input type='text' name='lien_code_gitlab' placeholder='Veuillez entrer un lien GitLab...' required>
                    </div>
                    <button type='submit'>Envoyer</button>
                </form>
                ";

            }

        }

        // cas 1.2 : l'utilisateur n'est pas inscrit à l'évènement mais est étudiant
        // il peut donc s'inscrire en créant une équipe et en devenant chef d'équipe
        else if ((isset($_SESSION["inscrit"])) && ($_SESSION["inscrit"] == false) && (isset($_SESSION["typeUtilisateur"])) && ($_SESSION["typeUtilisateur"] == "etudiant")) {

            // cas 1.2.1 : l'évènement est un data challenge
            if ((isset($_SESSION["typeDataEvent"])) && ($_SESSION["typeDataEvent"] == "battle")) {

                echo "
                    <div class='sous-titre-evenement'>
                        <span>Projet data associé</span>
                    </div>
                    <p class='paragraphe-presentation'>".$loremIpsum."</p>
                ";

                echo "
                <form id='choix-projet-data'>
                    <div id='bouton-inscription'>
                        <button type='submit'>Inscrire mon équipe à ce projet data</button>
                    </div>
                </form>
                ";

            }

            // cas 1.2.2 : l'évènement est une data battle
            else if ((isset($_SESSION["typeDataEvent"])) && ($_SESSION["typeDataEvent"] == "challenge")) {

                echo "
                    <div class='sous-titre-evenement'>
                        <span>Choix du projet data</span>
                    </div>
                    <p class='paragraphe-presentation'>".$loremIpsum."</p>
                ";

                echo "<form id='choix-projet-data'>";
                for ($i=1; $i<6; $i++) {
                    echo "
                        <div class='projet-data'>
                            <div class='titre-projet-data'>
                                <span>Projet data ".$i."</span>
                            </div>
                            <p>".$loremIpsum."</p>
                            <div id='bouton-inscription'>
                                <button type='submit'>M'inscrire à ce projet data</button>
                            </div>
                        </div>
                    ";
                }
                echo "</form>";
            }

        }

    }
    
    // cas 2 : l'utilisateur n'est pas connecté
    else {
        
        // détermination de la fin du message demandant de s'authentifier pour s'inscrire à l'évènement
        if (isset($_SESSION["typeDataEvent"]) && ($_SESSION["typeDataEvent"] == "challenge")) {
            $finMsg = "ce data challenge";
        }
        else if (isset($_SESSION["typeDataEvent"]) && ($_SESSION["typeDataEvent"] == "battle")) {
            $finMsg = "cette data battle";
        }

        // affichage du message demandant de s'authentifier pour s'inscrire à l'évènement
        echo "
        <div id='message-connexion'>
            <span>Veuillez vous connecter pour vous inscrire à ".$finMsg.".</span>
        </div>";

    }

?>