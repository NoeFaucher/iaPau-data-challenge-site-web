<?php
    session_start();
    $loremIpsum = "Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.";
    $_SESSION["typeDataEvent"] = $_GET["typeDataEvent"];
?>

<!DOCTYPE HTML>
<html>
    <head>
        <meta charset="utf-8">
        <title>IA PAU</title>
        <link rel="stylesheet" type="text/css" href="../css/general.css" />
        <link rel="stylesheet" type="text/css" href="../css/header.css" />
        <link rel="stylesheet" type="text/css" href="../css/footer.css" />
        <link rel="stylesheet" type="text/css" href="../css/liste-data-events.css" />
        <script src="../js/header.js"></script>
    </head>
    <body>
        <?php 
            include("header.php");
        ?>
        <!-- main -->
        <main>
            <?php
                echo "<div id='liste-events'>";
                for ($i=1; $i<9; $i++) {
                    echo "
                    <div class='event'>
                        <a href='../php/data-event.php?typeDataEvent=".$_SESSION["typeDataEvent"]."&idDataEvent=insererId'>
                            
                                <div class='titre-event'>
                                    <span>Data ".$_SESSION["typeDataEvent"]." ".$i."</span>
                                </div>
                                <p>".$loremIpsum."</p>
                        </a>
                        </div>

                    ";
                }
                echo "</div>";
            ?>
        </main>
        <footer>
            <?php
                include("footer.php");
            ?>
        </footer>
    </body>
</html>