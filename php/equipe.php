<?php include 'header.php'; ?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="../css/equipe.css">
    <title>Gestion d'équipe - IA Pau</title>
</head>
    <body>
        <div id="equipeContent">
            <?php
            include 'bdd.php';
            
            $_SESSION["idUtilisateur"] = 1;
            $test = 3;

                if ($test == 1) {

                    $req = 'SELECT Equipe.idEquipe, nomEquipe 
                    FROM DataEvent INNER JOIN Equipe 
                    on Equipe.idDataEvent=DataEvent.idDataEvent 
                    and DataEvent.idDataEvent = any 
                    (SELECT idDataEvent 
                    FROM DataEvent INNER JOIN Utilisateur 
                    on Utilisateur.idUtilisateur = DataEvent.idDataEvent 
                    and DataEvent.idGestionnaire = '.$_SESSION["idUtilisateur"].');';
                }elseif ($test == 2) {

                    $req = 'SELECT Equipe.idEquipe, nomEquipe 
                    FROM DataEvent INNER JOIN Equipe 
                    on Equipe.idDataEvent=DataEvent.idDataEvent;';
                }else {

                    $req = 'SELECT Equipe.idEquipe, nomEquipe
                    FROM UtilisateurAppartientEquipe INNER JOIN Equipe
                    on UtilisateurAppartientEquipe.idEquipe = Equipe.idEquipe
                    and UtilisateurAppartientEquipe.idUtilisateur = '.$_SESSION["idUtilisateur"].';';
                }
            
                    
                $resultat = mysqli_query($cnx,$req);



                

                while($ligne = mysqli_fetch_assoc($resultat)){
                    /*Requête pour récupérer tout les util qui :
                    - n'ont pas d'équipe
                    - n'est pas l'util connecté
                    - n'est pas admin ou gestio
                    - n'est pas dans une equipe du data challenge de l'equipe en question
                    */

                    $req2 = 
                    "SELECT U.nom, U.prenom, U.idUtilisateur
                    FROM Utilisateur U
                    LEFT JOIN UtilisateurAppartientEquipe UAE ON U.idUtilisateur = UAE.idUtilisateur
                    LEFT JOIN Equipe E ON UAE.idEquipe = E.idEquipe
                    LEFT JOIN DataEvent DE ON E.idDataEvent = DE.idDataEvent
                    WHERE (E.idDataEvent <> 1 OR E.idDataEvent IS NULL)
                    AND (U.typeUtilisateur <> 'gestionnaire' AND U.typeUtilisateur <> 'administrateur' 
                    AND U.idUtilisateur <> ".$_SESSION["idUtilisateur"].");
                    ";

                    $resultat2 = mysqli_query($cnx,$req2) or die ("Problème req :$req2");
                    $tab = mysqli_fetch_all($resultat2,MYSQLI_ASSOC);

                    $req3 = 
                    "SELECT U.nom, U.prenom
                    FROM Utilisateur U 
                    INNER JOIN UtilisateurAppartientEquipe UAE
                    ON UAE.idUtilisateur = U.idUtilisateur
                    WHERE UAE.idEquipe = ".$ligne["idEquipe"].";
                    ";

                    $resultat3 = mysqli_query($cnx,$req3) or die ("Problème req :$req3");
                    $tab2 = mysqli_fetch_all($resultat3,MYSQLI_ASSOC);




                    echo 
                    "<div class='boxEquipe'>
                    <div class='entete' onclick='extend(this)' value='1'>
                        <h2>".$ligne["nomEquipe"]."</h2>
                        <hr>  
                    </div>
                    ";

                    foreach($tab2 as $util) {
                        echo $util["nom"]." ".$util["prenom"]."<br>";
                    }

                    echo "
                    <div class='reste'>
                        <button class='btnStyle'>Ajouter un membre</button>
                        <button class='btnStyle'>Retirer un membre</button>
                        <input type='text' id='searchInp' placeholder='Recherche rapide' list='destinataires-list'>
                        <datalist id='destinataires-list'>
                        ";
                        foreach($tab as $util) {
                            $nom_prenom = $util["nom"].' '.$util["prenom"];
                            $idDestinataire = $util['idUtilisateur'];
                            echo '<option value="'.$nom_prenom.'" data-id="'.$idDestinataire.'">'.$nom_prenom.'</option>';
                        }
                        echo "

                        </datalist>
                        <button class='btnStyle' style='background-color:red; margin:2vh;'>Supprimer l'équipe</button>
                    </div>
                </div>";
                

                }


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
    </body>
</html>