<?php

    // à faire : questionnaire

    // temporaire : variables d'équipes
    $nomEquipe1 = "Équipe 1";
    $nomEquipe2 = "Equipe 2";
    $nomEquipe3 = "Équipe 3";
    $rangEquipe1 = 2;
    $rangEquipe2 = 5;
    $rangEquipe3 = 7;

    // l'utilisateur doit être connecté pour afficher cette section
    if ((isset($_SESSION["loggedIn"])) && ($_SESSION["loggedIn"] == true)) {

        // l'utilisateur est un admin
        if ((isset($_SESSION["role"])) && ($_SESSION["role"] == "admin")) {
            echo "
            <div id='conteneur-liste-equipes'>
                <div id='bouton-gestion-equipes'>
                    <button type='button'>
                        <a href='#'>Gérer les équipes</a>
                    </button>
                </div>
                <div id='liste-equipes'>
                    <div class='equipe'>
                        <div class='nom-equipe'>
                            <span>".$nomEquipe1."</span>
                        </div>
                        <div class='rang'>
                            <span>Rang : ".$rangEquipe1."</span>
                        </div>
                    </div>
                    <div class='equipe'>
                        <div class='nom-equipe'>
                            <span>".$nomEquipe2."</span>
                        </div>
                        <div class='rang'>
                            <span>Rang : ".$rangEquipe2."</span>
                        </div>
                    </div>
                    <div class='equipe'>
                        <div class='nom-equipe'>
                            <span>".$nomEquipe3."</span>
                        </div>
                        <div class='rang'>
                            <span>Rang : ".$rangEquipe3."</span>
                        </div>
                    </div>
                </div>
            </div>
            ";
        }

        // l'utilisateur est un gestionnaire
        if ((isset($_SESSION["role"])) && ($_SESSION["role"] == "gestionnaire")) {
            // à faire ? : 
            // - récupérer/visualiser les réponses des équipes
        }

        // l'utilisateur est un étudiant
        // l'utilisateur doit être un étudiant inscrit à l'évènement pour pouvoir afficher cette section
        if ((isset($_SESSION["role"])) && ($_SESSION["role"] == "etudiant")) {

            // l'étudiant est inscrit
            if ((isset($_SESSION["inscrit"])) && ($_SESSION["inscrit"] == true)) {

                // l'étudiant est le chef de son équipe et il s'agit d'une data battle
                if (((isset($_SESSION["chefEquipe"])) && ($_SESSION["chefEquipe"] == true)) && ((isset($_SESSION["typeData"])) && ($_SESSION["typeData"] == "battle"))) {
                    // répondre au questionnaire : à faire
                }

                // bouton d'accès à la page de l'équipe pour le data challenge sélectionné
                echo "
                <form id='acces-equipe'>
                    <div id='bouton-acces-equipe'>
                        <button type='submit'>Accéder au profil de mon équipe</button>
                    </div>
                </form>";
            }            
        }
    }
?>