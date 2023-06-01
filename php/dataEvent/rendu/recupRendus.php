<?php
    include("../../bdd.php");
    
    session_start();

    if (!isset($_GET["equipe"]) || !isset($_SESSION["idUtilisateur"])) {
        echo "[]";
        exit;
    }

    
    $id_equipe = $_GET["equipe"];

    $id_user = $_SESSION["idUtilisateur"];

    $cnx =  connexion($serveur,$bdd,$user,$pass);
    $req = "select * from UtilisateurAppartientEquipe where idUtilisateur = $id_user and idEquipe = $id_equipe";
    $res = getAllFromRequest($cnx,$req);

    // verification que l'utilisateur est membre de l'équipe et n'est pas un admin ou le gestionnaire
    if (count($res) == 0 && $_SESSION["typeUtilisateur"] == "normal") {
        echo "[]";
        exit;
    }


    $cnx = connexion($serveur,$bdd,$user,$pass);

    $req = "select * from Rendu where idEquipe = ".$_GET["equipe"]." order by dateRendu ASC;";

    $tab = getAllFromRequest($cnx,$req);

    echo json_encode($tab);


?>