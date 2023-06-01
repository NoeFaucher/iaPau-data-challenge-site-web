<?php

    session_start();
    include("../bdd.php");
    include("../verification.php");
    
    $objet = ($_GET["objet"]);
    $contenu = ($_GET["contenu"]);
    $destinataires = json_decode(urldecode($_GET["destinataires"]));
    $envoyeur = $_SESSION["idUtilisateur"];


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

        echo "success";
    }else {
        echo "destvide";
    }

?>