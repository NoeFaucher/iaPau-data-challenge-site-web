<?php

include "../varSession.inc.php";
include "../verification.php";
include "../bdd.php";

$email= valid($_POST["email_participant"]);
$mdp = valid($_POST["mot_de_passe_participant"]);


$mysqlClient = connexion($serveur, $bdd, $user, $pass);

$listutilisateur = getUtilisateur($mysqlClient);


if (!empty($email) and !empty($mdp)){

    $verifUtilisateur = getUtilisateurByEmail($mysqlClient,$email);

    if ((count($verifUtilisateur) != 0) and (password_verify($mdp,$verifUtilisateur["mdp"]))){
        $_SESSION["estconnecte"] = true;
        $_SESSION["idUtilisateur"] = $verifUtilisateur["idUtilisateur"];
        $_SESSION["email"] = $verifUtilisateur["email"];
        $_SESSION["typeUtilisateur"] = $verifUtilisateur["typeUtilisateur"];
        $_SESSION["nom"] = $verifUtilisateur["nom"];
        $_SESSION["prenom"] = $verifUtilisateur["prenom"];
    }
}

if ($_SESSION["estconnecte"]){
    header("Location: ../../index.php");
    exit();
}else{
    $_SESSION["validation"] = false;
    $_SESSION["POST"] = $_POST;
    header("Location: connexion.php");
    exit();
}
$mysqlClient = deconnexion();
session_abort()
?>