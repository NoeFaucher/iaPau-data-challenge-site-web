<?php
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




    $link_to_code = "https://raw.githubusercontent.com/NoeFaucher/Simulation-Variable-Aleatoire/master/exo1.py";

    $src_code = callAPI('GET', $link_to_code,[]);

    $get_query = ["src_code" => $src_code];

    
    $get_data = callAPI('GET', 'localhost:8001/test', $get_query);
    
    $response = json_decode($get_data, true);
    $errors = $response['response']['errors'];
    $data = $response['response']['data'][0];


    echo $get_data." ".$errors." ". $data;
?>