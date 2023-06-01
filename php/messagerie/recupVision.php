<?php

    include("../bdd.php");

    session_start();

    if (!isset($_SESSION["idUtilisateur"])) {
        exit;
    }

    $idUtilisateur = $_SESSION["idUtilisateur"];
    $typeUtilisateur = $_SESSION["typeUtilisateur"];
    
    $cnx = connexion($serveur,$bdd,$user,$pass);

    if ($typeUtilisateur == "gestionnaire") {
        // recup toutes ses equipes
        $req = "select * from Equipe as e
        inner join ProjetData as p on p.idProjetData = e.idProjetData
        inner join DataEvent as d on d.idDataEvent = p.idDataEvent
        where d.idGestionnaire = $idUtilisateur;";
    
        $tab = getAllFromRequest($cnx,$req);

        echo "<option value='utilisateur' data-id=''>Mes messages :</option>;";

        foreach($tab as $equipe) {
            $nom_equipe = $equipe["nomEquipe"];
            $id_equipe = $equipe["idEquipe"];
            $nom_projet_data = $equipe["titreProjetData"];
            echo "<option value='equipe' data-id='$id_equipe'>Equipe: $nom_equipe du projet $nom_projet_data :</option>;";
        }




    }else if ($typeUtilisateur == "normal") {
        // recup toutes les equipes au quelles il appartient








    }elseif ($typeUtilisateur == "administrateur") {
        // toutes les equipes + tous


    }






//Select pour récuperer tout les Data Challenge du gestionnaire (remplacer au niveau du "where" par data battle
$requete = "SELECT *
                    FROM DataEvent 
                    INNER JOIN Equipe on Equipe.idProjetData = DataEvent.idDataEvent 
                    WHERE typeDataEvent='DataChallenge'
                    and DataEvent.idDataEvent = any 
                    (SELECT idDataEvent 
                    FROM DataEvent INNER JOIN Utilisateur 
                    on Utilisateur.idUtilisateur = DataEvent.idDataEvent 
                    and DataEvent.idGestionnaire = '".$_SESSION["idUtilisateur"]."');";




//Select pour récuperer tout les data Challenges d'un utilisateur normal (pareil pour data battle faut remplacer le type)
     $requete = "SELECT *
                    FROM UtilisateurAppartientEquipe 
                    INNER JOIN Equipe ON UtilisateurAppartientEquipe.idEquipe = Equipe.idEquipe
                    INNER JOIN DataEvent D ON Equipe.idProjetData = D.idDataEvent
                    WHERE UtilisateurAppartientEquipe.idUtilisateur ='".$_SESSION["idUtilisateur"]."'
                    AND D.typeDataEvent='DataChallenge';";







//Pour l'admin, on récup juste tout
$requete = "SELECT * FROM DataEvent WHERE typeDataEvent='DataChallenge';";
















    // $req = "select nom,prenom,idUtilisateur from Utilisateur;";


    // $cnx = connexion($serveur,$bdd,$user,$pass);



    // // $numrow = mysqli_num_rows($result);
    // $tab = getAllFromRequest($cnx,$req);


    // foreach($tab as $util) {
    //     $nom_prenom = $util["nom"].' '.$util["prenom"];
    //     $idDestinataire = $util['idUtilisateur'];
    //     echo '<option value="'..'" data-id="'..'">'..'</option>;';
    // }
    

    // $cnx = deconnexion();




?>