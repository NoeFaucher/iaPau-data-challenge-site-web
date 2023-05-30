<?php

    // initialisation
    session_start();
    include("../bdd.php");
    include("../varSession.inc.php");

    // récupération de l'id du data event par la méthode GET (dans l'URL)
    $idDataEvent = $_GET["idDataEvent"];
    $_SESSION["idDataEventPage"] = $idDataEvent;

    // on regarde si l'utilisateur s'il est inscrit au data event, s'il est chef d'équipe et s'il a déjà rendu quelque chose, à condition qu'il soit connecté
    if ((isset($_SESSION["estConnecte"])) && ($_SESSION["estConnecte"] == true)) {

        // connexion à la base de données
        $conn = connexion($serveur, $bdd, $user, $pass);

        // requête pour déterminer si l'utilisateur est inscrit au data event, s'il est chef d'équipe et si son équipe a déjà rendu quelque chose
        $requeteEquipesUtilisateur = "SELECT idProjetData, idEquipe, idChefEquipe, idDataEvent FROM Equipe NATURAL JOIN UtilisateurAppartientEquipe NATURAL JOIN ProjetData WHERE idUtilisateur=".$_SESSION["idUtilisateur"].";";
        $resultatEquipesUtilisateur = getAllFromRequest($conn, $requeteEquipesUtilisateur);
        
        // initialisation de certaines variables de session
        $_SESSION["inscrit"] = false;
        $_SESSION["chefEquipe"] = false;
        $_SESSION["rendu"] = false;

        // l'utilisateur appartient à au moins une équipe
        if (!empty($resultatEquipesUtilisateur)) {

            foreach ($resultatEquipesUtilisateur as $equipe) {

                // l'une des équipes de l'utilisateur est inscrite au data event affiché sur la page
                if ($equipe["idDataEvent"] == $idDataEvent) {

                    // stockage de l'id de l'équipe associé à ce data event (pour envoi-***.php) + l'utilisateur est inscrit au data event 
                    $_SESSION["idEquipeUtilisateurPage"] = $equipe["idEquipe"];
                    $_SESSION["inscrit"] = true;

                    // récupération de l'éventuel rendu associé à l'équipe
                    $requeteRendu = "SELECT * FROM Rendu WHERE idEquipe=".$equipe["idEquipe"].";";
                    $resultatRendu = getAllFromRequest($conn, $requeteRendu)[0];

                    // l'équipe de l'utilisateur a déjà rendu du code
                    if (!empty($resultatRendu)) {
                        $_SESSION["rendu"] = true;
                    }

                    // l'utilisateur est chef de cette équipe (équipe qui est inscrite au data event de la page)
                    if ($equipe["idChefEquipe"] == $_SESSION["idUtilisateur"]) {
                        $_SESSION["chefEquipe"] = true;
                    }
                }
            }
        }

        // déconnexion de la base de données
        $conn = deconnexion();
        
    }

    // partie temporaire
    $loremIpsum = "Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.";
    $lienProjetRendu = 'https://gitlab.com/exemple';
    /*
    $_SESSION["inscrit"] = false;
    $_SESSION["chefEquipe"] = false;
    $_SESSION["rendu"] = false;
    */
    function afficherVarSession() {
        foreach ($_SESSION as $nomVariable => $valeurVariable) {
            echo $nomVariable . ' : ' . $valeurVariable . '<br>';
        }
    }
    // afficherVarSession();

?>

<!-- 
Récapitulatif :
    -> présentation du data event : nom, entreprise, dates, description
    - data battle
        -> podium
    - utilisateur connecté
        - inscrit au data event ou gestionnaire ou admin
            -> affichage des données, consignes et conseils du data event
            - étudiant et chef d'équipe
                - n'a encore rien rendu
                    -> affichage de la section de rendu
                - a déjà rendu quelque chose
                    -> liens pour afficher son code et ses résultats + message accusant réception de son code
        - étudiant non inscrit
            - data challenge
                -> choix du projet data
            - data battle
                -> inscription au projet data
        - gestionnaire ou admin
            -> affichage des équipes participantes, de leur rang, du lien d'hébergement de leur code qu'elles ont éventuellement rendu et de leurs résultats
        - etudiant
            -> accès au profil de son équipe
            - chef d'équipe et data battle
                -> accès au questionnaire
    - utilisateur non connecté
        -> message qui lui demande de se connecter
