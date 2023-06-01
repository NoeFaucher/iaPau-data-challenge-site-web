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

function getUtilisateurById($mysqlClient,$idUtilisateur) {
    $sqlQuery = 'SELECT * FROM Utilisateur WHERE idUtilisateur = :email';
    try {
        $statement = $mysqlClient->prepare($sqlQuery);
        $statement->execute([
            'email' => $idUtilisateur,
        ]);
        $tableau = $statement->fetchAll();
        return $tableau[0];
    }
    catch(Exception $e) {
        die('Erreur : ' . $e->getMessage());
    }
}

function getUtilisateurByTelephone($mysqlClient,$utilisateurTelephone) {
    $sqlQuery = 'SELECT * FROM Utilisateur WHERE telephone = :telephone';
    try {
        $statement = $mysqlClient->prepare($sqlQuery);
        $statement->execute([
            'telephone' => $utilisateurTelephone,
        ]);
        $tableau = $statement->fetchAll();
        return $tableau[0];
    }
    catch(Exception $e) {
        die('Erreur : ' . $e->getMessage());
    }

}

function addUser($mysqlClient,$telephone,$email,$mdp,$typeUtilisateur,$etude,$nom,$prenom,$ecole,$ville) {
    try {
        $sqlQuery = 'INSERT INTO Utilisateur(telephone,email,mdp,typeUtilisateur,nivEtude,nom,prenom,ecole,ville) VALUES (:telephone,:email,:mdp,:typeUtilisateur,:nivEtude,:nom,:prenom,:ecole,:ville)';
        $updateUser = $mysqlClient->prepare($sqlQuery);
        $updateUser -> execute ([
            'telephone' => $telephone,
            'email' => $email,
            'mdp' => $mdp,
            'typeUtilisateur' => $typeUtilisateur,
            'nivEtude'=> $etude,
            'nom' => $nom,
            'prenom' => $prenom,
            'ecole' => $ecole,
            'ville' => $ville,
        ]);
    } catch (Exception $e) {
        die('Erreur : ' . $e->getMessage());
    }

}

function modifUser($mysqlClient,$idUtilisateur,$telephone,$email,$mdp,$nivEtude,$nom,$prenom,$ecole,$ville){
    try {

        $sqlQuery = 'UPDATE Utilisateur SET telephone = :telephone, email = :email, mdp = :mdp, nivEtude = :nivEtude, nom = :nom, prenom = :prenom, ecole = :ecole, ville = :ville WHERE idUtilisateur = :idUtilisateur';

        $updateDataEvent = $mysqlClient -> prepare($sqlQuery);
        $updateDataEvent ->execute([
            'telephone' => $telephone,
            'email' => $email,
            'mdp' => $mdp,
            'nivEtude' => $nivEtude,
            'nom' => $nom,
            'prenom' => $prenom,
            'ecole' => $ecole,
            'ville' => $ville,
            'idUtilisateur' => $idUtilisateur,
        ]);
    } catch (Exception $e) {
        die('Erreur : ' . $e->getMessage());
    }
}

function getIdUtilisateurByNom($mysqlClient, $prenom, $nom) {
    try {
        $sqlQuery = 'SELECT idUtilisateur FROM Utilisateur  WHERE prenom = :prenom AND nom = :nom';
        $idUtilisateur = $mysqlClient -> prepare($sqlQuery);
        $idUtilisateur ->execute([
            'prenom' => $prenom,
            'nom' => $nom,
        ]);
        $tableau = $idUtilisateur->fetchAll();
        return $tableau[0];
    } catch (Exception $e) {
        die('Erreur : ' . $e->getMessage());
    }
}


function getTypeDataEventById($mysqlClient,$idDataEvent) {
    try {
        $sqlQuery = 'SELECT typeDataEvent FROM DataEvent WHERE  idDataEvent = :idDataEvent';
        $idTypeDataEvent = $mysqlClient -> prepare($sqlQuery);
        $idTypeDataEvent -> execute([
            'idDataEvent' => $idDataEvent,
        ]);
        $tableau = $idTypeDataEvent->fetchAll();
        return $tableau[0];
    } catch (Exception $e) {
        die('Erreur : ' . $e->getMessage());
    }
}
?>
