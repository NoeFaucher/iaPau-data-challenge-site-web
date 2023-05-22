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
    - présentation, accessible à tous 
    - cas 1 : l'utilisateur est connecté
        - cas 1.1 : il participe à l'évènement ou il est gestionnaire ou admin
            -->  affichage des consignes et conseils
            - cas 1.1.1 : il est étudiant 
                --> affichage de la section "rendu"
        - cas 1.2 : il ne participe pas mais est étudiant
            - cas 1.2.1 : il est chef d'équipe
                --> affichage du bouton "inscrire mon équipe"
                ///// choix du projet data (un pour un data battle, plusieurs pour un projet data)
            - cas 1.2.2 : il n'est pas chef d'équipe
                --> affichage du bouton "inscrire mon équipe" GRISÉ
                ///// la même chose mais grisé
        - cas 1.3 : il est admin ou gestionnaire --> pas fait, inutile pour cette section
    - cas 2 : l'utilisateur n'est pas connecté
        --> message "vous n'êtes pas connecté"
    */

    // cas 1 : l'utilisateur est connecté
    if ((isset($_SESSION["estConnecte"])) && ($_SESSION["estConnecte"] == true)) {

        // cas 1.1 : il participe à l'évènement ou il est gestionnaire ou admin
        // affichage des consignes et conseils pour l'évènement correspondant
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

            // cas 1.1.1 : il est en plus étudiant et chef d'équipe, il peut donc rendre une archive GitLab
            if (((isset($_SESSION["typeUtilisateur"])) && ($_SESSION["typeUtilisateur"] == "etudiant")) && ((isset($_SESSION["chefEquipe"])) && ($_SESSION["chefEquipe"] == true))) {

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
        if (((isset($_SESSION["typeUtilisateur"])) && ($_SESSION["typeUtilisateur"] == "etudiant")) && ((isset($_SESSION["inscrit"])) && ($_SESSION["inscrit"] == false))) {
            
            // cas 1.2.1 : l'utilisateur est le chef de son équipe
            // choix du projet data
            if ((isset($_SESSION["chefEquipe"])) && ($_SESSION["chefEquipe"] == true)) {

                // cas 1.2.1.1 : l'évènement est une data battle
                if ((isset($_SESSION["typeDataEvent"])) && ($_SESSION["typeDataEvent"] == "battle")) {

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
                                    <button type='submit'>Choisir ce projet data</button>
                                </div>
                            </div>
                        ";
                    }
                    echo "</form>";
                
                }

                // cas 1.2.1.2 : l'évènement est un data challenge
                else if ((isset($_SESSION["typeDataEvent"])) && ($_SESSION["typeDataEvent"] == "challenge")) {

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

            }

            // cas 1.2.2 : l'utilisateur n'est pas le chef de son équipe
            // tout pareil mais avec des boutons grisés
            if ((isset($_SESSION["chefEquipe"])) && ($_SESSION["chefEquipe"] == false)) {

                // cas 1.2.1.1 : l'évènement est une data battle
                if ((isset($_SESSION["typeDataEvent"])) && ($_SESSION["typeDataEvent"] == "battle")) {

                    echo "
                        <div class='sous-titre-evenement'>
                            <span>Choix du projet data</span>
                        </div>
                        <p class='paragraphe-presentation'>".$loremIpsum."</p>
                    ";

                    echo "<form id='choix-projet-data'>";
                    for ($i=1; $i<5; $i++) {
                        echo "
                            <div class='projet-data'>
                                <div class='titre-projet-data'>
                                    <span>Projet data ".$i."</span>
                                </div>
                                <p>".$loremIpsum."</p>
                                <div class='bouton-inscription-interdit'>
                                    <button type='submit'>Choisir ce projet data</button>
                                </div>
                            </div>
                        ";
                    }
                    echo "</form>";
                
                }

                // cas 1.2.1.2 : l'évènement est un data challenge
                else if ((isset($_SESSION["typeDataEvent"])) && ($_SESSION["typeDataEvent"] == "challenge")) {

                    echo "
                        <div class='sous-titre-evenement'>
                            <span>Projet data associé</span>
                        </div>
                        <p class='paragraphe-presentation'>".$loremIpsum."</p>
                    ";

                    echo "
                    <form id='choix-projet-data'>
                        <div class='bouton-inscription-interdit'>
                            <button type='submit'>Inscrire mon équipe à ce projet data</button>
                        </div>
                    </form>
                    ";

                }
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