<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="/css/profil.css">

    <title>Profil - Ia Pau</title>
</head>
    <body>
        <?php
            include '../header.php';
        ?>
        <div class="left-menu">
            <ul>
                <li><a title='Informations' href='#inf'>Informations</a></li>
                <li><a title='Equipe(s)' href='#equ'>Equipe(s)</a></li>
                <li><a title='Challenge' href='#.php'>Challenge</a></li>
                <li><a title='Battle' href='#'>Battle</a></li>
                <li><a title='Messagerie' href='#'>Messagerie</a></li>
            </ul>
        </div>
        <div class="right-main">
            <span id="inf"></span>
            <h1>Votre profil</h1>
            <div id="infos">
                <?php
                if ((isset($_SESSION["typeUtilisateur"])) && ($_SESSION["typeUtilisateur"] == "normal")) {

                    echo '<p>Prénom : '.$_SESSION['prenom'] . ' | Nom : ' . $_SESSION['nom'] .' | Téléphone : '.$_SESSION["telephone"]."</p>";
                    echo '<p>Niveau d\'étude : '.$_SESSION['nivEtude']. ' | Etablissement : ' . $_SESSION['ecole']. ' | Ville : ' . $_SESSION['ville']."</p>";
                }
                    // l'utilisateur est un gestionnaire
                if ((isset($_SESSION["typeUtilisateur"])) && ($_SESSION["typeUtilisateur"] == "gestionnaire")) {

                    echo 'Prénom : '.$_SESSION['prenom'] . ' | Nom : ' . $_SESSION['nom'];
                }
                    // l'utilisateur est un admin
                if ((isset($_SESSION["typeUtilisateur"])) && ($_SESSION["typeUtilisateur"] == "administrateur")) {

                    echo 'Prénom : '.$_SESSION['prenom'] . ', Nom : ' . $_SESSION['nom'];
                }
                ?>
                <button class="btnStyle" onclick="">Modifier mes informations</button>
            </div>
            <span id="equ"></span>
            <h1>Vos équipes</h1>
            <div>
                <button class="btnStyle" onclick="window.location = '/php/equipe/equipe.php';">accéder aux équipes</button>
            </div>
        </div>
    </body>
</html>