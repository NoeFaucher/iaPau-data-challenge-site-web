<?php
include "../varSession.inc.php";
include "../verification.php";
include "../bdd.php";

// variable de connexion

$_SESSION["estConnecte"] = false;
$_SESSION["idUtilisateur"] = NULL;
$_SESSION["email"] = NULL;
$_SESSION["typeUtilisateur"] = NULL;
$_SESSION["nom"] = NULL;
$_SESSION["prenom"] = NULL;


// variable de verification
$_SESSION["validation"] = NULL;
$_SESSION["POST"] = NULL;
$_SESSION["invalide"] = NULL;
$_SESSION["indisponible"] = NULL;
$_SESSION["different"]["mdp"] = NULL;


// recuperation des information
$nom = valid($_POST["nom_participant"]);
$prenom = valid($_POST["prenom_participant"]);
$telephone = valid($_POST["telephone_participant"]);
$email = valid($_POST["email_participant"]);
$mdp = valid($_POST["mot_de_passe_participant"]);
$mdpConfirmation = valid($_POST["mot_de_passe_participant"]);
$etude = valid($_POST["niveau_etude_participant"]);
$ecole = valid($_POST["ecole_participant"]);
$ville = valid($_POST["ville_participant"]);


$emailRegExp = '/^[^\s@]+@[^\s@]+\.[^\s@]+$/';
$mdpRegExp = '/^(?=.*?[A-Z])(?=.*?[a-z])(?=.*?[0-9])(?=.*?[#?!@$%^&*-]).{6,}$/';
$teleRegExp = '/^(0|\+33)[1-9]([-. ]?[0-9]{2}){4}$/';

$inscriptionValide = true;

$mysqlClient = connexion($serveur, $bdd, $user ,$pass);

if (empty($nom)){
    $inscriptionValide = false;
    $_SESSION["invalide"]["nom"] = true;
}

if (empty($prenom)){
    $inscriptionValide = false;
    $_SESSION["invalide"]["prenom"] = true;
}

if (preg_match($teleRegExp,$telephone)){

    $verifTel = getUtilisateurByTelephone($mysqlClient,$telephone);
    if ((isset($verifTel)) && (count($verifTel)) != 0) {
        $inscriptionValide = false;
        $_SESSION["indisponible"]["telephone"] = true;
    }
} else {
    $inscriptionValide = false;
    $_SESSION["invalide"]["telephone"] = true;

}

if (preg_match($emailRegExp,$email)){

    $verif = getUtilisateurByEmail($mysqlClient,$email);
    if ((isset($verif)) && (count($verif)) != 0) {
        $inscriptionValide = false;
        $_SESSION["indisponible"]["email"] = true;
    }
} else {
    $inscriptionValide = false;
    $_SESSION["invalide"]["email"] = true;

}

if (preg_match($mdpRegExp,$mdp)) {
    if ($mdp !== $mdpConfirmation){
        $inscriptionValide = false;
        $_SESSION["different"]["mdp"] = true;
    }
} else {
    $inscriptionValide = false;
    $_SESSION["invalide"]["mdp"] = true;
}

//if (!(($etude === "L1") || ($etude === "L2") || ($etude === "L3") || ($etude === "M1") || ($etude === "M2") || ($etude === "D"))) {
//    $inscriptionValide = false;
//    $_SESSION["invalide"]["nivEtude"] = true;
//}

if (empty($ecole)){
    $inscriptionValide = false;
    $_SESSION["invalide"]["ecole"] = true;
}

if (empty($ville)){
    $inscriptionValide = false;
    $_SESSION["invalide"]["ville"] = true;
}

if ($inscriptionValide) {
    $typeUtilisateur = 'normal';

    addUser($mysqlClient,$telephone ,$email, password_hash($mdp, PASSWORD_DEFAULT), $typeUtilisateur, $etude, $nom, $prenom, $ecole, $ville);
    $idUtilisateur = getLastInsertId($mysqlClient);
    $_SESSION["estConnecte"] = true;
    $_SESSION["telephone"] = $telephone;
    $_SESSION["idUtilisateur"] = $idUtilisateur;
    $_SESSION["email"] = $email;
    $_SESSION["typeUtilisateur"] = $typeUtilisateur;
    $_SESSION["nom"] = $nom;
    $_SESSION["prenom"] = $prenom;
    $_SESSION["nivEtude"] = $etude;
    $_SESSION["ecole"] = $ecole;
    $_SESSION["ville"] = $ville;

}

$mysqlClient = deconnexion();

if ($_SESSION["estConnecte)"]){
    header("Location: ../../index.php");
} else {
    $_SESSION["validation"] = false;
    $_SESSION["POST"] = $_POST;
    header("Location: inscription.php");
}
exit();

