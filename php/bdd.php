<?php
include("bddData.php");

function connexion($serveur, $bdd, $login, $password) {
    try {
        return new PDO( 'mysql:host=' . $serveur . ';dbname=' . $bdd . ';charset=utf8',
        $login,
        $password,
        [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]
        );
    }
    catch (Exception $e){
        die('Erreur' .$e -> getMessage());
    }
}

function deconnexion ()  {
    return null;
}
?>




