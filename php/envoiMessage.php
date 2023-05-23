<?php

    include("bdd.php");
    include("verification.php");

    $referer = $_SERVER['HTTP_REFERER'];

    // $objet = valid($_POST["objet"]);
    // $contenu = valid($_POST["contenu"]);
    $objet = ($_POST["objet"]);
    $contenu = ($_POST["contenu"]);
    $destinataires = json_decode($_POST["destinataires"]);
    $envoyeur = 2;

    if ($destinataires !== [] && $destinataires != null) {
        $req = "insert into Message (dateEnvoi,objet,contenu,idEnvoyeur) values
            (now(),\"$objet\",\"$contenu\",$envoyeur);
        ";

        $result = mysqli_query($cnx,$req) or header("Location: $referer");

        $id_message = mysqli_insert_id($cnx);



        foreach($destinataires as $id_destinataire) {
            $req = "insert into MessageDestinataire (idMessage,idDestinataire) values
                ($id_message,$id_destinataire);";
            $result = mysqli_query($cnx,$req) or header("Location: $referer");
        }


    
        mysqli_close($cnx);

        header("Location: $referer");
    }else {

        header("Location: $referer");
    }

?>