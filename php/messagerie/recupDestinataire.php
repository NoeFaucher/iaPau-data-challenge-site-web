
<?php

    include("../bdd.php");

    session_start();

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

    foreach($tab as $util) {
        $nom_prenom = $util["nom"].' '.$util["prenom"];
        $idDestinataire = $util['idUtilisateur'];
        
        if ($idDestinataire != $idUtilisateur) {                
            $typeDestinataire = str_replace("normal","etudiant",$util['typeUtilisateur']);
            echo '<option value="'.$nom_prenom.'" data-id="'.$idDestinataire.'">'.$nom_prenom.' : '.$typeDestinataire.'</option>;';
        }
    }
    

    $cnx = deconnexion();
?>