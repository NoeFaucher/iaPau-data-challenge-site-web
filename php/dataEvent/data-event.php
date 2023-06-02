<?php

    // initialisation
    session_start();
    include("../bdd.php");
    include("../varSession.inc.php");

    // récupération de l'id du data event par la méthode GET (dans l'URL)
    $idDataEvent = $_GET["idDataEvent"];
    $_SESSION["idDataEventPage"] = $idDataEvent;

    // récupération des informations liées au data event de la page
    $conn = connexion($serveur, $bdd, $user, $pass);
    $requeteDataEvent = "SELECT * FROM DataEvent WHERE idDataEvent=".$idDataEvent.";";
    $resultatDataEvent = getAllFromRequest($conn, $requeteDataEvent)[0];
    $conn = deconnexion();

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

?>

<!-- 
Récapitulatif :
    -> présentation du data event : nom, entreprise, dates, description
    -> affichage des données, consignes et conseils du data event
    - data battle
        -> podium
    - utilisateur connecté
        - inscrit au data event (=> étudiant)
            -> rappel du projet data auquel il est inscrit
            -> affichage des contacts liés à ce projet data (contacts externes, gestionnaires, administrateurs)
            - l'équipe de l'utilisateur a déjà rendu quelque chose
                - l'utilisateur est chef d'une équipe qui participe au data event de la page
                    -> il peut consulter tous les liens qu'il a déjà envoyé
                    -> il peut rendre un nouveau lien
                - l'utilisateur n'est pas le chef de son équipe (celle qui participe au data event de la page)
                    -> il peut consulter les différents codes que son chef d'équipe a déjà rendu
            - l'équipe de l'utilisateur n'a encore rien rendu
                - l'utilisateur est chef d'une équipe qui participe au data event de la page
                    -> il peut rendre un nouveau lien
                - l'utilisateur n'est pas le chef de son équipe (celle qui participe au data event de la page)
                    -> message qui lui dit qu'aucun code n'a encore été rendu par son chef d'équipe
            -> accès au profil de son équipe
            - chef d'équipe et data battle
                - a déjà répondu au questionnaire
                - n'a pas encore répondu au questionnaire
                    -> accès au questionnaire
                - a déjà répondu au questionnaire
                    -> peut voir ses réponses mais ne peut pas le renvoyer à nouveau
        - non inscrit ou admin ou gestionnaire
            -> affichage de tous les projets data
            - étudiant
                -> boutons pour s'inscrire aux projets data
        - gestionnaire ou admin
            -> affichage de toutes les équipes qui participent au data event, avec le projet data qu'elles ont choisi + la date du dernier rendu + liens vers leurs résultats et leur dernier rendu
    - utilisateur non connecté
        - affichage de tous les projets data, le bouton pour s'inscrire redirige vers la page de connexion
-->

