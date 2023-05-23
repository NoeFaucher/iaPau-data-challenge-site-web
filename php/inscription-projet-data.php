<?php

    session_start();
    $loremIpsum = "Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.";
    $texte = "Entrez ci-dessous le nom de l'équipe que vous voulez créer. Vous deviendrez chef de cette équipe.";
?>

<!DOCTYPE HTML>
<html>
    <head>
        <meta charset="utf-8">
        <title>IA PAU</title>
        <link rel="stylesheet" type="text/css" href="../css/general.css" />
        <link rel="stylesheet" type="text/css" href="../css/header.css" />
        <link rel="stylesheet" type="text/css" href="../css/footer.css" />
        <link rel="stylesheet" type="text/css" href="../css/inscription-projet-data.css" />
        <script src="../js/header.js"></script>
    </head>
    <body>
        <?php 
            include("header.php");
        ?>
        <!-- main -->
        <main>
            <?php
                
                $idProjetData = $_GET["idProjetData"];
                
                // affichage du questionnaire
                echo "
                
                <div id='inscription-projet-data'>
                    <p>".$loremIpsum."</p>
                    <form method='POST'>
                        <div class='question'>
                            <label for='question'>".$texte."</label>
                            <input type='text' name='question' placeholder='Votre réponse...' required>
                        </div>
                        <div id='bouton-envoi-inscription-projet-data'>
                            <button type='submit'>Créer mon équipe</button>
                        </div>
                    </form>
                </div>
                ";           

            ?>
        </main>
        <footer>
            <?php
                include("footer.php");
            ?>
        </footer>
    </body>
</html>