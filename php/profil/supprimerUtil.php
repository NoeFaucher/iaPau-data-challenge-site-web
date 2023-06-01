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

$words = explode(" ", $_GET["name"]);

$prenom = $words[0]; // "prenom"
$nom = $words[1]; // "nom"

$resultat = getIdGestionnaireByNom($cnx, $prenom, $nom);

$idUtilisateur = $resultat["idUtilisateur"];

supUtil($cnx, $idUtilisateur);

$cnx = deconnexion();

function supUtil($mysqlClient, $idUtilisateur){
    try {
        
        $sqlQuery = 'DELETE FROM Utilisateur WHERE idUtilisateur = :idUtilisateur';

        $updateDataEvent = $mysqlClient -> prepare($sqlQuery);
        $updateDataEvent ->execute([
            'idUtilisateur' => $idUtilisateur,
        ]);
    } catch (Exception $e) {
        die('Erreur : ' . $e->getMessage());
    }
}

header("Location: profil.php#utilAdmin");

?>