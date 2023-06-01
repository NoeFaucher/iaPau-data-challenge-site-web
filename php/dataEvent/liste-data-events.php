<?php
    session_start();
    include("../bdd.php");
?>

<!DOCTYPE HTML>
<html>
    <head>
        <meta charset="utf-8">
        <title>Data <?php echo $_GET["typeDataEvent"]; ?>s</title>
        <link rel="stylesheet" type="text/css" href="/css/general-data-event.css" />
        <link rel="stylesheet" type="text/css" href="/css/header.css" />
        <link rel="stylesheet" type="text/css" href="/css/liste-data-events.css" />
    </head>
    <body>
        <?php 
            include("../header.php");
            // on regarde s'il existe des data events (si non, on affiche un message d'erreur)
            $conn = connexion($serveur, $bdd, $user, $pass);
            $requeteDataEvents = "SELECT * FROM DataEvent";
            $resultatDataEvents = getAllFromRequest($conn, $requeteDataEvents);
            $conn = deconnexion();
            if (empty($resultatDataEvents)) {
                echo "
                <div id='message-erreur-bdd-vide'>
                    <p>Erreur : aucun data event disponible !</p>
                </div>";
                include("../footer.php");
                exit;
            }
        ?>
        <main>
            <?php

                // récupération de tous les data challenges (resp. toutes les data battles)
                $conn = connexion($serveur, $bdd, $user, $pass);
                if ($_GET["typeDataEvent"] == "challenge") {
                    $requete = "SELECT * FROM DataEvent WHERE typeDataEvent='DataChallenge';";
                    $resultat = getAllFromRequest($conn, $requete);
                }
                else if ($_GET["typeDataEvent"] == "battle") {
                    $requete = "SELECT * FROM DataEvent WHERE typeDataEvent='DataBattle';";
                    $resultat = getAllFromRequest($conn, $requete);
                }

                $conn = deconnexion();

                // affichage de tous les data challenges (resp. toutes les data battles)
                echo "
                <div id='liste-events'>";
                foreach ($resultat as $dataEvent) {
                    echo "
                    <div class='event'>
                        <a href='data-event.php?idDataEvent=".$dataEvent["idDataEvent"]."'>
                            <div class='titre-event'>
                                <span>".$dataEvent["titre"]."</span>
                            </div>
                            <p class='infos-entreprise-dates'>Par ".$dataEvent["entreprise"]." | ".$dataEvent["dateDebut"]." - ".$dataEvent["dateFin"]."</p>
                            <p>".$dataEvent["descript"]."</p>
                        </a>
                    </div>";
                }
                echo "
                </div>";

            ?>
        </main>
        <?php
            include("../footer.php");
        ?>
    </body>
</html>