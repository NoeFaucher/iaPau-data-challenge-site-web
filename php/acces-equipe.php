<?php

    $nomEquipe1 = "Équipe 1";
    $nomEquipe2 = "Equipe 2";
    $nomEquipe3 = "Équipe 3";
    $rangEquipe1 = 2;
    $rangEquipe2 = 5;
    $rangEquipe3 = 7;

    if ((isset($_SESSION["inscritAuDataChallenge"])) && ($_SESSION["inscritAuDataChallenge"] == true) && (isset($_SESSION["role"])) && ($_SESSION["role"] == "participant")) {
        echo "
        <form id='acces-equipe'>
            <div id='bouton-acces-equipe'>
                <button type='submit'>Accéder au profil de mon équipe</button>
            </div>
        </form>";
    }
    else if ((isset($_SESSION["role"])) && (($_SESSION["role"] == "gestionnaire") || ($_SESSION["role"] == "admin"))) {
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
        </div>";
    }
?>