<?php
    include("../bdd.php");
    
    session_start();

    if (!(isset($_GET["lien"])) || !isset($_GET["equipe"])) {
        echo "fail";
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
        echo "fail";
        exit(1);
    }


    
    
    function callAPI($method, $url, $data){
        $curl = curl_init();
        switch ($method){
            case "POST":
                curl_setopt($curl, CURLOPT_POST, 1);
                if ($data)
                    curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
                break;
            case "PUT":
                curl_setopt($curl, CURLOPT_CUSTOMREQUEST, "PUT");
                if ($data)
                    curl_setopt($curl, CURLOPT_POSTFIELDS, $data);			 					
                break;
            default:
                if ($data)
                    $url = sprintf("%s?%s", $url, http_build_query($data));
        }
        // OPTIONS:
        curl_setopt($curl, CURLOPT_URL, $url);
        curl_setopt($curl, CURLOPT_HTTPHEADER, array(
            'APIKEY: default_kay',
            'Content-Type: application/json',
        ));
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($curl, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);
        // EXECUTE:
        $result = curl_exec($curl);
        if(!$result){die("Connection Failure");}
        curl_close($curl);
        return $result;
    }




    // "https://raw.githubusercontent.com/NoeFaucher/Simulation-Variable-Aleatoire/master/exo1.py";
    if (preg_match("\s*",$link_to_code)) {
        echo "fail";
        exit(1);
    }

    // recupère le code source
    $src_code = callAPI('GET', $link_to_code,[]);


    if (strpos($src_code, "404: Not Found") !== false) {
        echo "fail";
        exit(1);
    }


    $get_query = ["src_code" => $src_code];
    
    // appel l'api pour traiter le code source et retourne les résultats
    $result_json = callAPI('GET', 'localhost:8001/test', $get_query);
    
    
    
    $req = "insert into Rendu (dateRendu,lienRendu,resultatJson,idEquipe) values (now(),\"".$link_to_code."\",'".$result_json."',".$id_equipe.")";
    
    setFromRequest($cnx,$req);
    $cnx = deconnexion();
    
    echo "sucess";
?>