-->

<!DOCTYPE HTML>
<html>
    <head>
        <meta charset="utf-8">
        <title>IA PAU</title>
        <link rel="stylesheet" type="text/css" href="/css/general.css" />
        <link rel="stylesheet" type="text/css" href="/css/header.css" />
        <link rel="stylesheet" type="text/css" href="/css/footer.css" />
        <link rel="stylesheet" type="text/css" href="/css/podium.css" />
        <link rel="stylesheet" type="text/css" href="/css/description-data.css" />
        <link rel="stylesheet" type="text/css" href="/css/partie-equipe.css" />
        <link rel="stylesheet" type="text/css" href="/css/data-event.css" />
    </head>
    <body>
        <?php
            include("../header.php");
        ?>
        <main>
            <?php

                /************************ DESCRIPTION DU PROJET DATA + RENDU ************************/

                // récupération des informations liées au data event de la page
                $conn = connexion($serveur, $bdd, $user, $pass);
                $requeteDataEvent = "SELECT * FROM DataEvent WHERE idDataEvent=".$idDataEvent.";";
                $resultatDataEvent = getAllFromRequest($conn, $requeteDataEvent)[0];
                $conn = deconnexion();

                echo "
                <section>";

                // description des data events - accessible à tous
                echo "
                <div id='presentation-data-challenge'>
                    <h3>".$resultatDataEvent["titre"]."</h3>
                    <div id='infos-data-challenge'>
                        <span>Organisé par ".$resultatDataEvent["entreprise"]." - Du ".$resultatDataEvent["dateDebut"]." au ".$resultatDataEvent["dateFIN"]."</span>
                    </div>
                    <p class='paragraphe-presentation'>".$resultatDataEvent["descript"]."</p>";
            
                // cas 1 : l'utilisateur est connecté
                if ((isset($_SESSION["estConnecte"])) && ($_SESSION["estConnecte"] == true)) {

                    // cas 1.1 : l'utilisateur est inscrit à l'évènement OU il est gestionnaire/admin
                    if ((((isset($_SESSION["inscrit"])) && ($_SESSION["inscrit"]) == true)) || ((isset($_SESSION["typeUtilisateur"])) && (($_SESSION["typeUtilisateur"] == "administrateur") || ($_SESSION["typeUtilisateur"] == "gestionnaire")))) {
                        
                        // partie données
                        echo "
                        <div class='sous-titre-evenement'>
                            <span>Données</span>
                        </div>
                        <p class='paragraphe-presentation'>".$resultatDataEvent["donnees"]."</p>";

                        // partie consignes
                        echo "
                        <div class='sous-titre-evenement'>
                            <span>Consignes</span>
                        </div>
                        <p class='paragraphe-presentation'>".$resultatDataEvent["consignes"]."</p>";

                        // partie conseils
                        echo "
                        <div class='sous-titre-evenement'>
                            <span>Conseils</span>
                        </div>
                        <p class='paragraphe-presentation'>".$resultatDataEvent["conseils"]."</p>";

                        // cas 1.1.1 : l'utilisateur est étudiant et chef d'équipe, il peut donc rendre une archive GitLab
                        // note : chefEquipe => etudiant donc pas besoin de vérifier qu'il est étudiant
                        if ((isset($_SESSION["chefEquipe"])) && ($_SESSION["chefEquipe"] == true)) {

                            echo "
                            <div class='sous-titre-evenement'>
                                <span>Rendu</span>
                            </div>
                            <p class='paragraphe-presentation'>Une fois votre travail terminé, vous pouvez rendre ci-dessous un lien vers un fichier RAW (archive Gitlab ou GitHub). Votre code sera alors analysé et vous pourrez immédiatement consulter vos résultats. Notez que tout rendu est définitif et ne peut pas être annulé.</p>
                            ";

                            // cas 1.1.1.1 : l'étudiant n'a encore rien rendu
                            // --> bouton "envoyer" + input du lien
                            if ($_SESSION["rendu"] == false) {
                                echo "
                                <form method='POST' action='envoi-code.php' id='lien-code-gitlab'>
                                    <div id='texte-input-lien-gitlab'>
                                        <label for='nom'>Lien d'hébergement de votre code :</label>
                                        <input type='text' name='lien_code_gitlab' placeholder='Entrez ici le lien vers votre fichier...' required>
                                    </div>
                                    <div class='boutons-rendu'>
                                        <button type='submit'>Envoyer</button>
                                    </div>
                                </form>";

                            }

                            // cas 1.1.1.2 : l'étudiant a déjà rendu un lien d'hébergement du code
                            // input du lien avec son lien + message de traitement de code ok + boutons "afficher mes résultats" et "consulter mon code"
                            else {
                                echo "
                                <p class='paragraphe-presentation'>Traitement de votre code terminé ! Vous pouvez à présent consulter vos résultats.</p>
                                <div id='lien-code-gitlab'>
                                    <div id='texte-input-lien-gitlab'>
                                        <label for='nom'>Lien d'hébergement de votre code :</label>
                                        <input type='text' name='lien_code_gitlab' value='".$resultatRendu["lienRendu"]."' readonly>
                                    </div>
                                    <div class='boutons-rendu'>
                                        <a href='".$resultatRendu["lienRendu"]."'>Afficher mon code</a>
                                        <a href='#'>Consulter mes résultats</a>
                                    </div>
                                </div>
                                ";
                            }
                            
                        }
                    }

                    // cas 1.2 : l'utilisateur n'est pas inscrit à l'évènement mais est étudiant
                    // il peut donc s'inscrire en créant une équipe et en devenant chef d'équipe
                    // note : l'inverse de "inscrit OU (gestionnaire OU admin)" est "non inscrit et etudiant" donc on peut mettre un simple "else"
                    else {

                        // récupération des projets data associés au data event de la page
                        $conn = connexion($serveur, $bdd, $user, $pass);
                        $requeteProjetsData = "SELECT * FROM ProjetData WHERE idDataEvent=".$idDataEvent.";";
                        $resultatProjetsData = getAllFromRequest($conn, $requeteProjetsData);
                        $conn = deconnexion();

                        // cas 1.2.1 : l'évènement est une data battle
                        if ((isset($resultatDataEvent["typeDataEvent"])) && ($resultatDataEvent["typeDataEvent"] == "DataBattle")) {

                            echo "
                            <div class='sous-titre-evenement'>
                                <span>Projet data associé - ".$resultatProjetsData[0]["titreProjetData"]."</span>
                            </div>
                            <p class='paragraphe-presentation'>".$resultatProjetsData[0]["descriptProjet"]."</p>";

                            echo "
                            <div id='choix-projet-data'>
                                <div id='bouton-inscription' class='bouton-data-event'>
                                    <a href='inscription-projet-data.php?idProjetData=".$resultatProjetsData[0]["idProjetData"]."'>M'inscrire à ce projet data</a>
                                </div>
                            </div>";

                        }

                        // cas 1.2.2 : l'évènement est un data challenge
                        else if ((isset($resultatDataEvent["typeDataEvent"])) && ($resultatDataEvent["typeDataEvent"] == "DataChallenge")) {

                            echo "
                            <div class='sous-titre-evenement'>
                                <span>Choix du projet data</span>
                            </div>
                            <p class='paragraphe-presentation'>".$loremIpsum."</p>";

                            echo "
                            <div id='choix-projet-data'>";
                            foreach ($resultatProjetsData as $projetData) {
                                echo "
                                <div class='projet-data'>
                                    <div class='titre-projet-data'>
                                        <span>".$projetData["titreProjetData"]."</span>
                                    </div>
                                    <p>".$projetData["descriptProjet"]."</p>
                                    <div id='bouton-inscription' class='bouton-data-event'>
                                        <a href='inscription-projet-data.php?idProjetData=".$projetData["idProjetData"]."'>M'inscrire à ce projet data</a>
                                    </div>
                                </div>";
                            }
                            echo "
                            </div>";

                        }

                    }

                }

                // cas 2 : l'utilisateur n'est pas connecté
                // note : pas de "else" au cas où la variable de session "estConnecte" ne serait pas définie
                if ((isset($_SESSION["estConnecte"])) && ($_SESSION["estConnecte"] == false)) {
                    
                    // détermination de la fin du message demandant de s'authentifier pour s'inscrire à l'évènement
                    if (isset($resultatDataEvent["typeDataEvent"]) && ($resultatDataEvent["typeDataEvent"] == "DataChallenge")) {
                        $finMsg = "ce data challenge";
                    }
                    else if (isset($resultatDataEvent["typeDataEvent"]) && ($resultatDataEvent["typeDataEvent"] == "DataBattle")) {
                        $finMsg = "cette data battle";
                    }

                    // affichage du message demandant de s'authentifier pour s'inscrire à l'évènement
                    echo "
                    <div id='message-connexion'>
                        <span>Veuillez vous connecter pour vous inscrire à ".$finMsg.".</span>
                    </div>";

                }
                
                echo "
                </section>";

                /************************ PODIUM ************************/

                // le podium ne s'affiche que pour une data battle, pas pour les data challenges
                // note : il est accessible à tous, même aux utilisateurs non connectés
                if ($resultatDataEvent["typeDataEvent"] == "DataBattle") {

                    // récupération des scores de chaque équipe pour la data battle de la page
                    $conn = connexion($serveur, $bdd, $user, $pass);
                    $requetePodium = "SELECT idEquipe, nomEquipe, SUM(note) AS score FROM Reponse NATURAL JOIN Question NATURAL JOIN Questionnaire NATURAL JOIN Equipe WHERE idDataEvent=".$idDataEvent." GROUP BY idEquipe, idDataEvent ORDER BY score DESC;";
                    $resultatPodium = getAllFromRequest($conn, $requetePodium);
                    $conn = deconnexion();

                    /*
                    $resultatPodium = array(
                        array(
                            "idEquipe" => 1,
                            "nomEquipe" => "Les Faucons Électriques",
                            "score" => 4, 
                        ), 
                        array(
                            "idEquipe" => 8,
                            "nomEquipe" => "Les Ombres Éternelles",
                            "score" => 3, 
                        ),
                        array(
                            "idEquipe" => 11,
                            "nomEquipe" => "Les Sorciers du Ciel", 
                            "score" => 2, 
                        )
                    );
                    */

                    echo "
                    <section>";

                    // titre de la section du podium
                    echo "
                    <div class='sous-titre-evenement'>
                        <span>Podium de la semaine</span>
                    </div>";

                    // aucune équipe n'a encore répondu au questionnaire lié à la data battle de la page
                    if (empty($resultatPodium)) {

                        // texte expliquant qu'aucune équipe n'a répondu au questionnaire pour cette data battle
                        echo "
                        <div id='texte-podium'>
                            <p class='paragraphe-presentation'>Le podium n'est pas disponible car aucune équipe n'a encore répondu au questionnaire lié à cette data battle, revenez-plus tard !</p>
                        </div>";

                    }

                    // au moins une équipe a répondu au questionnaire lié à la data battle de la page
                    else {

                        $hauteurPremier = 200;
                        $hauteurSecond = ($resultatPodium[1]["score"]/$resultatPodium[0]["score"])*$hauteurPremier;
                        $hauteurTroisieme = ($resultatPodium[2]["score"]/$resultatPodium[0]["score"])*$hauteurPremier; 
                        $hauteurSecondSiInexistant = ($hauteurPremier/3)*2;
                        $hauteurTroisiemeSiInexistant = $hauteurPremier/3;

                        // texte "d'introduction" au podium
                        echo "
                        <div id='texte-podium'>
                            <p class='paragraphe-presentation'>Et voici, comme chaque semaine, le podium des trois meilleures équipes de cette data battle. Toutes nos félicitations !</p>
                        </div>";

                        echo "
                        <div id='podium'>";

                        // affichage de la seconde place
                        if (count($resultatPodium) >= 2) {
                            echo "
                            <div id='seconde-place' class='place'>
                                <div class='barre-score' id='barre-score-second' style='height: ".$hauteurSecond."px;'></div>
                                <div class='infos-score'>
                                    <div class='rang'>
                                        <span id='second'>2<sup>nd</sup></span>
                                    </div>
                                    <div class='nom-equipe'>
                                        <span>".$resultatPodium[1]["nomEquipe"]."</span>
                                    </div>
                                    <div class='score'>
                                        <span>".$resultatPodium[1]["score"]." points</span>
                                    </div>
                                </div>
                            </div>";
                        }
                        else {
                            echo "
                            <div id='seconde-place' class='place'>
                                <div class='barre-score' id='barre-score-second' style='height: ".$hauteurSecondSiInexistant."px;'></div>
                                <div class='infos-score'>
                                    <div class='rang'>
                                        <span id='second'>2<sup>nd</sup></span>
                                    </div>
                                    <div class='nom-equipe'>
                                        <span>?????</span>
                                    </div>
                                </div>
                            </div>";
                        }

                        // affichage de la première place (qui existe forcément car $resultatPodium non vide)
                        echo "
                        <div id='premiere-place' class='place'>
                            <div class='barre-score' id='barre-score-premier' style='height: ".$hauteurPremier."px;'></div>
                            <div class='infos-score'>
                                <div class='rang'>
                                    <span id='premier'>1<sup>er</sup></span>
                                </div>
                                <div class='nom-equipe'>
                                    <span>".$resultatPodium[0]["nomEquipe"]."</span>
                                </div>
                                <div class='score'>
                                    <span>".$resultatPodium[0]["score"]." points</span>
                                </div>
                            </div>
                        </div>";

                        // affichage de la troisième place
                        if (count($resultatPodium) >= 3) {
                            echo "
                            <div id='troisieme-place' class='place'>
                                <div class='barre-score' id='barre-score-troisieme' style='height: ".$hauteurTroisieme."px;'></div>
                                <div class='infos-score'>
                                    <div class='rang'>
                                        <span id='troisieme'>3<sup>e</sup></span>
                                    </div>
                                    <div class='nom-equipe'>
                                        <span>".$resultatPodium[2]["nomEquipe"]."</span>
                                    </div>
                                    <div class='score'>
                                        <span>".$resultatPodium[2]["score"]." points</span>
                                    </div>
                                </div>
                            </div>";
                        }
                        else {
                            echo "
                            <div id='troisieme-place' class='place'>
                                <div class='barre-score' id='barre-score-troisieme' style='height: ".$hauteurTroisiemeSiInexistant."px;'></div>
                                <div class='infos-score'>
                                    <div class='rang'>
                                        <span id='troisieme'>3<sup>e</sup></span>
                                    </div>
                                    <div class='nom-equipe'>
                                        <span>?????</span>
                                    </div>
                                </div>
                            </div>";
                        }

                        // fermeture de la div d'id "podium"
                        echo "
                        </div>";
                    }

                    echo "
                    </section>";
                    
                }

                /************************ SYNTHÈSE DES PROJETS DATA + ACCÈS AU PROFIL/À LA GESTION DES ÉQUIPES ************************/

                // l'utilisateur doit être connecté pour afficher cette section
                if ((isset($_SESSION["estConnecte"])) && ($_SESSION["estConnecte"] == true)) {

                    echo "
                    <section>";

                    // cas 1 : l'utilisateur est un admin ou un gestionnaire
                    if (isset($_SESSION["typeUtilisateur"]) && (($_SESSION["typeUtilisateur"] == "gestionnaire") || ($_SESSION["typeUtilisateur"] == "administrateur"))) {

                        // affichage du titre de la section
                        echo "
                        <div class='sous-titre-evenement'>
                            <span>Équipes participantes</span>
                        </div>
                        <p class='paragraphe-presentation'>
                            En tant que gestionnaire, vous avez ici la possibilité de suivre la progression de l'événement pour chaque équipe. Vous trouverez ci-dessous la liste des équipes participantes ainsi que le projet data auquel elles sont inscrites. Pour les équipes qui ont déjà soumis leur code, la date de rendu ainsi que les liens vers leur code et leurs résultats seront également disponibles.
                        </p>";

                        // affichage de la liste des équipes participantes
                        echo "
                        <div id='conteneur-liste-equipes'>
                            <div id='bouton-gestion-equipes' class='bouton-data-event'>
                                <a href='#'>Gérer les équipes</a>
                            </div>
                            <div id='liste-equipes'>";

                        // première requête : liste des équipes à afficher
                        // seconde requête : détail des équipes (lien éventuel du code + résultat + date de rendu)
                        $conn = connexion($serveur, $bdd, $user, $pass);
                        $requeteListeEquipesParticipantes = "SELECT nomEquipe FROM Equipe NATURAL JOIN ProjetData WHERE idDataEvent=".$idDataEvent.";";
                        $requeteRendus = "SELECT dateRendu, lienRendu, resultatJson, nomEquipe, titreProjetData FROM Rendu NATURAL JOIN ProjetData NATURAL JOIN Equipe WHERE idDataEvent=".$idDataEvent.";";
                        $resultatListeEquipesParticipantes = getAllFromRequest($conn, $requeteListeEquipesParticipantes);
                        $resultatRendus = getAllFromRequest($conn, $requeteRendus);
                        $conn = deconnexion();

                        foreach ($resultatListeEquipesParticipantes as $equipe) {

                            echo "
                            <div class='equipe'>
                                <div class='nom-equipe'>
                                    <span>".$equipe["nomEquipe"]."</span>
                                </div>
                                <div class='projet-rendu'>";

                            $projetRenduEquipe = false;
                            foreach ($resultatRendus as $rendu) {

                                // une archive a été rendue
                                if ($rendu['nomEquipe'] == $equipe['nomEquipe']) {

                                    echo "
                                    <div class='date-rendu-et-code'>
                                        <span>Date du rendu : ".$rendu["dateRendu"]."</span>
                                    </div>
                                    <div class='date-rendu-et-code'>
                                        <span>Lien du code : <a href='".$rendu["lienRendu"]."'>".$rendu["lienRendu"]."</a></span>
                                    </div>
                                    <div class='bouton-data-event'>
                                        <a href='".$rendu["resultatJson"]."'>Accéder aux résultats de cette équipe</a>
                                    </div>";
                                    $projetRenduEquipe = true;
                                    break;

                                }

                            }

                            // aucune archive n'a été rendue
                            if ($projetRenduEquipe == false) {
                                echo "
                                <div class='partie-code-non-rendu'>
                                    <p>Aucun code n'a encore été rendu par cette équipe.</p>
                                </div>";
                            }

                            echo "
                                </div>
                            </div>";
                            
                        }

                    }

                    // cas 2 : l'utilisateur est un étudiant inscrit
                    // l'utilisateur doit être un étudiant inscrit à l'évènement pour pouvoir afficher cette section
                    // note : pas besoin de vérifier qu'il est étudiant puisque inscrit => étudiant
                    if (isset($_SESSION["inscrit"]) && ($_SESSION["inscrit"] == true)) {

                        // texte à afficher en fonction de si l'utilisateur est chef d'équipe ou non et du type de data event (data challenge ou data battle)
                        if (isset($_SESSION["chefEquipe"]) && ($_SESSION["chefEquipe"] == true)) {
                            if ($resultatDataEvent["typeDataEvent"] == "DataChallenge") {
                                $textePartieEquipe = "Si vous désirez accéder au profil de votre équipe, cliquez ci-dessous. Vous pourrez non seulement accéder à la liste de vos coéquipiers et à la messagerie mais, en tant que chef d'équipe, vous pourrez également gérer les membres (ajout ou suppression) et contacter les gestionnaires.";
                            }
                            else if ($resultatDataEvent["typeDataEvent"] == "DataBattle") {
                                $textePartieEquipe = "Si vous désirez accéder au profil de votre équipe, cliquez ci-dessous. Vous pourrez non seulement accéder à la liste de vos coéquipiers et à la messagerie mais, en tant que chef d'équipe, vous pourrez également gérer les membres (ajout ou suppression) et contacter les gestionnaires. De plus, comme vous avez décidé de participer à une data battle, vous devrez répondre au questionnaire ci-contre. Chaque réponse est notée sur un point. L'envoi du questionnaire est définitif, relisez-vous bien !";
                            }
                        }
                        else if (isset($_SESSION["chefEquipe"]) && ($_SESSION["chefEquipe"] == false)) {
                            $textePartieEquipe = "Si vous désirez accéder au profil de votre équipe, cliquez ci-dessous. Vous pourrez alors accéder à la liste de vos coéquipiers et à la messagerie.";
                        }

                        // affichage du titre de la section
                        echo "
                        <div class='sous-titre-evenement'>
                            <span>Mon équipe</span>
                        </div>
                        <p class='paragraphe-presentation'>".$textePartieEquipe."</p>";

                        // bouton d'accès à la page de l'équipe pour le data event sélectionné
                        echo "
                        <div id='bouton-acces-equipe' class='bouton-data-event'>
                            <a href='#'>Accéder au profil de mon équipe</a>
                        </div>";

                        // l'étudiant est le chef de son équipe et il s'agit d'une data battle
                        if ((isset($_SESSION["chefEquipe"])) && ($_SESSION["chefEquipe"] == true)) {

                            // récupération des intitulés des questions
                            // note : on ne vérifie pas que c'est une data battle, pas besoin si la BDD est correcte
                            $conn = connexion($serveur, $bdd, $user, $pass);
                            $requeteQuestions = "SELECT idQuestion, intitule FROM Question NATURAL JOIN Questionnaire WHERE idDataEvent=".$idDataEvent.";";
                            $resultatQuestions = getAllFromRequest($conn, $requeteQuestions);
                            $conn = deconnexion();
                            $_SESSION["questionsDataBattlePage"] = $resultatQuestions;

                            if (!empty($resultatQuestions)) {
                                
                                // affichage du questionnaire
                                echo "
                                <div id='questionnaire'>
                                    <form method='POST' action='envoi-reponses.php'>";
                                $i = 1;
                                foreach ($resultatQuestions as $question) {
                                    echo "
                                    <div class='question'>
                                        <label for='question".$i."'><span class='gras'>".$i."</span>. ".$question["intitule"]."</label>
                                        <input type='text' name='question".$i."' placeholder='Votre réponse...' required>
                                    </div>";
                                    $i++;
                                }
                                echo "
                                        <div id='bouton-envoi-questionnaire' class='bouton-data-event'>
                                            <button type='submit'>Envoyer mes réponses</button>
                                        </div>
                                    </form>
                                </div>";

                            }
                        }
                    }

                    echo "
                    </section>";

                }
            ?>
        </main>
        <?php
            include("../footer.php");
        ?>
    </body>
</html>