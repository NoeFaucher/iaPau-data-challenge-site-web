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




