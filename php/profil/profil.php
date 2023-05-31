<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="/css/profil.css">
    <link rel="stylesheet" href="/css/liste-data-events.css">

    <title>Profil - Ia Pau</title>
</head>
    <body>
        <?php
            include '../header.php';
        ?>

        <div id="DataChallOverlay" class="overlay">
            <span class="closebtn" onclick="closeModifDataChall()" title="Close Overlay">×</span>
            <div class="overlay-content">
                <form action="modifDataChall.php" method="post">
                    <label>Titre :</label><br>
                    <input type="text" name="titre">
                    <label>Dates de début et de fin :</label><br>
                    <input type="date" name="debut">
                    <input type="date" name="fin">
                    <label>Description :</label><br>
                    <textarea name="desc" style="resize:none;width: 50%; height:10vh;"></textarea>
                    <label>Données :</label><br>
                    <input type="text" name="donnees">
                    <label>Consignes :</label><br>
                    <input type="text" name="consignes">
                    <label>Conseils :</label><br>
                    <input type="text" name="conseils">
                    
                    <button type="submit" style="margin-top:2vh;" class="btnStyle">Valider les modifications</button>
                </form>
            </div>
        </div>

        <div id="NewDataChallOverlay" class="overlay">
            <span class="closebtn" onclick="closeNewDataChall()" title="Close Overlay">×</span>
            <div class="overlay-content">
                <form action="modifDataChall.php" method="post">
                    <label>Titre :</label><br>
                    <input type="text" name="titre">
                    <label>Dates de début et de fin :</label><br>
                    <input type="date" name="debut">
                    <input type="date" name="fin">
                    <label>Description :</label><br>
                    <textarea name="desc" style="resize:none;width: 50%; height:10vh;"></textarea>
                    <label>Données :</label><br>
                    <input type="text" name="donnees">
                    <label>Consignes :</label><br>
                    <input type="text" name="consignes">
                    <label>Conseils :</label><br>
                    <input type="text" name="conseils">
                    
                    <button type="submit" style="margin-top:2vh;" class="btnStyle">créer un nouveau data challenge</button>
                </form>
            </div>
        </div>
        


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
            <button class="btnStyle" onclick="window.location = '/php/connexion/deconnexion.php';">deconnexion</button>
            <div id="infos">
                <?php
                if ((isset($_SESSION["typeUtilisateur"])) && ($_SESSION["typeUtilisateur"] == "normal")) {

                    echo '<p>Prénom : '.$_SESSION['prenom'] . ' | Nom : ' . $_SESSION['nom'] .' | Téléphone : '.$_SESSION["telephone"]."</p>";
                    echo '<p>Niveau d\'étude : '.$_SESSION['nivEtude']. ' | Etablissement : ' . $_SESSION['ecole']. ' | Ville : ' . $_SESSION['ville']."</p>";
                }
                    // l'utilisateur est un gestionnaire
                if ((isset($_SESSION["typeUtilisateur"])) && ($_SESSION["typeUtilisateur"] == "gestionnaire")) {

                    echo '<p>Prénom : '.$_SESSION['prenom'] . ' | Nom : ' . $_SESSION['nom'] ."</p>";
                }
                    // l'utilisateur est un admin
                if ((isset($_SESSION["typeUtilisateur"])) && ($_SESSION["typeUtilisateur"] == "administrateur")) {
                    echo '<p>Prénom : '.$_SESSION['prenom'] . ' | Nom : ' . $_SESSION['nom'] ."</p>";
                }
                ?>
                <br>
                <button class="btnStyle" onclick="">Modifier mes informations</button>
            </div>
            <span id="equ"></span>
            <h1>Vos équipes</h1>
            <div>
                <button class="btnStyle" onclick="window.location = '/php/equipe/equipe.php';">accéder aux équipes</button>
            </div>
            <h1>Vos Data Challenge</h1>
            <div>
            <?php
                include '../bdd.php';
                $conn = connexion($serveur, $bdd, $user, $pass);
                
                
                if ($_SESSION["typeUtilisateur"] == "administrateur") {
                    echo "<button class='btnStyle' onclick='openNewDataChall();';'></button>";


                    $requete = "SELECT * FROM DataEvent WHERE typeDataEvent='DataChallenge';";
                }elseif($_SESSION["typeUtilisateur"] == "gestionnaire"){
                    $requete = "SELECT *
                    FROM DataEvent INNER JOIN Equipe 
                    on Equipe.idProjetData=DataEvent.idDataEvent 
                    WHERE typeDataEvent='DataChallenge'
                    and DataEvent.idDataEvent = any 
                    (SELECT idDataEvent 
                    FROM DataEvent INNER JOIN Utilisateur 
                    on Utilisateur.idUtilisateur = DataEvent.idDataEvent 
                    and DataEvent.idGestionnaire = '".$_SESSION["idUtilisateur"]."');";

                }elseif ($_SESSION["typeUtilisateur"] == "normal") {
                    $requete = "SELECT *
                    FROM UtilisateurAppartientEquipe 
                    INNER JOIN Equipe ON UtilisateurAppartientEquipe.idEquipe = Equipe.idEquipe
                    INNER JOIN DataEvent D ON Equipe.idProjetData = D.idDataEvent
                    WHERE UtilisateurAppartientEquipe.idUtilisateur ='".$_SESSION["idUtilisateur"]."'
                    AND D.typeDataEvent='DataChallenge';";
                }




                $resultat = getAllFromRequest($conn, $requete);
                $conn = deconnexion();


                $nbrResultats = count($resultat);

                if (!$nbrResultats) {
                    if ($_SESSION["typeUtilisateur"] == "normal") {
                        echo "<p> Vous n'êtes pas inscrit à des Data challenges.</p>";
                    }elseif (($_SESSION["typeUtilisateur"] == "administrateur") || ($_SESSION["typeUtilisateur"] == "gestionnaire")) {
                        echo "<p> Aucun Data Challenge.</p>";
                    }
                }else{
                    echo "<div id='liste-events'>";
                    for ($i=0; $i<$nbrResultats; $i++) {
    
                        echo "
                        <div class='event'>
                            <a href='/php/dataEventdata-event.php?idDataEvent=".$resultat[$i]["idDataEvent"]."'>
                                <div class='titre-event'>
                                    <span>".$resultat[$i]["titre"]."</span>
                                </div>
                                <p>".$resultat[$i]["descript"]."</p>
                            </a>
                        ";
                        if ($_SESSION["typeUtilisateur"] != "normal") {
                            echo"
                            <button class='btnStyle' onclick='openModifDataChall();'>Modifier</button>
                            <button class='btnStyle' onclick=''>supprimer</button>";
                        }

                        echo" </div>";
                    }
                    echo "</div>";
                }
            ?>
            </div>
            <h1>Vos Data Battle</h1>
            <div>
            </div>
        </div>
        <script>
            function openModifDataChall() {
                document.getElementById("DataChallOverlay").style.display = "block";
             }       

            function closeModifDataChall() {
                document.getElementById("DataChallOverlay").style.display = "none";
            }

            function openNewDataChall() {
                document.getElementById("NewDataChallOverlay").style.display = "block";
             }       

            function closeNewDataChall() {
                document.getElementById("NewDataChallOverlay").style.display = "none";
            }






        </script>
    </body>
</html>