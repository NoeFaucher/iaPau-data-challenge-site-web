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
                    <h1>Modifier le Data Challenge</h1>
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
                    <h1>Créer un Data Challenge</h1>
                    <label>Titre :</label><br>
                    <input type="text" name="titre">
                    <label>Dates de début et de fin :</label><br>
                    <input type="date" name="debut">
                    <input type="date" name="fin">
                    <label>Description :</label><br>
                    <textarea name="desc" style="resize:none;width: 50%; height:10vh;"></textarea>
                    <label>Entreprise :</label><br>
                    <input type="text" name="entreprise">
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

        <div id="DataBattleOverlay" class="overlay">
            <span class="closebtn" onclick="closeNewDataBattle()" title="Close Overlay">×</span>
            <div class="overlay-content">
                <form action="modifDataChall.php" method="post">
                    <h1>Modifier le Data Battle</h1>
                    <label>Titre :</label><br>
                    <input type="text" name="titre">
                    <label>Dates de début et de fin :</label><br>
                    <input type="date" name="debut">
                    <input type="date" name="fin">
                    <label>Description :</label><br>
                    <textarea name="desc" style="resize:none;width: 50%; height:10vh;"></textarea>
                    <label>Entreprise :</label><br>
                    <input type="text" name="entreprise">
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

        <div id="NewDataBattleOverlay" class="overlay">
            <span class="closebtn" onclick="closeNewDataBattle()" title="Close Overlay">×</span>
            <div class="overlay-content">
                <form action="modifDataChall.php" method="post">
                    <h1>Créer un Data Battle</h1>
                    <label>Titre :</label><br>
                    <input type="text" name="titre">
                    <label>Dates de début et de fin :</label><br>
                    <input type="date" name="debut">
                    <input type="date" name="fin">
                    <label>Description :</label><br>
                    <textarea name="desc" style="resize:none;width: 50%; height:10vh;"></textarea>
                    <label>Entreprise :</label><br>
                    <input type="text" name="entreprise">
                    <label>Données :</label><br>
                    <input type="text" name="donnees">
                    <label>Consignes :</label><br>
                    <input type="text" name="consignes">
                    <label>Conseils :</label><br>
                    <input type="text" name="conseils">
                    
                    <button type="submit" style="margin-top:2vh;" class="btnStyle">créer un nouveau data challenge</button>
                </form>x
            </div>
        </div>
        


        <div class="left-menu">
            <ul>
                <li><a title='Informations' href='#inf'>Informations</a></li>
                <li><a title='Equipe(s)' href='#equ'>Equipe(s)</a></li>
                <li><a title='Challenge' href='#challenge'>Challenge</a></li>
                <li><a title='Battle' href='#battle'>Battle</a></li>
                <?php
                if ($_SESSION["typeUtilisateur"] == "administrateur") {
                    echo "<li><a title='Utilisateurs' href='#util'>Utilisateurs</a></li>";
                }
                ?>
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
            <div id="challenge">
            <h1>Vos Data Challenges</h1> 
            <?php
                include '../bdd.php';
                $conn = connexion($serveur, $bdd, $user, $pass);
                
                
                if ($_SESSION["typeUtilisateur"] == "administrateur") {
                
                    echo "<button class='btnStyle' onclick='openNewDataChall();';'>créer un data challenge</button>";
                    //Pour l'admin, on récup juste tout
                    $requete = "SELECT * FROM DataEvent WHERE typeDataEvent='DataChallenge';";
                }elseif($_SESSION["typeUtilisateur"] == "gestionnaire"){
                    //Select pour récuperer tout les Data Challenge du gestionnaire (remplacer au niveau du "where" par data battle
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
                    //Select pour récuperer tout les data Challenges d'un utilisateur normal (pareil pour data battle faut remplacer le type)
                    $requete = "SELECT *
                    FROM UtilisateurAppartientEquipe 
                    INNER JOIN Equipe ON UtilisateurAppartientEquipe.idEquipe = Equipe.idEquipe
                    INNER JOIN DataEvent D ON Equipe.idProjetData = D.idDataEvent
                    WHERE UtilisateurAppartientEquipe.idUtilisateur ='".$_SESSION["idUtilisateur"]."'
                    AND D.typeDataEvent='DataChallenge';";
                }




                $resultat = getAllFromRequest($conn, $requete);


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
                            <a href='/php/dataEvent/data-event.php?idDataEvent=".$resultat[$i]["idDataEvent"]."'>
                                <div class='titre-event'>
                                    <span>".$resultat[$i]["titre"]."</span>
                                </div>
                                <p>".$resultat[$i]["descript"]."</p>
                            </a>
                        ";
                        if ($_SESSION["typeUtilisateur"] != "normal") {
                            echo"
                            <button class='btnStyle' onclick='openModifDataChall();' style='background-color: blue;'>Modifier</button>
                            <button class='btnStyle' onclick='' style='background-color: red;'>supprimer</button>";
                        }

                        echo" </div>";
                    }
                    echo "</div>";
                }
            ?>
            </div>

            <div id="battle">
                <h1>Vos Data Battles</h1>
                <?php

                    if ($_SESSION["typeUtilisateur"] == "administrateur") {
                                    
                        echo "<button class='btnStyle' onclick='openNewDataBattle();';'>créer un data battle</button>";
                        //Pour l'admin, on récup juste tout
                        $requete = "SELECT * FROM DataEvent WHERE typeDataEvent='DataBattle';";
                    }elseif($_SESSION["typeUtilisateur"] == "gestionnaire"){
                        //Select pour récuperer tout les Data Challenge du gestionnaire (remplacer au niveau du "where" par data battle
                        $requete = "SELECT *
                        FROM DataEvent INNER JOIN Equipe 
                        on Equipe.idProjetData=DataEvent.idDataEvent 
                        WHERE typeDataEvent='DataBattle'
                        and DataEvent.idDataEvent = any 
                        (SELECT idDataEvent 
                        FROM DataEvent INNER JOIN Utilisateur 
                        on Utilisateur.idUtilisateur = DataEvent.idDataEvent 
                        and DataEvent.idGestionnaire = '".$_SESSION["idUtilisateur"]."');";

                    }elseif ($_SESSION["typeUtilisateur"] == "normal") {
                        //Select pour récuperer tout les data Challenges d'un utilisateur normal (pareil pour data battle faut remplacer le type)
                        $requete = "SELECT *
                        FROM UtilisateurAppartientEquipe 
                        INNER JOIN Equipe ON UtilisateurAppartientEquipe.idEquipe = Equipe.idEquipe
                        INNER JOIN DataEvent D ON Equipe.idProjetData = D.idDataEvent
                        WHERE UtilisateurAppartientEquipe.idUtilisateur ='".$_SESSION["idUtilisateur"]."'
                        AND D.typeDataEvent='DataBattle';";
                    }




            $resultat = getAllFromRequest($conn, $requete);


            $nbrResultats = count($resultat);

            if (!$nbrResultats) {
                if ($_SESSION["typeUtilisateur"] == "normal") {
                    echo "<p> Vous n'êtes pas inscrit à des Data Battles.</p>";
                }elseif (($_SESSION["typeUtilisateur"] == "administrateur") || ($_SESSION["typeUtilisateur"] == "gestionnaire")) {
                    echo "<p> Aucun Data Battle.</p>";
                }
            }else{
                echo "<div id='liste-events'>";
                for ($i=0; $i<$nbrResultats; $i++) {

                    echo "
                    <div class='event'>
                        <a href='/php/dataEvent/data-event.php?idDataEvent=".$resultat[$i]["idDataEvent"]."'>
                            <div class='titre-event'>
                                <span>".$resultat[$i]["titre"]."</span>
                            </div>
                            <p>".$resultat[$i]["descript"]."</p>
                        </a>
                    ";
                    if ($_SESSION["typeUtilisateur"] != "normal") {
                        echo"
                        <button class='btnStyle' onclick='openModifDataChall();' style='background-color: blue;'>Modifier</button>
                        <button class='btnStyle' onclick='' style='background-color: red;'>supprimer</button>";
                    }

                    echo" </div>";
                }
                echo "</div>";
            }


                ?>  

            </div>
            

            <?php
                if ($_SESSION["typeUtilisateur"] == "administrateur") {
                    $reqUtil = "SELECT U.nom, U.prenom, U.idUtilisateur, U.typeUtilisateur
                    FROM Utilisateur U
                    WHERE U.typeUtilisateur <> 'administrateur' 
                    AND U.idUtilisateur <> ".$_SESSION["idUtilisateur"].";
                    ";

                    $resultats = getAllFromRequest($conn,$reqUtil);

                    echo "
                    <div id='util'>
                        <h1>Utilisateurs inscrits</h1>
                        <button class='btnStyle' onclick=''>Créer un utilisateur</button>
                        <input class='utilInput' type='text' list='destinataires-list' class='searchInp' placeholder='Recherche rapide'>
                        
                        <datalist id='destinataires-list' class='dataL'>
                        ";
                        foreach($resultats as $util) {
                            $nom_prenom = $util["prenom"].' '.$util["nom"].' - '.$util["typeUtilisateur"];  
                            $idUtil = $util['idUtilisateur'];
                            echo '<option value="'.$nom_prenom.'" data-id="'.$idUtil.'">'.$nom_prenom.'</option>';
                        }

                    echo "
                        </datalist>
                        <button class='btnStyle' onclick=''>Modifier l'utilisateur</button>
                    </div>";
                }
            ?>

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

            function openModifDataBattle() {
                document.getElementById("DataBattleOverlay").style.display = "block";
             }       

            function closeModifDataBattle() {
                document.getElementById("DataBattleOverlay").style.display = "none";
            }

            function openNewDataBattle() {
                document.getElementById("NewDataBattleOverlay").style.display = "block";
             }       

            function closeNewDataBattle() {
                document.getElementById("NewDataBattleOverlay").style.display = "none";
            }







        </script>
    </body>
</html>