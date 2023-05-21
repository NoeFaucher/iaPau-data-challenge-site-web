<?php 

    // variables temporaires pour l'instant
    $nomDataChallenge = "Data ".$_SESSION["typeData"]." d'exemple";
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
    - présentation, accessible à tous 
    - cas 1 : l'utilisateur est connecté
        - cas 1.1 : il participe à l'évènement ou il est gestionnaire ou admin
            -->  affichage des consignes et conseils
            - cas 1.1.1 : il est étudiant 
                --> affichage de la section "rendu"
        - cas 1.2 : il ne participe pas mais est étudiant
            - cas 1.2.1 : il est chef d'équipe  
                --> affichage du bouton "inscrire mon équipe"
            - cas 1.2.2 : il n'est pas chef d'équipe
                --> affichage du bouton "inscrire mon équipe" GRISÉ
        - cas 1.3 : il est admin ou gestionnaire --> pas fait, inutile pour cette section
    - cas 2 : l'utilisateur n'est pas connecté
        --> message "vous n'êtes pas connecté"
    */

    // cas 1 : l'utilisateur est connecté
    if ((isset($_SESSION["loggedIn"])) && ($_SESSION["loggedIn"] == true)) {

        // cas 1.1 : il participe à l'évènement ou il est gestionnaire ou admin
        // affichage des consignes et conseils pour l'évènement correspondant
        if ((((isset($_SESSION["inscrit"])) && ($_SESSION["inscrit"]) == true)) || ((isset($_SESSION["role"])) && (($_SESSION["role"] == "admin") || ($_SESSION["role"] == "gestionnaire")))) {
            
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

            // cas 1.1.1 : il est en plus étudiant, il peut donc rendre une archive GitLab
            if ((isset($_SESSION["role"])) && ($_SESSION["role"] == "etudiant")) {

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

        // cas 1.2 : l'utilisateur est un étudiant mais il n'est pas inscrit à l'évènement
        if (((isset($_SESSION["role"])) && ($_SESSION["role"] == "etudiant")) && ((isset($_SESSION["inscrit"])) && ($_SESSION["inscrit"] == false))) {
            
            // cas 1.2.1 : l'utilisateur est le chef de son équipe
            // affichage du bouton "inscrire mon équipe" 
            if ((isset($_SESSION["chefEquipe"])) && ($_SESSION["chefEquipe"] == true)) {

                echo "
                <form id='inscription'>
                    <div id='bouton-inscription'>
                        <button type='submit'>Inscrire mon équipe</button>
                    </div>
                </form>
                ";

            }

            // cas 1.2.2 : l'utilisateur n'est pas le chef de son équipe
            // affichage du bouton "inscrire mon équipe" grisé
            if ((isset($_SESSION["chefEquipe"])) && ($_SESSION["chefEquipe"] == false)) {

                echo "
                <div id='bouton-inscription-interdit'>
                    <button type='submit'>Inscrire mon équipe</button>
                </div>
                <div id='message-survol-souris'></div>
                ";

            }
        }
    }
    
    // cas 2 : l'utilisateur n'est pas connecté
    else {
        
        // détermination de la fin du message demandant de s'authentifier pour s'inscrire à l'évènement
        if (isset($_SESSION["typeData"]) && ($_SESSION["typeData"] == "challenge")) {
            $finMsg = "ce data challenge";
        }
        else if (isset($_SESSION["typeData"]) && ($_SESSION["typeData"] == "battle")) {
            $finMsg = "cette data battle";
        }

        // affichage du message demandant de s'authentifier pour s'inscrire à l'évènement
        echo "
        <div id='message-connexion'>
            <span>Veuillez vous connecter pour vous inscrire à ".$finMsg.".</span>
        </div>";

    }

?>