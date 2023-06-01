<?php

include "../varSession.inc.php";
include "../verification.php";
include "../bdd.php";

$_SESSION["POST"] = NULL;
$_SESSION["estConnecte"] = false;
$_SESSION["idUtilisateur"] = NULL;
$_SESSION["email"] = NULL;
$_SESSION["typeUtilisateur"] = NULL;
$_SESSION["nom"] = NULL;
$_SESSION["prenom"] = NULL;
$_SESSION["telephone"] = NULL;
$_SESSION["etude"] = NULL;
$_SESSION["ecole"] = NULL;
$_SESSION["ville"] = NULL;


$email= valid($_POST["email_participant"]);
$mdp = valid($_POST["mot_de_passe_participant"]);


$mysqlClient = connexion($serveur, $bdd, $user, $pass);

if (!empty($email) and !empty($mdp)){

    $verifUtilisateur = getUtilisateurByEmail($mysqlClient,$email);

    if ((count($verifUtilisateur) != 0) and (password_verify($mdp,$verifUtilisateur["mdp"]))){
        $_SESSION["estConnecte"] = true;
        $_SESSION["telephone"] = $verifUtilisateur["telephone"];
        $_SESSION["idUtilisateur"] = $verifUtilisateur["idUtilisateur"];
        $_SESSION["email"] = $verifUtilisateur["email"];
        $_SESSION["typeUtilisateur"] = $verifUtilisateur["typeUtilisateur"];
        $_SESSION["nom"] = $verifUtilisateur["nom"];
        $_SESSION["prenom"] = $verifUtilisateur["prenom"];

        if ($_SESSION["typeUtilisateur"] == 'normal')  {
            $_SESSION["nivEtude"] = $verifUtilisateur["nivEtude"];
            $_SESSION["ecole"] = $verifUtilisateur["ecole"];
            $_SESSION["ville"] = $verifUtilisateur["ville"];
        }
    }
}

if ($_SESSION["estConnecte"]){
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