<?php
include "../varSession.inc.php";
include "../verification.php";
include "../bdd.php";

if (!$_SESSION["estConnecte"]) {
    header("Location: ../connexion/connexion.php");
    exit();
}

// recuperation des information
$nom = valid($_POST["nom"]);
$prenom = valid($_POST["prenom"]);
$telephone = valid($_POST["telephone"]);
$email = valid($_POST["email"]);
$mdp = valid($_POST["mdp"]);
$mdpNew = valid($_POST["newMdp"]);
if ($_SESSION["typeUtilisateur"] === 'normal'){
    $etude = valid($_POST["nivEtude"]);
    $ecole = valid($_POST["ecole"]);
    $ville = valid($_POST["ville"]);
} else {
    $etude = NULL;
    $ecole = NULL;
    $ville = NULL;
}

$emailRegExp = '/^[^\s@]+@[^\s@]+\.[^\s@]+$/';
$mdpRegExp = '/^(?=.*?[A-Z])(?=.*?[a-z])(?=.*?[0-9])(?=.*?[#?!@$%^&*-]).{6,}$/';
$teleRegExp = '/^(0|\+33)[1-9]([-. ]?[0-9]{2}){4}$/';


$mysqlClient = connexion($serveur, $bdd, $user ,$pass);

$idUtilisateur = $_SESSION["idUtilisateur"];

$user = getUtilisateurById($mysqlClient,$idUtilisateur);

if (empty($nom)){
    header("Location: profil.php?erreur=1");
    $mysqlClient = deconnexion();
    exit();
}

if (empty($prenom)){
    header("Location: profil.php?erreur=2");
    $mysqlClient = deconnexion();
    exit();
}

if (preg_match($teleRegExp,$telephone)){

    $verifTel = getUtilisateurByTelephone($mysqlClient,$telephone);
    if ((isset($verifTel)) && ((count($verifTel)) != 0) && ($verifTel["idUtilisateur"] != $user["idUtilisateur"])) {
        header("Location: profil.php?erreur=4");
        $mysqlClient = deconnexion();
        exit();
    }
} else {
    header("Location: profil.php?erreur=3");
    $mysqlClient = deconnexion();
    exit();
}

if (preg_match($emailRegExp,$email)){

    $verif = getUtilisateurByEmail($mysqlClient,$email);
    if ((isset($verif)) && ((count($verif)) != 0 ) && ($verif["idUtilisateur"] != $user["idUtilisateur"])) {
        header("Location: profil.php?erreur=5");
        $mysqlClient = deconnexion();
        exit();
    }
} else {
    header("Location: profil.php?erreur=6");
    $mysqlClient = deconnexion();
    exit();
}


if ($_SESSION["typeUtilisateur"] === 'normal'){
    if (empty($ecole)){
        header("Location: profil.php?erreur=7");
        $mysqlClient = deconnexion();
        exit();
    }

    if (empty($ville)){
        header("Location: profil.php?erreur=8");
        $mysqlClient = deconnexion();
        exit();
    }
}

if (password_verify($mdp,$user["mdp"])){
    if (!empty($mdpNew)){
        if (preg_match($mdpRegExp,$mdpNew)){
            $mdp = password_hash($mdpNew,PASSWORD_DEFAULT);
        } else {
         header("Location: profil.php?erreur=10");
         $mysqlClient = deconnexion();
         exit();
        }
    } else {
        $mdp = password_hash($mdp,PASSWORD_DEFAULT);
    }
} else {
    header("Location: profil.php?erreur=9");
    $mysqlClient = deconnexion();
    exit();

}



modifUser($mysqlClient,$idUtilisateur,$telephone,$email,$mdp,$etude,$nom,$prenom,$ecole,$ville);
$_SESSION["telephone"] = $telephone;
$_SESSION["email"] = $email;
$_SESSION["nom"] = $nom;
$_SESSION["prenom"] = $prenom;

if ($_SESSION["typeUtilisateur"] == 'normal')  {
$_SESSION["nivEtude"] = $etude;
$_SESSION["ecole"] = $ecole;
$_SESSION["ville"] = $ville;
} else {
$etude = NULL;
$ecole = NULL;
$ville = NULL;
}


header("Location: profil.php#infos");
$mysqlClient = deconnexion();
exit();
?>