<?php
include "../varSession.inc.php";
include "../verification.php";
include "../bdd.php";

if ($_SESSION["estConnecte"]) {
    if ($_SESSION["typeUtilisateur"] != 'administrateur'){
        header("Location: profil.php");
        exit();
    }
} else {
    header("Location: ../connexion/connexion.php");
    exit();
}

$cnx = connexion($serveur, $bdd, $user, $pass);

$idProjetData = $_GET["idProjetData"];



supProjetData($cnx, $idProjetData);


function supProjetData($mysqlClient, $idProjetData){
    try {
        
        $sqlQuery = 'DELETE FROM ProjetData WHERE idProjetData = :idProjetData';

        $updateDataEvent = $mysqlClient -> prepare($sqlQuery);
        $updateDataEvent ->execute([
            'idProjetData' => $idProjetData,
        ]);
    } catch (Exception $e) {
        die('Erreur : ' . $e->getMessage());
    }
}

$cnx = deconnexion();

header("Location: profil.php#projetdata");


?>