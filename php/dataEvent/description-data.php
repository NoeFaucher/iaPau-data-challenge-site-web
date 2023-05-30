<?php

    $nomDataChallenge = $resultatDataEvent["titre"];
    $nomEntreprise = $resultatDataEvent["entreprise"];
    $dateDebut = $resultatDataEvent["dateDebut"];
    $dateFin = $resultatDataEvent["dateFIN"];
    $presentation = $resultatDataEvent["descript"];

    // A modifier
    $id_equipe = 1;

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

            echo "
                <div class='sous-titre-evenement'>
                    <span>Rendu</span>
                </div>
                <div id='lien-code-gitlab'>
            ";

            // cas 1.1.1 : l'utilisateur est étudiant et chef d'équipe, il peut donc rendre une archive GitLab
            // note : chefEquipe => etudiant donc pas besoin de vérifier qu'il est étudiant
            if ((isset($_SESSION["chefEquipe"])) && ($_SESSION["chefEquipe"] == true)) {

                // partie pour le lien gitlab
                echo "
                    <i>Veuillez entrer un lien vers un fichier raw (GitLab ou GitHub)</i>
                    <div id='texte-input-lien-gitlab'>
                        <label for='nom'>Lien d'hébergement de votre code :</label>
                        <input type='text' name='lien_code_gitlab' id='lien_code_gitlab'  placeholder='Veuillez entrer un lien vers un fichier raw (GitLab ou GitHub)...' required>
                    </div>
                    <input type=\"button\" onclick=\"envoyerCode(this,".$id_equipe.")\" value=\"Envoyer\">

                ";

            }
            echo "<a href=\"rendu.php?equipe=$id_equipe\" >Consulter mes résultats</a>
                </div>";

        }

        // cas 1.2 : l'utilisateur n'est pas inscrit à l'évènement mais est étudiant
        // il peut donc s'inscrire en créant une équipe et en devenant chef d'équipe
        else if ((isset($_SESSION["inscrit"])) && ($_SESSION["inscrit"] == false) && (isset($_SESSION["typeUtilisateur"])) && ($_SESSION["typeUtilisateur"] == "etudiant")) {

            // cas 1.2.1 : l'évènement est une data battle
            if ((isset($_SESSION["typeDataEvent"])) && ($_SESSION["typeDataEvent"] == "DataBattle")) {
                
                echo "
                    <div class='sous-titre-evenement'>
                        <span>Projet data associé - ".$resultatProjetsData[0]["titreProjetData"]."</span>
                    </div>
                    <p class='paragraphe-presentation'>".$resultatProjetsData[0]["descriptProjet"]."</p>
                ";

                echo "
                <div id='choix-projet-data'>
                    <div id='bouton-inscription'>
                        <button type='button'><a href='../php/inscription-projet-data.php?idProjetData=".$resultatProjetsData[0]["idProjetData"]."'>M'inscrire à ce projet data</a></button>
                    </div>
                </div>
                ";

            }

            // cas 1.2.2 : l'évènement est une data challenge
            else if ((isset($_SESSION["typeDataEvent"])) && ($_SESSION["typeDataEvent"] == "DataChallenge")) {

                echo "
                    <div class='sous-titre-evenement'>
                        <span>Choix du projet data</span>
                    </div>
                    <p class='paragraphe-presentation'>".$loremIpsum."</p>
                ";

                echo "<div id='choix-projet-data'>";
                foreach ($resultatProjetsData as $projetData) {
                    echo "
                        <div class='projet-data'>
                            <div class='titre-projet-data'>
                                <span>".$projetData["titreProjetData"]."</span>
                            </div>
                            <p>".$projetData["descriptProjet"]."</p>
                            <div id='bouton-inscription'>
                                <button type='button'><a href='../php/inscription-projet-data.php?idProjetData=".$i."'>M'inscrire à ce projet data</a></button>
                            </div>
                        </div>
                    ";
                }
                echo "</div>";
            }

        }

    }
    
    // cas 2 : l'utilisateur n'est pas connecté
    else {
        
        // détermination de la fin du message demandant de s'authentifier pour s'inscrire à l'évènement
        if (isset($_SESSION["typeDataEvent"]) && ($_SESSION["typeDataEvent"] == "DataChallenge")) {
            $finMsg = "ce data challenge";
        }
        else if (isset($_SESSION["typeDataEvent"]) && ($_SESSION["typeDataEvent"] == "DataBattle")) {
            $finMsg = "cette data battle";
        }

        // affichage du message demandant de s'authentifier pour s'inscrire à l'évènement
        echo "
        <div id='message-connexion'>
            <span>Veuillez vous connecter pour vous inscrire à ".$finMsg.".</span>
        </div>";

    }

?>
    <script src="/js/rendu.js"></script>
