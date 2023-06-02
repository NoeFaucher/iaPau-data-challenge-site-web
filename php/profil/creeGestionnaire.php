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

addUser($cnx,$_POST["telephone"],$_POST["mail"],password_hash($_POST["mdp"],PASSWORD_DEFAULT),'gestionnaire',NULL,$_POST["nom"],$_POST["prenom"],NULL,NULL);

header("Location: profil.php");

?>