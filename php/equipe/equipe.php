<?php include '../header.php'; ?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="../../css/equipe.css">
    <title>Gestion d'équipe - IA Pau</title>
</head>
    <body>
        <div id="equipeContent">
            <?php
            include '../bdd.php';
            
            $cnx = connexion($serveur,$bdd,$user,$pass);

            $_SESSION["idUtilisateur"] = 4;
            $_SESSION["typeUtilisateur"] = 'normal';

            if ($_SESSION["typeUtilisateur"] == 'gestionnaire') {

                $req = 'SELECT Equipe.idEquipe, nomEquipe, DataEvent.idDataEvent, DataEvent.titre, idChefEquipe
                FROM DataEvent INNER JOIN Equipe 
                on Equipe.idDataEvent=DataEvent.idDataEvent 
                and DataEvent.idDataEvent = any 
                (SELECT idDataEvent 
                FROM DataEvent INNER JOIN Utilisateur 
                on Utilisateur.idUtilisateur = DataEvent.idDataEvent 
                and DataEvent.idGestionnaire = '.$_SESSION["idUtilisateur"].');';
            }elseif ($_SESSION["typeUtilisateur"] == 'administrateur') {

                $req = 'SELECT Equipe.idEquipe, nomEquipe, DataEvent.idDataEvent, DataEvent.titre, idChefEquipe
                FROM DataEvent INNER JOIN Equipe 
                on Equipe.idDataEvent=DataEvent.idDataEvent;';
            }else {

                $req = 'SELECT Equipe.idEquipe, nomEquipe, Equipe.idDataEvent, DataEvent.titre, idChefEquipe
                FROM UtilisateurAppartientEquipe 
                INNER JOIN Equipe ON UtilisateurAppartientEquipe.idEquipe = Equipe.idEquipe
                INNER JOIN DataEvent ON Equipe.idDataEvent = DataEvent.idDataEvent
                WHERE UtilisateurAppartientEquipe.idUtilisateur ='.$_SESSION["idUtilisateur"].';';
            }

            
        
                
            $tab = getAllFromRequest($cnx, $req);

            foreach($tab as $ligne){

                
                $estChef = ($ligne["idChefEquipe"] == $_SESSION["idUtilisateur"]);

                $req2 = 
                "SELECT U.nom, U.prenom, U.idUtilisateur
                FROM Utilisateur U
                WHERE U.typeUtilisateur <> 'gestionnaire' 
                AND U.typeUtilisateur <> 'administrateur' 
                AND U.idUtilisateur <> ".$_SESSION["idUtilisateur"].";
                ";

                $tab2 = getAllFromRequest($cnx, $req2);

                $req3 = 
                "SELECT U.nom, U.prenom
                FROM Utilisateur U 
                INNER JOIN UtilisateurAppartientEquipe UAE
                ON UAE.idUtilisateur = U.idUtilisateur
                WHERE UAE.idEquipe = ".$ligne["idEquipe"].";
                ";

                $tab3 = getAllFromRequest($cnx, $req3);




                echo 
                "<div class='boxEquipe'>
                <div class='entete' onclick='extend(this)' value='1'>
                    <h2>".$ligne["nomEquipe"]." -  ". $ligne["titre"] ."</h2>
                    <hr>  
                </div>
                
                <div class='reste'>
                    <div class='membres'>
                        <p class='membres'>Membres :</p>
                    ";
                    foreach($tab3 as $util) {
                        echo "<p>". $util["nom"]." ".$util["prenom"]."</p>";
                    }

                    echo "
                        </p>
                    </div>
                    ";
                    if ($estChef || ($_SESSION["typeUtilisateur"] != 'normal')) {
                        echo "
                        <button class='btnStyle' onclick='ajouterMembre(this,".$ligne["idEquipe"].",".$_SESSION["idUtilisateur"].",".$ligne["idDataEvent"].");'>Ajouter un membre</button>
                        <button class='btnStyle' onclick='supprimerMembre(this,".$ligne["idEquipe"].",".$_SESSION["idUtilisateur"].");'>Retirer un membre</button>
                        <input type='text' list='destinataires-list' class='searchInp' placeholder='Recherche rapide'>";
                        
                        echo "
                        <datalist id='destinataires-list' class='dataL'>
                        ";
                        foreach($tab2 as $util) {
                            $nom_prenom = $util["nom"].' '.$util["prenom"];
                            $idUtil = $util['idUtilisateur'];
                            echo '<option value="'.$nom_prenom.'" data-id="'.$idUtil.'">'.$nom_prenom.'</option>';
                        }
                        echo "

                        </datalist>
                        <button class='btnStyle' style='background-color:red; margin:2vh;' onclick='supprimerEquipe(this,".$ligne["idEquipe"].");'>Supprimer l'équipe</button>";


                    }else{
                        echo"
                        <button class='btnStyle' style='background-color:grey;'>Ajouter un membre</button>
                        <button class='btnStyle' style='background-color:grey;'>Retirer un membre</button>
                        <input type='text' class='searchInp' placeholder=\"Vous n'êtes pas chef d'équipe\" disabled value=''>";
                    }
                    
                    echo "
                </div>
            </div>";
                
                
                }

                $cnx = deconnexion();
            ?>
            </div>
        </div>


        <script>
            function extend(element) {
                if (element.value == "0") {
                    element.parentElement.style.height = "100px";
                    element.value = "1";
                }else{
                    element.parentElement.style.height = "auto";
                    element.value = "0";
                }

            }
        </script>
        <script src="/js/ajaxEquipes.js"></script>
    </body>
</html>