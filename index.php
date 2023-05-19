<?php
    session_start();
    $_SESSION["role"] = "admin";
    if ($_SESSION["role"] == "participant") {
        $_SESSION["chefEquipe"] = true;
    }
    $_SESSION["loggedIn"] = true;
    $_SESSION["inscritAuDataChallenge"] = true;
?>

<!DOCTYPE HTML>
<html>
    <head>
        <link rel="stylesheet" type="text/css" href="css/general.css" />
        <link rel="stylesheet" type="text/css" href="css/footer.css" />
        <link rel="stylesheet" type="text/css" href="css/podium.css" />
        <link rel="stylesheet" type="text/css" href="css/description-data-challenge.css" />
        <link rel="stylesheet" type="text/css" href="css/acces-equipe.css" />
    </head>
    <body>
        <!-- main -->
        <main>
            <!-- description des data challenges -->
            <section>
                <?php
                    include("php/description-data-challenge.php");
                ?>
            </section>
            <!-- podium -->
            <section>
                <?php
                    include("php/podium.php");
                ?>
            </section>
            <!-- accès équipe -->
            <section>
                <?php
                    include("php/acces-equipe.php");
                ?>
            </section>
        </main>
        <!-- footer -->
        <footer>
            <?php
                include("php/footer.php");
            ?>
        </footer>
    </body>
</html>

