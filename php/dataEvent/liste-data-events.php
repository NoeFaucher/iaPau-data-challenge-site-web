<?php
    session_start();
    include("../bdd.php");
    $loremIpsum = "Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.";
    $_SESSION["typeDataEvent"] = $_GET["typeDataEvent"];

?>

<!DOCTYPE HTML>
<html>
    <head>
        <meta charset="utf-8">
        <title>IA PAU</title>
        <link rel="stylesheet" type="text/css" href="/css/general.css" />
        <link rel="stylesheet" type="text/css" href="/css/header.css" />
        <link rel="stylesheet" type="text/css" href="/css/footer.css" />
        <link rel="stylesheet" type="text/css" href="/css/liste-data-events.css" />
    </head>
    <body>
        <?php 
            include("../header.php");
        ?>
        <!-- main -->
        <main>
            <?php
                $conn = connexion($serveur, $bdd, $user, $pass);
                
                
                
                if ($_GET["typeDataEvent"] == "challenge") {
                    $requete = "SELECT * FROM DataEvent WHERE typeDataEvent=\"DataChallenge\";";
                    $resultat = getAllFromRequest($conn, $requete);
                }
                else if ($_GET["typeDataEvent"] == "battle") {
                    $requete = "SELECT * FROM DataEvent WHERE typeDataEvent='DataBattle';";
                    $resultat = getAllFromRequest($conn, $requete);
                }

                $conn = deconnexion();


                $nbrResultats = count($resultat);


                echo "<div id='liste-events'>";
                for ($i=0; $i<$nbrResultats; $i++) {

                    echo "
                    <div class='event'>
                        <a href='data-event.php?idDataEvent=".$resultat[$i]["idDataEvent"]."'>
                            <div class='titre-event'>
                                <span>".$resultat[$i]["titre"]."</span>
                            </div>
                            <p>".$resultat[$i]["descript"]."</p>
                        </a>
                    </div>
                    ";
                }
                echo "</div>";
            ?>
        </main>
        <?php
            include("../footer.php");
        ?>
    </body>
</html>