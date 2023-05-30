<?php
    session_start();
    include("../bdd.php");
?>

<!DOCTYPE HTML>
<html>
    <head>
        <meta charset="utf-8">
        <title>IA PAU</title>
        <link rel="stylesheet" type="text/css" href="/css/general-data-event.css" />
        <link rel="stylesheet" type="text/css" href="/css/header.css" />
        <link rel="stylesheet" type="text/css" href="/css/footer.css" />
        <link rel="stylesheet" type="text/css" href="/css/liste-data-events.css" />
    </head>
    <body>
        <?php 
            include("../header.php");
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
                            <p class='infos-entreprise-dates'>Par ".$dataEvent["entreprise"]." | ".$dataEvent["dateDebut"]." - ".$dataEvent["dateFIN"]."</p>
                            <p>".$dataEvent["descript"]."</p>
                        </a>
                    </div>";
                }
                echo "</div>";

            ?>
        </main>
        <?php
            include("../footer.php");
        ?>
    </body>
</html>