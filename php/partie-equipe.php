<?php

    // variable temporaire
    $projetRendu = 'https://gitlab.com/exemple';
    $question = "Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua ?";

    // récupération des intitulés des questions
    $requeteQuestions = "SELECT intitule FROM Question NATURAL JOIN Questionnaire WHERE idDataEvent=".$idDataEvent.";";
    $conn = connexion($serveur, $bdd, $user, $pass);
    $resultatQuestions = getAllFromRequest($conn, $requeteQuestions);
    $conn = deconnexion();

    // création du tableau qui va contenir toutes les questions
    $tableauQuestions = array();
    foreach ($resultatQuestions as $test) {
        array_push($tableauQuestions, $test["intitule"]);
    }

    /* 
    - cas 1 : l'utilisateur est un admin ou un gestionnaire
        --> affichage de la liste des équipes avec leurs projets respectifs
    - cas 2 : l'utilisateur est un étudiant
        - cas 2.1 : l'évènement est une data battle et l'étudiant est le chef d'équipe
            --> affichage du questionnaire
        --> affichage du bouton pour accéder au profil de l'équipe
    */

    // l'utilisateur doit être connecté pour afficher cette section
    if ((isset($_SESSION["estConnecte"])) && ($_SESSION["estConnecte"] == true)) {

        // cas 1 : l'utilisateur est un admin ou un gestionnaire
        if ((isset($_SESSION["typeUtilisateur"])) && (($_SESSION["typeUtilisateur"] == "admin")) || ($_SESSION["typeUtilisateur"] == "gestionnaire")) {

            // affichage du titre de la section
            echo "
            <div class='sous-titre-evenement'>
                <span>Équipes participantes</span>
            </div>
            <p class='paragraphe-presentation'>".$loremIpsum."</p>
            ";

            // affichage de la liste des équipes participantes
            echo "
            <div id='conteneur-liste-equipes'>
                <div id='bouton-gestion-equipes'>
                    <a href='#'>
                        <button type='button'>Gérer les équipes</button>
                    </a>
                </div>
                <div id='liste-equipes'>
            ";
            for ($i=1; $i<18; $i++) {
                if ($i%4 == 0 || $i%5 == 0) {
                    echo "
                    <div class='equipe'>
                        <div class='nom-equipe'>
                            <span>Équipe ".$i."</span>
                        </div>
                        <div class='rang'>
                            <span>Rang : ".$i."</span>
                        </div>
                        <div class='projet-rendu'>
                            <span>Archive GitLab rendue : <a href='".$projetRendu."'>".$projetRendu."</a></span>
                        </div>
                    </div>
                ";
                }
                else {
                    echo "
                    <div class='equipe'>
                        <div class='nom-equipe'>
                            <span>Équipe ".$i."</span>
                        </div>
                        <div class='rang'>
                            <span>Rang : ".$i."</span>
                        </div>
                        <div class='projet-rendu'>
                            <span>Archive GitLab rendue : pas encore rendue</span>
                        </div>
                    </div>
                    ";
                }
            }
            echo "
                </div>
            </div>
            ";
        }

        // cas 2 : l'utilisateur est un étudiant
        // l'utilisateur doit être un étudiant inscrit à l'évènement pour pouvoir afficher cette section
        if ((isset($_SESSION["typeUtilisateur"])) && ($_SESSION["typeUtilisateur"] == "etudiant")) {

            // l'étudiant est inscrit
            if ((isset($_SESSION["inscrit"])) && ($_SESSION["inscrit"] == true)) {

                // affichage du titre de la section
                echo "
                <div class='sous-titre-evenement'>
                    <span>Mon équipe</span>
                </div>
                <p class='paragraphe-presentation'>".$loremIpsum."</p>
                ";

                // bouton d'accès à la page de l'équipe pour le data challenge sélectionné
                echo "
                <div id='bouton-acces-equipe'>
                    <button type='submit'>Accéder au profil de mon équipe</button>
                </div>
                ";

                // l'étudiant est le chef de son équipe et il s'agit d'une data battle
                if ((isset($_SESSION["chefEquipe"])) && ($_SESSION["chefEquipe"] == true)) {
                    
                    // affichage du questionnaire
                    echo "
                    <div class='questionnaire'>
                        <form method='POST'>
                    ";
                    foreach ($tableauQuestions as $question) {
                        echo "
                            <div class='question'>
                                <label for='question'>".$question."</label>
                                <input type='text' name='question' placeholder='Votre réponse...' required>
                            </div>
                        ";
                    }
                    echo "
                            <div id='bouton-envoi-questionnaire'>
                                <button type='submit'>Envoyer mes réponses</button>
                            </div>
                        </form>
                    </div>
                    ";

                }
            }            
        }
    }
?>