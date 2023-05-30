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
            
        $cnx = connexion($serveur,$bdd,$user,$pass);

        setFromRequest($cnx,$req);

        $id_message = getLastInsertId($cnx);

        foreach($destinataires as $id_destinataire) {
            $req = "insert into MessageDestinataire (idMessage,idDestinataire) values
                ($id_message,$id_destinataire);";
            setFromRequest($cnx,$req);
        }


    
        $cnx = deconnexion();

        header("Location: $referer");
    }else {

        header("Location: $referer");
    }

?>