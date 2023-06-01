<?php 
    include("./apiCall.php");
    include("../../bdd.php");



    session_start();

    if (!(isset($_GET["occ"])) ||!(isset($_GET["equipe"]))) {
        echo "{}";
        exit(1);
    }

    $typeUtilisateur =  $_SESSION["typeUtilisateur"];
    
    $json_occ = urldecode(base64_decode($_GET["occ"]));

    // verification que l'utilisateur est un gestionnaire ou un admin    
    if ($typeUtilisateur == "normal") {
        echo "{}";
        exit(1);
    }

    $link_to_code = "https://raw.githubusercontent.com/NoeFaucher/Simulation-Variable-Aleatoire/master/exo1.py";

    $cnx = connexion($serveur,$bdd,$user,$pass);

    $req = "select * from Rendu where idEquipe = ".$_GET["equipe"]." order by dateRendu ASC;";

    $rendus = getAllFromRequest($cnx,$req);


    if(count($rendus) == 0) {
        echo "{}";
        exit;
    }

    // recupere le lien vers le dernier rendu
    $link_to_code = $rendus[0]["lienRendu"];

    // recupère le code source
    $src_code = callAPI('GET', $link_to_code,[]);


    if (strpos($src_code, "404: Not Found") !== false) {
        echo "{}";
        exit(1);
    }


    $get_query = ["src_code" => $src_code,"occ" => $json_occ];
    
    
    // appel l'api pour traiter le code source et retourne les résultats
    $result_json = callAPI('GET', 'localhost:8001/occurence', $get_query);

    echo $result_json;

?>