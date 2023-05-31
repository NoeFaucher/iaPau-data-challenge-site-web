<!DOCTYPE html>
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="/css/profil.css">
    <link rel="stylesheet" href="/css/liste-data-events.css">

    <title>Profil - Ia Pau</title>
</head>
    <body>
        <?php
            include '../header.php';

            include '../bdd.php';
            $conn = connexion($serveur, $bdd, $user, $pass);


            //On récupère le tableau des gestionnaires pour les inputs des data events
            $req2 = 
                "SELECT U.nom, U.prenom, U.idUtilisateur
                FROM Utilisateur U
                WHERE U.typeUtilisateur = 'gestionnaire';
                ";

            $tab2 = getAllFromRequest($conn, $req2);
        ?>

        <div id="util-overlay" class="overlay">
            <span class="closebtn" onclick="closeModal('util-overlay')" title="Close Overlay">×</span>
            <div class="overlay-content">
                <form id="form-modif-util" action="modifDataEvent.php" method="post">
                    <h1>Modifier mes informations</h1>
                    <label>Prénom :</label><br>
                    <input type="text" name="prenom">
                    <label>Nom :</label><br>
                    <input type="text" name="nom">
                    <label>Mot de passe actuel :</label><br>
                    <input type="text" name="mdp">
                    <label>Nouveau mot de passe :</label><br>
                    <input type="text" name="newMdp">

                    <?php if ($_SESSION["typeUtilisateur"] == "normal"): ?>
                        <label>Email :</label><br>
                        <input type="text" name="mail">
                        <label>Téléphone :</label><br>
                        <input type="text" name="telephone">
                        <label>Ecole :</label><br>
                        <input type="text" name="ecole">
                        <label>Ville :</label><br>
                        <input type="text" name="ville">
                        <label>Niveau d'étude :</label><br>
                        <select id="niveau-etude" name="nivEtude">
                            <option value="L1">L1</option>
                            <option value="L2">L2</option>
                            <option value="L3">L3</option>
                            <option value="M1">M1</option>
                            <option value="M2">M2</option>
                            <option value="D">D</option>
                        </select><br>
                    <?php endif; ?>

                    <?php if ($_SESSION["typeUtilisateur"] == "gestionnaire"): ?>
                        <label>Entreprise :</label><br>
                        <input type="text" name="entreprise">
                    <?php endif; ?>
                    
                    <button type="submit" style="margin-top:2vh;" class="btnStyle">Valider les modifications</button>
                </form>
            </div>
        </div>


        <div id="data-chall-overlay" class="overlay">
            <span class="closebtn" onclick="closeModal('data-chall-overlay')" title="Close Overlay">×</span>
            <div class="overlay-content">
                <form id="form-modif-chall" action="modifDataEvent.php" method="post">
                    <h1>Modifier le Data Challenge</h1>
                    <label>Titre :</label><br>
                    <input type="text" name="titre">
                    <label>Dates de début et de fin :</label><br>
                    <input type="date" name="debut">
                    <input type="date" name="fin">
                    <label>Description :</label><br>
                    <textarea name="description" style="resize:none;width: 50%; height:10vh;"></textarea>
                    <label>Données :</label><br>
                    <input type="text" name="donnees">
                    <label>Consignes :</label><br>
                    <input type="text" name="consignes">
                    <label>Conseils :</label><br>
                    <input type="text" name="conseils">
                    
                    <label>Choix du gestionnaire :</label>
                    <input type='text' list='destinataires-list' class='searchInp' placeholder='Recherche rapide' require>
                    <datalist id='destinataires-list' class='dataL'>
                        <?php
                        foreach($tab2 as $util) {
                            $nom_prenom = $util["prenom"].' '.$util["nom"];
                            $idUtil = $util['idUtilisateur'];
                            echo '<option value="'.$nom_prenom.'" data-id="'.$idUtil.'">'.$nom_prenom.'</option>';
                        }
                        ?>

                    </datalist>
                    
                    <button type="submit" style="margin-top:2vh;" class="btnStyle">Valider les modifications</button>
                </form>
            </div>
        </div>

        <div id="new-data-chall-overlay" class="overlay">
            <span class="closebtn" onclick="closeModal('new-data-chall-overlay')" title="Close Overlay">×</span>
            <div class="overlay-content">
                <form id="form-new-chall" action="creeDataEvent.php" method="post">
                    <h1>Créer un Data Challenge</h1>
                    <label>Titre :</label><br>
                    <input type="text" name="titre">
                    <label>Dates de début et de fin :</label><br>
                    <input type="date" name="debut">
                    <input type="date" name="fin">
                    <label>Description :</label><br>
                    <textarea name="description" style="resize:none;width: 50%; height:10vh;"></textarea>
                    <label>Entreprise :</label><br>
                    <input type="text" name="entreprise">
                    <label>Données :</label><br>
                    <input type="text" name="donnees">
                    <label>Consignes :</label><br>
                    <input type="text" name="consignes">
                    <label>Conseils :</label><br>
                    <input type="text" name="conseils">

                    <label>Choix du gestionnaire :</label>
                    <input type='text' list='destinataires-list' class='searchInp' placeholder='Recherche rapide' require>
                    <datalist id='destinataires-list' class='dataL'>
                        <?php
                        foreach($tab2 as $util) {
                            $nom_prenom = $util["prenom"].' '.$util["nom"];
                            $idUtil = $util['idUtilisateur'];
                            echo '<option value="'.$nom_prenom.'" data-id="'.$idUtil.'">'.$nom_prenom.'</option>';
                        }
                        ?>

                    </datalist>
                    
                    <button type="submit" style="margin-top:2vh;" class="btnStyle">créer un nouveau data challenge</button>
                </form>
            </div>
        </div>

        <div id="data-battle-overlay" class="overlay">
            <span class="closebtn" onclick="closeModal('data-battle-overlay')" title="Close Overlay">×</span>
            <div class="overlay-content">
                <form id="form-modif-battle" action="modifDataEvent.php" method="post">
                    <h1>Modifier le Data Battle</h1>
                    <label>Titre :</label><br>
                    <input type="text" name="titre">
                    <label>Dates de début et de fin :</label><br>
                    <input type="date" name="debut">
                    <input type="date" name="fin">
                    <label>Description :</label><br>
                    <textarea name="description" style="resize:none;width: 50%; height:10vh;"></textarea>
                    <label>Données :</label><br>
                    <input type="text" name="donnees">
                    <label>Consignes :</label><br>
                    <input type="text" name="consignes">
                    <label>Conseils :</label><br>
                    <input type="text" name="conseils">

                    <input type='text' list='destinataires-list' class='searchInp' placeholder='Recherche rapide' require>
                    <datalist id='destinataires-list' class='dataL'>
                        <?php
                        foreach($tab2 as $util) {
                            $nom_prenom = $util["prenom"].' '.$util["nom"];
                            $idUtil = $util['idUtilisateur'];
                            echo '<option value="'.$nom_prenom.'" data-id="'.$idUtil.'">'.$nom_prenom.'</option>';
                        }
                        ?>

                    </datalist>
                    
                    <button type="submit" style="margin-top:2vh;" class="btnStyle">valider les modifications</button>
                </form>
            </div>
        </div>

        <div id="new-data-battle-overlay" class="overlay">
            <span class="closebtn" onclick="closeModal('new-data-battle-overlay')" title="Close Overlay">×</span>
            <div class="overlay-content">
                <form id="form-new-battle" action="creeDataEvent.php" method="post">
                    <h1>Créer un Data Battle</h1>
                    <label>Titre :</label><br>
                    <input type="text" name="titre">
                    <label>Dates de début et de fin :</label><br>
                    <input type="date" name="debut">
                    <input type="date" name="fin">
                    <label>Description :</label><br>
                    <textarea name="description" style="resize:none;width: 50%; height:10vh;"></textarea>
                    <label>Entreprise :</label><br>
                    <input type="text" name="entreprise">
                    <label>Données :</label><br>
                    <input type="text" name="donnees">
                    <label>Consignes :</label><br>
                    <input type="text" name="consignes">
                    <label>Conseils :</label><br>
                    <input type="text" name="conseils">

                    <label>Choix du gestionnaire :</label>
                    <input type='text' list='destinataires-list' class='searchInp' placeholder='Recherche rapide' require>
                    <datalist id='destinataires-list' class='dataL'>
                        <?php
                        foreach($tab2 as $util) {
                            $nom_prenom = $util["prenom"].' '.$util["nom"];
                            $idUtil = $util['idUtilisateur'];
                            echo '<option value="'.$nom_prenom.'" data-id="'.$idUtil.'">'.$nom_prenom.'</option>';
                        }
                        ?>

                    </datalist>
                    
                    <button type="submit" style="margin-top:2vh;" class="btnStyle">créer un nouveau data battle</button>
                </form>
            </div>
        </div>
        
        <div id="projet-data-overlay" class="overlay">
            <span class="closebtn" onclick="closeModal('projet-data-overlay')" title="Close Overlay">×</span>
            <div class="overlay-content">
                <form action="newProjetData.php" method="post">
                    <h1>Modifier le Projet Data</h1>
                    <label>Titre :</label><br>
                    <input type="text" name="titre">
                    <label>Dates de début et de fin :</label><br>
                    <input type="date" name="debut">
                    <input type="date" name="fin">
                    <label>Description :</label><br>
                    <textarea name="description" style="resize:none;width: 50%; height:10vh;"></textarea>
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

        <div id="new-data-projet-overlay" class="overlay">
            <span class="closebtn" onclick="closeModal('new-data-projet-overlay')" title="Close Overlay">×</span>
            <div class="overlay-content">
                <form action="modifDataChall.php" method="post">
                    <h1>Créer un Projet Data</h1>
                    <label>Titre :</label><br>
                    <input type="text" name="titre">
                    <label>Dates de début et de fin :</label><br>
                    <input type="date" name="debut">
                    <input type="date" name="fin">
                    <label>Description :</label><br>
                    <textarea name="description" style="resize:none;width: 50%; height:10vh;"></textarea>
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


        <div class="left-menu">
            <ul>
                <li><a title='Informations' href='#infos'>Informations</a></li>
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
            
            <div id="infos">
                <h1>Votre profil</h1>
                <button class="btnStyle" onclick="window.location = '/php/connexion/deconnexion.php';">deconnexion</button>
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
                <button class="btnStyle" onclick="openModal(0,'util-overlay','form-modif-util',0)">Modifier mes informations</button>
            </div>

            <div id="equ">
                <h1>Vos équipes</h1>
                <button class="btnStyle" onclick="window.location = '/php/equipe/equipe.php';">accéder aux équipes</button>
            </div>

            <div id="challenge">
                <h1>Vos Data Challenges</h1> 
                <?php
                
                
                if ($_SESSION["typeUtilisateur"] == "administrateur") {
                
                    echo "<button class='btnStyle' onclick='openModal(0, \"new-data-chall-overlay\",\"form-new-chall\");'>créer un data challenge</button>";
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
                        if ($_SESSION["typeUtilisateur"] != "normal"): ?>
                            <button class='btnStyle' onclick='openModal(<?php echo $resultat[$i]["idDataEvent"] ?>,"data-chall-overlay","form-modif-chall");' style='background-color: blue;'>Modifier</button>
                        <?php endif;
                        if ($_SESSION["typeUtilisateur"] == "administrateur"): ?>
                            <button class='btnStyle' onclick='window.location="supDataEvent.php?idDataEvent=<?php echo $resultat[$i]["idDataEvent"] ?>";' style='background-color: red;'>supprimer</button>
                        <?php endif;
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
                                    
                        echo "<button class='btnStyle' onclick='openModal(0, \"new-data-battle-overlay\",\"form-new-battle\");'>créer un data battle</button>";
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
                            if ($_SESSION["typeUtilisateur"] != "normal"): ?>
                                <button class='btnStyle' onclick='openModal(<?php echo $resultat[$i]["idDataEvent"] ?>,"data-chall-overlay","form-modif-chall");' style='background-color: blue;'>Modifier</button>
                            <?php endif;
                            if ($_SESSION["typeUtilisateur"] == "administrateur"): ?>
                                <button class='btnStyle' onclick='window.location="supDataEvent.php?idDataEvent=<?php echo $resultat[$i]["idDataEvent"] ?>";' style='background-color: red;'>supprimer</button>
                            <?php endif;

                            echo" </div>";
                        }
                        echo "</div>";
                    }


                ?>  

            </div>
            
            <div id="projetdata">
                <h1>Vos Projets Data</h1>
                
                
            </div>


            <div>

            </div>


        </div>
        <script>
            function openModal(idDataEv,overlay,form) {

                // Création de l'élément input
                var input = document.createElement('input');
                input.type = 'hidden';
                input.value = idDataEv;
                input.name = 'idDataEvent';


                document.getElementById(form).appendChild(input);

                document.getElementById(overlay).style.display = "block";
             }       

            function closeModal(overlay) {
                document.getElementById(overlay).style.display = "none";
            }

        </script>
    </body>
</html>