
<?php
    
    include("../bdd.php");
    include("../verification.php");

    session_start();

    $cnx = connexion($serveur,$bdd,$user,$pass);
   
    if (!isset($_SESSION["idUtilisateur"])) {
        exit;
    }
    

    $idUtilisateur = $_SESSION["idUtilisateur"];
    $typeUtilisateur = $_SESSION["typeUtilisateur"];
    $array_messages_recup = [];

    $tab = [];
    $tab_temp = [];

    if (isset($_GET["equipe"]) && !estInjectionSQL($_GET["equipe"]) ) {
        // recupération de tous les messages au sein d'une equipe
        $id_equipe = $_GET["equipe"];

        // verification si l'utilisateur est membre de l'equipe
        if($typeUtilisateur == "normal") {
            $req = "SELECT * 
                        FROM Utilisateur U
                        JOIN UtilisateurAppartientEquipe as UAE on U.idUtilisateur = UAE.idUtilisateur
                        JOIN Equipe as E on UAE.idEquipe = E.idEquipe
                        WHERE E.idEquipe = $id_equipe and U.idUtilisateur = $idUtilisateur;";


            $tab_temp = getAllFromRequest($cnx,$req);

            if (count($tab_temp) == 0) {
                echo "Vous ne pouvez pas accéder aux messages de cette equipe.";
                exit;
            }
        
        }

            // tous les messages entre les utilisateurs dans une equipe (pas le gestionnaire)
        $req = "(SELECT M.*, U1.* 
                    FROM Message M
                    JOIN MessageDestinataire MD ON M.idMessage = MD.idMessage
                    JOIN Utilisateur U1 ON U1.idUtilisateur = M.idEnvoyeur
                    JOIN Utilisateur U2 ON U2.idUtilisateur = MD.idDestinataire
                    JOIN UtilisateurAppartientEquipe UAE1 ON U1.idUtilisateur = UAE1.idUtilisateur
                    JOIN UtilisateurAppartientEquipe UAE2 ON U2.idUtilisateur = UAE2.idUtilisateur
                    JOIN Equipe E ON UAE1.idEquipe = E.idEquipe AND UAE2.idEquipe = E.idEquipe
                    WHERE E.idEquipe = $id_equipe)
                UNION
                (SELECT M.*, U1.*
                    FROM Message M
                    JOIN MessageDestinataire MD ON M.idMessage = MD.idMessage
                    JOIN Utilisateur U1 ON U1.idUtilisateur = M.idEnvoyeur
                    JOIN Utilisateur U2 ON U2.idUtilisateur = MD.idDestinataire
                    
                    JOIN Utilisateur G
                    JOIN DataEvent as D on G.idUtilisateur = D.idGestionnaire 
                    JOIN ProjetData as P on D.idDataEvent = P.idDataEvent 
                    JOIN Equipe E ON P.idProjetData = E.idProjetData
                    JOIN UtilisateurAppartientEquipe UAE ON E.idEquipe = UAE.idEquipe

                    WHERE E.idEquipe = $id_equipe AND ((U1.idUtilisateur = G.idUtilisateur AND U2.idUtilisateur = UAE.idUtilisateur) OR (U2.idUtilisateur = G.idUtilisateur AND U1.idUtilisateur = UAE.idUtilisateur))
                )
                ORDER BY dateEnvoi DESC;";
       

        $tab_temp = getAllFromRequest($cnx,$req);
        $tab = array_merge($tab,$tab_temp);

    }else if (isset($_GET["admin"]) && $typeUtilisateur == "administrateur") {
        // Recupère tous les messages

        $req = "SELECT * FROM Message JOIN Utilisateur on idEnvoyeur = idUtilisateur order by dateEnvoi DESC ";

        $tab_temp = getAllFromRequest($cnx,$req);
        $tab = array_merge($tab,$tab_temp);


    }else {
        // les messages de l'utilisateur
        $req = "SELECT M.*, U1.nom , U1.prenom
                    FROM Message M
                    JOIN MessageDestinataire MD ON M.idMessage = MD.idMessage
                    JOIN Utilisateur U
                    JOIN Utilisateur U1 ON U1.idUtilisateur = M.idEnvoyeur
                    JOIN Utilisateur U2 ON U2.idUtilisateur = MD.idDestinataire
                    WHERE (M.idEnvoyeur = $idUtilisateur OR MD.idDestinataire = $idUtilisateur) AND U.idUtilisateur = $idUtilisateur
                    order by M.dateEnvoi DESC;";


        $tab_temp = getAllFromRequest($cnx,$req);
        $tab = array_merge($tab,$tab_temp);
        
    }
    









    foreach($tab as $msg) {
        $id_msg = $msg["idMessage"];


        // Recupération nom envoyeur 
        $nomEnvoyeur = $msg["nom"] ." ". $msg["prenom"];
        
        $req = "select * from MessageDestinataire inner join Utilisateur on idUtilisateur = idDestinataire where idMessage = ".$msg["idMessage"].";";

        $rowsReceveur = getAllFromRequest($cnx,$req);
        $numrow = count($rowsReceveur);
        if (!in_array($id_msg,$array_messages_recup)) {
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
            array_push($array_messages_recup,$id_msg);
        }




    }

?>