<?php
include("bddData.php");

function connexion($serveur,$bdd,$user,$pass) {
    try {
        return new PDO( 'mysql:host=' . $serveur . ';dbname=' . $bdd . ';charset=utf8',
        $user,
        $pass,
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

function setFromRequest($mysqlClient,$request) {
    try {
        $statement = $mysqlClient->prepare($request);
        $statement->execute();
    }
    catch(Exception $e) {
        die('Erreur : ' . $e->getMessage());
    }

}

function getLastInsertId($mysqlClient) {
    return $mysqlClient->lastInsertId();
}

function getAllFromRequest($mysqlClient,$request) {

    try {
        $statement = $mysqlClient->prepare($request);
        $statement->execute();
        $tableau = $statement->fetchAll();
        return $tableau;
    }
    catch(Exception $e) {
        die('Erreur : ' . $e->getMessage());
    }
}

function getUtilisateur($mysqlClient) {
    $sqlQuery = 'SELECT * FROM Utilisateur';
    try {
        $statement = $mysqlClient->prepare($sqlQuery);
        $statement->execute();
        $tableau = $statement->fetchAll();
        return $tableau;
    }
    catch(Exception $e) {
        die('Erreur : ' . $e->getMessage());
    }

}

function getUtilisateurByEmail($mysqlClient,$utilisateurEmail) {
    $sqlQuery = 'SELECT * FROM Utilisateur WHERE email = :email';
    try {
        $statement = $mysqlClient->prepare($sqlQuery);
        $statement->execute([
            'email' => $utilisateurEmail,
        ]);
        $tableau = $statement->fetchAll();
        return $tableau[0];
    }
    catch(Exception $e) {
        die('Erreur : ' . $e->getMessage());
    }

}





?>




