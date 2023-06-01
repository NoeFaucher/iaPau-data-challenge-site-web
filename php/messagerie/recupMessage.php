
<?php
    
    include("../bdd.php");



    $req = "select * from Message inner join Utilisateur on idEnvoyeur = idUtilisateur order by dateEnvoi DESC ";


    $cnx = connexion($serveur,$bdd,$user,$pass);
    
    $idUtilisateur = $_SESSION["idUtilisateur"];

    $tab = [];
    $tab_temp = [];

    if (isset($_GET["equipe"])) {
        $req = "SELECT U.*
                    FROM Utilisateur U
                    JOIN UtilisateurAppartientEquipe as UAE ON U.idUtilisateur = UAE.idUtilisateur
                    JOIN Equipe as E ON UAE.idEquipe = E.idEquipe
                    JOIN ProjetData as P on P.idProjetData = E.idProjetData
                    JOIN DataEvent as D on D.idDataEvent = P.idDataEvent
                    WHERE E.idEquipe =". $_GET["equipe"].";";
        $tab_temp = getAllFromRequest($cnx,$req);
        $tab = array_merge($tab,$tab_temp);

        $req = "SELECT U.*
                    FROM Utilisateur U
                    JOIN DataEvent as D on U.idUtilisateur = D.idGestionnaire 
                    JOIN ProjetData as P on D.idDataEvent = P.idDataEvent 
                    JOIN Equipe as E ON P.idProjetData = E.idProjetData
                    WHERE E.idEquipe =". $_GET["equipe"].";";

        $tab_temp = getAllFromRequest($cnx,$req);
        $tab = array_merge($tab,$tab_temp);
    }else {
        // Cas tous les utilisateurs 

        $req = "SELECT * FROM Utilisateur;";

        $tab_temp = getAllFromRequest($cnx,$req);
        $tab = array_merge($tab,$tab_temp);


    }




    

    $tab = getAllFromRequest($cnx,$req);



    foreach($tab as $msg) {

        // Recupération nom envoyeur 
        $nomEnvoyeur = $msg["nom"] ." ". $msg["prenom"];
        
        $req = "select * from MessageDestinataire inner join Utilisateur on idUtilisateur = idDestinataire where idMessage = ".$msg["idMessage"].";";

        $rowsReceveur = getAllFromRequest($cnx,$req);
        $numrow = count($rowsReceveur);
        
        $receveurs = ""; 
        for($i=0;$i<$numrow;$i++) {
            $receveur = $rowsReceveur[$i];
            $nomReceveur = $receveur["nom"]." ".$receveur["prenom"];
            $receveurs = $receveurs.$nomReceveur;
            if ($i!= $numrow-1){
                $receveurs = $receveurs.", ";
            }
        }



        echo "
                <div class='message'>
                    <p class='envoyeur' ><span>De: </span>".$nomEnvoyeur." <span>à</span> ".$receveurs."</p>
                    <p class='objet' ><span>Objet:</span> ".$msg["objet"]."</p>
                    <p class='date' >".$msg["dateEnvoi"]."</p>
                    <p class='contenu' >".$msg["contenu"]."</p>
                </div>


        ";

    }

?>