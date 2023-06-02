<?php
    include("../../bdd.php");
    include("apiCall.php");
    
    session_start();

    if (!(isset($_GET["lien"])) || !isset($_GET["equipe"])) {
        echo "fail not enouth argument";
        exit(1);
    }

    
    $id_equipe = $_GET["equipe"];
    $link_to_code = urldecode(base64_decode($_GET["lien"]));

    $id_user = $_SESSION["idUtilisateur"];

    $cnx =  connexion($serveur,$bdd,$user,$pass);
    $req = "select * from Equipe where idChefEquipe = $id_user and idEquipe = $id_equipe";
    $res = getAllFromRequest($cnx,$req);

    // verification que l'utilisateur est bien le chef d'equipe    
    if (count($res) == 0) {
        echo "fail not allow";
        exit(1);
    }


    
    




    // "https://raw.githubusercontent.com/NoeFaucher/Simulation-Variable-Aleatoire/master/exo1.py";
    if (preg_match("\s*",$link_to_code)) {
        echo "fail lien vide";
        exit(1);
    }

    // recupère le code source
    $src_code = callAPI('GET', $link_to_code,[]);


    if (strpos($src_code, "404: Not Found") !== false) {
        echo "fail lien invalide";
        exit(1);
    }


    $get_query = ["src_code" => $src_code];
    
    // appel l'api pour traiter le code source et retourne les résultats
    $result_json = callAPI('GET', 'localhost:8001/rendu', $get_query);
    
    
    
    $req = "insert into Rendu (dateRendu,lienRendu,resultatJson,idEquipe) values (now(),\"".$link_to_code."\",'".$result_json."',".$id_equipe.")";
    
    setFromRequest($cnx,$req);
    $cnx = deconnexion();
    
    echo "success";
?>