<!DOCTYPE HTML>
<html>
    <head>
        <meta charset="utf-8">
        <title><?php echo $resultatDataEvent["titre"]; ?></title>
        <link rel="stylesheet" type="text/css" href="/css/general-data-event.css" />
        <link rel="stylesheet" type="text/css" href="/css/header.css" />
        <link rel="stylesheet" type="text/css" href="/css/data-event.css" />
        <script src="../../js/rendu.js"></script>
    </head>
    <body>
        <?php
            include("../header.php");
        ?>
        <main>
            <?php

                /************************ DESCRIPTION DU PROJET DATA + RENDU ************************/

                echo "
                <section>";

                // description des data events
                echo "
                <div id='presentation-data-challenge'>
                    <h3>".$resultatDataEvent["titre"]."</h3>
                    <div id='infos-data-challenge'>
                        <span>Organisé par ".$resultatDataEvent["entreprise"]." - Du ".$resultatDataEvent["dateDebut"]." au ".$resultatDataEvent["dateFin"]."</span>
                    </div>
                    <p class='paragraphe-presentation'>".$resultatDataEvent["descript"]."</p>";

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
            
                // cas 1 : l'utilisateur est connecté
                if ((isset($_SESSION["estConnecte"])) && ($_SESSION["estConnecte"] == true)) {

                    // cas 1.1 : l'utilisateur est inscrit à l'évènement OU il est gestionnaire/admin
                    if ((isset($_SESSION["inscrit"])) && (($_SESSION["inscrit"]) == true)) {

                        // connexion à la base de données
                        $conn = connexion($serveur, $bdd, $user, $pass);

                        // récupération du projet data auquel est inscrit l'équipe de l'utilisateur
                        $requeteIdProjetData = "SELECT idProjetData FROM Equipe WHERE idEquipe=".$_SESSION["idEquipeUtilisateurPage"].";";
                        $idProjetDataEquipeUtilisateur = getAllFromRequest($conn, $requeteIdProjetData)[0]["idProjetData"];
                        
                        // récupération des informations liées à ce projet data
                        $requeteInfosProjetData = "SELECT * FROM ProjetData WHERE idProjetData=".$idProjetDataEquipeUtilisateur.";";
                        $resultatInfosProjetData = getAllFromRequest($conn, $requeteInfosProjetData)[0];

                        // récupération des contacts liés au projet data
                        $requeteContacts = "SELECT * FROM Contact WHERE idProjetData=".$idProjetDataEquipeUtilisateur.";";
                        $resultatContacts = getAllFromRequest($conn, $requeteContacts);

                        // récupération du/des gestionnaire(s) associé au data event
                        $requeteGestionnaire = "SELECT idUtilisateur, nom, prenom, email, telephone FROM Utilisateur NATURAL JOIN DataEvent WHERE DataEvent.idGestionnaire=Utilisateur.idUtilisateur AND DataEvent.idDataEvent=".$idDataEvent.";";
                        $resultatGestionnaire = getAllFromRequest($conn, $requeteGestionnaire);

                        // récupération du/des admins
                        $requeteAdmin = "SELECT idUtilisateur, nom, prenom, email, telephone FROM Utilisateur WHERE typeUtilisateur='administrateur'";
                        $resultatAdmin = getAllFromRequest($conn, $requeteAdmin);

                        // déconnexion de la base de données
                        $conn = deconnexion();

                        // affichage du projet data choisi
                        echo "
                        <div class='sous-titre-evenement'>
                            <span>Projet data choisi - \"".$resultatInfosProjetData["titreProjetData"]."\"</span>
                        </div>
                        <p class='paragraphe-presentation'>Pour rappel, vous vous êtes inscrit au projet data suivant :</p>
                        <p class='paragraphe-presentation italique'>".$resultatInfosProjetData["descriptProjet"]."</p>";

                        echo "
                        <div class='sous-titre-evenement'>
                            <span>Contacts</span>
                        </div>
                        <p class='paragraphe-presentation'>En cas de doute, vous pouvez contacter l'une des personnes ci-dessous par mail ou par téléphone :</p>
                        <div id='div-table-contacts'>
                            <table id='table-contacts'>
                                <tr>
                                    <th>Nom</th>
                                    <th>Role</th>
                                    <th>Email</th>
                                    <th>Numéro de téléphone</th>
                                </tr>";

                        // affichage des contacts liés au projet data
                        if (!empty($resultatContacts)) {
                            foreach ($resultatContacts as $contact) {
                                echo "
                                <tr>
                                    <td>".$contact["prenom"]." ".$contact["nom"]."</td>
                                    <td>externe</td>
                                    <td>".$contact["email"]."</td>
                                    <td>".$contact["telephone"]."</td>
                                </tr>";
                            }
                        }
                        if (!empty($resultatGestionnaire)) {
                            foreach ($resultatGestionnaire as $gestionnaire) {
                                echo "
                                <tr>
                                    <td>".$gestionnaire["prenom"]." ".$gestionnaire["nom"]."</td>
                                    <td>gestionnaire</td>
                                    <td>".$gestionnaire["email"]."</td>
                                    <td>".$gestionnaire["telephone"]."</td>
                                </tr>";
                            }
                        }
                        if (!empty($resultatAdmin)) {
                            foreach ($resultatAdmin as $admin) {
                                echo "
                                <tr>
                                    <td>".$admin["prenom"]." ".$admin["nom"]."</td>
                                    <td>administrateur</td>
                                    <td>".$admin["email"]."</td>
                                    <td>".$admin["telephone"]."</td>
                                </tr>";
                            }
                        }
                        echo "
                            </table>
                        </div>";
                       
                        echo "
                        <div class='sous-titre-evenement'>
                            <span>Rendus</span>
                        </div>
                        <p class='paragraphe-presentation'>Une fois votre travail terminé, vous pouvez rendre ci-dessous un lien vers un fichier RAW (archive Gitlab ou GitHub). Votre code sera alors analysé et vous pourrez immédiatement consulter vos résultats. Notez que tout rendu est définitif et ne peut pas être annulé.</p>";

                        // cas 1.1.1 : l'équipe de l'utilisateur a déjà rendu quelque chose
                        // input du lien avec son lien + message de traitement de code ok + boutons "afficher mes résultats" et "consulter mon code"
                        // note : rendu = true => typeUtilisateur = normal
                        if ($_SESSION["rendu"] == true) {

                            // cas 1.1.1.1 : l'utilisateur est étudiant et chef d'équipe, il peut donc rendre une archive GitLab
                            // note : chefEquipe => etudiant donc pas besoin de vérifier qu'il est étudiant
                            if ((isset($_SESSION["chefEquipe"])) && ($_SESSION["chefEquipe"] == true)) {

                                echo "
                                <p class='paragraphe-presentation'>Vous avez déjà envoyé du code, vous pouvez donc à présent consulter vos résultats.</p>
                                <div id='texte-input-lien-gitlab'>
                                    <label for='nom'>Lien d'hébergement de votre code :</label>
                                    <input type='text' name='lien_code_gitlab' id='lien_code_gitlab' placeholder='Entrez ici le lien vers votre fichier...' required>  
                                </div>
                                <div id='message-erreur-ou-reussite'>
                                    <p id='retour-sur-envoi'></p>
                                </div>
                                <div class='boutons-rendu'>
                                    <input type='button' onclick='envoyerCode(this,".$_SESSION["idEquipeUtilisateurPage"].")' value='Envoyer'>
                                    <a href='rendu.php?equipe=".$_SESSION["idEquipeUtilisateurPage"]."'>Consulter mes résultats</a>
                                </div>";

                            }

                            // cas 1.1.1.2 : l'utilisateur n'est pas chef d'équipe
                            else {
                                echo "
                                <p class='paragraphe-presentation'>Votre chef d'équipe a déjà envoyé du code, vous pouvez donc à présent consulter vos résultats.</p>
                                <div class='boutons-rendu'>
                                    <input type='button' onclick='envoyerCode(this,".$_SESSION["idEquipeUtilisateurPage"].")' value='Envoyer'>
                                    <a href='rendu.php?equipe=".$_SESSION["idEquipeUtilisateurPage"]."'>Consulter mes résultats</a>
                                </div>";
                            }

                            // récupération de tous les rendus réalisés par l'équipe de l'utilisateur
                            $conn = connexion($serveur, $bdd, $user, $pass);
                            $requeteRendusEquipe = "SELECT idRendu, dateRendu, lienRendu FROM Rendu WHERE idEquipe=".$_SESSION["idEquipeUtilisateurPage"].";";
                            $resultatRendusEquipe = getAllFromRequest($conn, $requeteRendusEquipe);
                            $conn = deconnexion();

                            // affichage de tous les rendus réalisés par l'équipe de l'utilisateur
                            echo "
                            <div id='rendus-equipe'>
                                <div id='titre-rendus-equipe'>
                                    <span>Rendus de mon équipe</span>
                                </div>
                                <ul id='liste-rendus-equipe'>";

                            foreach ($resultatRendusEquipe as $rendu) {
                                echo "
                                <li class='paragraphe-presentation'>".$rendu["dateRendu"]." : <a href='".$rendu["lienRendu"]."'>".$rendu["lienRendu"]."</a></li>";
                            }
                            
                            echo "
                                </ul>
                            </div>";
                        }

                        // cas 1.1.2 : l'équipe de l'utilisateur n'a encore rien rendu
                        else {

                            // cas 1.1.2.1 : l'utilisateur est étudiant et chef d'équipe, il peut donc rendre une archive GitLab
                            // note : chefEquipe => etudiant donc pas besoin de vérifier qu'il est étudiant
                            if ((isset($_SESSION["chefEquipe"])) && ($_SESSION["chefEquipe"] == true)) {

                                echo "
                                <p class='paragraphe-presentation'>Vous pourrez consulter vos résultats après votre premier rendu.</p>
                                <div id='texte-input-lien-gitlab'>
                                    <label for='nom'>Lien d'hébergement de votre code :</label>
                                    <input type='text' name='lien_code_gitlab' id='lien_code_gitlab' placeholder='Entrez ici le lien vers votre fichier...' required>
                                </div>
                                <div id='message-erreur-ou-reussite'>
                                    <p id='retour-sur-envoi'></p>
                                </div>
                                <div class='boutons-rendu'>
                                    <input type='button' onclick='envoyerCode(this,".$_SESSION["idEquipeUtilisateurPage"].")' value='Envoyer'>
                                </div>";

                            }

                            // cas 1.1.2.2 : l'utilisateur n'est pas chef d'équipe
                            else {

                                echo "
                                <p class='paragraphe-presentation'>Votre chef d'équipe n'a encore rien rendu, revenez plus tard.</p>";

                            }

                            // affichage des rendus réalisés par l'équipe de l'utilisateur (aucun pour le moment mais le dernier est ajouté en AJAX donc partie nécessaire)
                            echo "
                            <div id='rendus-equipe'>
                                <div id='titre-rendus-equipe'>
                                    <span></span>
                                </div>
                                <ul id='liste-rendus-equipe'></ul>
                            </div>";

                        }

                    }

                    // cas 1.2 : l'utilisateur n'est pas inscrit à l'évènement (donc étudiant non inscrit ou admin)
                    // il peut donc s'inscrire en créant une équipe et en devenant chef d'équipe (pour les étudiants seulement)
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
                                <span>Projet data associé - \"".$resultatProjetsData[0]["titreProjetData"]."\"</span>
                            </div>
                            <p class='paragraphe-presentation'>".$resultatProjetsData[0]["descriptProjet"]."</p>";

                            // seuls les étudiants peuvent s'inscrire au data event
                            if ((isset($_SESSION["typeUtilisateur"])) && (($_SESSION["typeUtilisateur"]) == "normal")) {
                                echo "
                                <div id='choix-projet-data'>
                                    <div class='bouton-data-event'>
                                        <a href='inscription-projet-data.php?idProjetData=".$resultatProjetsData[0]["idProjetData"]."'>M'inscrire à ce projet data</a>
                                    </div>
                                </div>";
                            }
                            
                        }

                        // cas 1.2.2 : l'évènement est un data challenge
                        else if ((isset($resultatDataEvent["typeDataEvent"])) && ($resultatDataEvent["typeDataEvent"] == "DataChallenge")) {

                            echo "
                            <div class='sous-titre-evenement'>
                                <span>Choix du projet data</span>
                            </div>";

                            echo "
                            <div id='choix-projet-data'>";
                            foreach ($resultatProjetsData as $projetData) {
                                
                                echo "
                                <div class='projet-data'>
                                    <div class='titre-projet-data'>
                                        <span>".$projetData["titreProjetData"]."</span>
                                    </div>
                                    <p>".$projetData["descriptProjet"]."</p>";
                                
                                // seuls les étudiants peuvent s'inscrire au data event
                                if ((isset($_SESSION["typeUtilisateur"])) && (($_SESSION["typeUtilisateur"]) == "normal")) {
                                    echo "
                                    <div class='bouton-data-event'>
                                        <a href='inscription-projet-data.php?idProjetData=".$projetData["idProjetData"]."'>M'inscrire à ce projet data</a>
                                    </div>";
                                }

                                echo "
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
                            <div class='bouton-data-event'>
                                <a href='../connexion/connexion.php'>M'inscrire à ce projet data</a>
                            </div>
                        </div>";

                    }

                    // cas 1.2.2 : l'évènement est un data challenge
                    else if ((isset($resultatDataEvent["typeDataEvent"])) && ($resultatDataEvent["typeDataEvent"] == "DataChallenge")) {

                        echo "
                        <div class='sous-titre-evenement'>
                            <span>Choix du projet data</span>
                        </div>";

                        echo "
                        <div id='choix-projet-data'>";
                        foreach ($resultatProjetsData as $projetData) {
                            echo "
                            <div class='projet-data'>
                                <div class='titre-projet-data'>
                                    <span>".$projetData["titreProjetData"]."</span>
                                </div>
                                <p>".$projetData["descriptProjet"]."</p>
                                <div class='bouton-data-event'>
                                    <a href='../connexion/connexion.php'>M'inscrire à ce projet data</a>
                                </div>
                            </div>";
                        }
                        echo "
                        </div>";

                    }

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
                        if ((count($resultatPodium) >= 2) && (isset($resultatPodium[1]["score"]))) {
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
                        if ((count($resultatPodium) >= 3) && (isset($resultatPodium[2]["score"]))) {
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
                        <p class='paragraphe-presentation'>En tant que gestionnaire, vous avez ici la possibilité de suivre la progression de l'événement pour chaque équipe. Vous trouverez ci-dessous la liste des équipes participantes ainsi que le projet data auquel elles sont inscrites. Pour les équipes qui ont déjà soumis leur code, la date de rendu ainsi que les liens vers leur code et leurs résultats seront également disponibles.</p>";

                        // affichage de la liste des équipes participantes
                        echo "
                        <div id='conteneur-liste-equipes'>
                            <div id='bouton-gestion-equipes' class='bouton-data-event'>
                                <a href='../equipe/equipe.php'>Gérer les équipes</a>
                            </div>
                            <div id='liste-equipes'>";

                        // première requête : liste des équipes à afficher
                        // seconde requête : détail des équipes (lien éventuel du code + résultat + date de rendu)
                        $conn = connexion($serveur, $bdd, $user, $pass);
                        $requeteListeEquipesParticipantes = "SELECT idEquipe, nomEquipe FROM Equipe NATURAL JOIN ProjetData WHERE idDataEvent=".$idDataEvent.";";
                        $requeteRendus = "SELECT dateRendu, lienRendu, nomEquipe, titreProjetData FROM Rendu NATURAL JOIN ProjetData NATURAL JOIN Equipe WHERE idDataEvent=".$idDataEvent.";";
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
                            $tableauRendusEquipe = array();
                            foreach ($resultatRendus as $rendu) {

                                // une archive a été rendue
                                if ($rendu['nomEquipe'] == $equipe['nomEquipe']) {

                                    $projetRenduEquipe = true;
                                    array_push($tableauRendusEquipe, $rendu);

                                }

                            }

                            // une archive a été rendue
                            if ($projetRenduEquipe == true) {

                                // récupération du dernier rendu
                                $dernierLienRendu = end($tableauRendusEquipe)["lienRendu"];
                                $derniereDateRendu = end($tableauRendusEquipe)["dateRendu"];
                                $titreProjetData = end($tableauRendusEquipe)["titreProjetData"];

                                // raccourcissement éventuel du lien rendu
                                $longueurMaximale = 40;

                                if (strlen($dernierLienRendu) > $longueurMaximale) {
                                    $texteLienFinal = substr($dernierLienRendu, 0, $longueurMaximale)."...";
                                }
                                else {
                                    $texteLienFinal = $dernierLienRendu;
                                }

                                // affichage du rendu
                                echo "
                                <div class='date-rendu-et-code'>
                                    <p>Projet data choisi : ".$titreProjetData."</p>
                                    <span>Date du dernier rendu : ".$derniereDateRendu."</span>
                                    <p>Lien du dernier code : <a href='".$dernierLienRendu."'>".$texteLienFinal."</a></p>
                                </div>
                                <div class='bouton-data-event'>
                                    <a href='rendu.php?equipe=".$equipe["idEquipe"]."'>Accéder aux résultats de cette équipe</a>
                                </div>";
                                
                            }

                            // aucune archive n'a été rendue
                            else {
                                echo "
                                <p>Projet data choisi : ".$titreProjetData."</p>
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

                        // texte à afficher en fonction du statut de l'utilisateur (chef d'équipe ou non)
                        if (isset($_SESSION["chefEquipe"]) && ($_SESSION["chefEquipe"] == true)) {
                            $textePartieEquipe = "Si vous désirez accéder au profil de votre équipe, cliquez ci-dessous. Vous pourrez non seulement accéder à la liste de vos coéquipiers et à la messagerie mais, en tant que chef d'équipe, vous pourrez également gérer les membres (ajout ou suppression).";
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
                            <a href='../equipe/equipe.php'>Accéder au profil de mon équipe</a>
                        </div>";

                        // l'étudiant est le chef de son équipe
                        if ((isset($_SESSION["chefEquipe"])) && ($_SESSION["chefEquipe"] == true)) {

                            // récupération des intitulés des questions
                            // note : on ne vérifie pas que c'est une data battle, pas besoin si la base de données est correcte
                            $conn = connexion($serveur, $bdd, $user, $pass);
                            $requeteQuestions = "SELECT idQuestion, intitule, titre FROM Question NATURAL JOIN Questionnaire WHERE idDataEvent=".$idDataEvent." AND idQuestionnaire=(SELECT idQuestionnaire FROM Questionnaire WHERE idDataEvent=".$idDataEvent." ORDER BY dateCreation DESC LIMIT 1);";
                            $resultatQuestions = getAllFromRequest($conn, $requeteQuestions);
                            $conn = deconnexion();
                            $_SESSION["questionsDataBattlePage"] = $resultatQuestions;

                            // on vérifie si l'équipe a déjà répondu à ce questionnaire
                            $conn = connexion($serveur, $bdd, $user, $pass);
                            $requeteVerificationNonRepondu = "SELECT * FROM Reponse NATURAL JOIN Questionnaire WHERE idEquipe=".$_SESSION["idEquipeUtilisateurPage"]." AND idDataEvent=".$idDataEvent." AND idQuestionnaire=(SELECT idQuestionnaire FROM Questionnaire WHERE idDataEvent=".$idDataEvent." ORDER BY dateCreation DESC LIMIT 1);";
                            $resultatVerificationNonRepondu = getAllFromRequest($conn, $requeteVerificationNonRepondu);
                            $conn = deconnexion();
                            
                            // si l'équipe n'a pas encore répondu au questionnaire et qu'un questionnaire est bien relié à la data battle, elle peut y répondre
                            if ((empty($resultatVerificationNonRepondu)) && (!empty($resultatQuestions))) {

                                // texte à afficher seulement pour les data battles
                                if ($resultatDataEvent["typeDataEvent"] == "DataBattle") {
                                    echo "
                                    <p class='paragraphe-presentation'>De plus, comme vous avez décidé de participer à une data battle, vous devrez répondre au questionnaire ci-contre. Chaque réponse est notée sur un point. L'envoi du questionnaire est définitif, relisez-vous bien !</p>";
                                }

                                echo "<p class='paragraphe-presentation italique'>".$resultatQuestions[0]["titre"]."</p>";

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

                            // si l'équipe a déjà répondu au questionnaire, on l'affiche mais elle ne peut plus y répondre
                            else if ((!empty($resultatVerificationNonRepondu)) && (!empty($resultatQuestions))) {

                                // texte à afficher seulement pour les data battles
                                if ($resultatDataEvent["typeDataEvent"] == "DataBattle") {
                                    echo "
                                    <p class='paragraphe-presentation'>Vous retrouverez ci-dessous les réponses au questionnaire que vous avez envoyé.</p>";
                                }
                                
                                echo "<p class='paragraphe-presentation italique'>".$resultatQuestions[0]["titre"]."</p>";
                                
                                echo "
                                <div id='questionnaire-repondu'>";

                                $i = 1;
                                foreach ($resultatQuestions as $question) {
                                    foreach ($resultatVerificationNonRepondu as $reponse) {
                                        if ($reponse["idQuestion"] == $question["idQuestion"]) {
                                            echo "
                                            <div class='question'>
                                                <label for='question".$i."'><span class='gras'>".$i."</span>. ".$question["intitule"]."</label>
                                                <input type='text' name='question".$i."' placeholder='Votre réponse...' value='".$reponse["reponse"]."' readonly>
                                            </div>";
                                            $i++;
                                        }
                                    }
                                }

                                echo "
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
