<?php 

    // à faire : cas 1.2 et 1.3

    // variables temporaires pour l'instant
    $nomDataChallenge = "Data ".$_SESSION["typeData"]." d'exemple";
    $nomEntreprise = "CY-Tech";
    $dateDebut = "22 mai 2023";
    $dateFin = "3 juin 2023";
    $presentation = "Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum. Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum. Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.";

    // description du data challenge - accessible à tous
    echo "
    <div id='presentation-data-challenge'>
        <div id='nom-data-challenge'>
            <span>".$nomDataChallenge."</span>
        </div>
        <div id='infos-data-challenge'>
            <span>Organisé par ".$nomEntreprise." - Du ".$dateDebut." au ".$dateFin."</span>
        </div>
        <p class='paragraphe-presentation-data-challenge'>".$presentation."</p>
    ";

    // cas 1 : l'utilisateur est connecté
    if ((isset($_SESSION["loggedIn"])) && ($_SESSION["loggedIn"] == true)) {

        // cas 1.1 : l'utilisateur est un étudiant
        if ((isset($_SESSION["role"])) && ($_SESSION["role"] == "etudiant")) {

            // cas 1.1.1 : l'utilisateur est déjà inscrit au data challenge
            // affichage de la description (déjà le cas avant), des consignes, des conseils, de l'endroit pour mettre le lien d'hébergement gitlab, ...
            if ((isset($_SESSION["inscrit"])) && ($_SESSION["inscrit"] == true)) {

                // partie consignes
                echo "
                <div class='sous-titre-data-challenge'>
                    <span>Consignes</span>
                </div>
                <p class='paragraphe-presentation-data-challenge'>".$presentation."</p>
                ";

                // partie conseils
                echo "
                <div class='sous-titre-data-challenge'>
                    <span>Conseils</span>
                </div>
                <p class='paragraphe-presentation-data-challenge'>".$presentation."</p>
                ";

                // partie pour le lien gitlab
                echo "
                <div class='sous-titre-data-challenge'>
                    <span>Rendu</span>
                </div>
                <p class='paragraphe-presentation-data-challenge'>".$presentation."</p>
                <form method='POST' id='lien-code-gitlab'>
                    <div>
                        <label for='nom'>Lien d'hébergement de votre code :</label>
                        <input type='text' name='lien_code_gitlab' placeholder='Veuillez entrer un lien GitLab...' required>
                    </div>
                    <button type='submit'>Envoyer</button>
                </form>
                ";
            }

            // cas 1.1.2 : l'utilisateur n'est pas encore inscrit au data challenge
            // seul le bouton pour s'y inscrire s'affiche
            // note : ici, seul le chef d'équipe peut inscrire son équipe (?)
            else {

                // cas 1.1.2.1 : l'utilisateur est le chef de son équipe
                // il peut inscrire son équipe au data challenge
                if ((isset($_SESSION["chefEquipe"])) && ($_SESSION["chefEquipe"] == true)) {
                    echo "
                    <form id='inscription'>
                        <div id='bouton-inscription'>
                            <button type='submit'>Inscrire mon équipe</button>
                        </div>
                    </form>
                    ";
                }

                // cas 1.1.2.2 : l'utilisateur n'est pas le chef de son équipe
                // il ne peut donc pas inscrire son équipe au data challenge
                else {
                    echo "
                    <div id='bouton-inscription-interdit'>
                        <button type='submit'>Inscrire mon équipe</button>
                    </div>
                    <div id='message-survol-souris'></div>
                    ";
                }
            }
        }

        // cas 1.2 : l'utilisateur est un gestionnaire
        // synthèse des différents projets des équipes

        // cas 1.3 : l'utilisateur est un administrateur
        
    }

    // cas 2 : l'utilisateur n'est pas connecté
    // il n'a accès à aucun bouton, un message s'affiche pour lui demander de se connecter
    else {
        echo "
        <div id='message-connexion'>
            <span>Veuillez vous connecter pour vous inscrire à ce data challenge.</span>
        </div>";
    }

    // fermeture de la "div" d'identifiant "presentation-data-challenge"
    echo "</div>";

?>