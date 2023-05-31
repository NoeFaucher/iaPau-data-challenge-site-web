<?php
include "../varSession.inc.php";
include "../verification.php";
include "../bdd.php";

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

$modifValide = true; 

$mysqlClient = connexion($serveur, $bdd, $user ,$pass);

$idUtilisateur = $_SESSION["idUtilisateur"];

$user = getUtilisateurById($mysqlClient,$idUtilisateur);

if (empty($nom)){
    $modifValide = false; 
}

if (empty($prenom)){
    $modifValide = false; 
}

if (preg_match($teleRegExp,$telephone)){

    $verifTel = getUtilisateurByTelephone($mysqlClient,$telephone);
    var_dump($verifTel);
    if ((isset($verifTel)) && ((count($verifTel)) != 0) && ($verifTel["idUtilisateur"] != $user["idUtilisateur"])) {
        $modifValide = false;
    }
} else {
    $modifValide = false; 
}

if (preg_match($emailRegExp,$email)){

    $verif = getUtilisateurByEmail($mysqlClient,$email);
    var_dump($verif);
    if ((isset($verif)) && ((count($verif)) != 0 ) && ($verif["idUtilisateur"] != $user["idUtilisateur"])) {
        $modifValide = false;
    }
} else {
    $modifValide = false; 
}


if ($_SESSION["typeUtilisateur"] === 'normal'){
    if (empty($ecole)){
        $modifValide = false;
    }

    if (empty($ville)){
        $modifValide = false;
    }
}

if (password_verify($mdp,$user["mdp"])){
    if (!empty($mdpNew)){ 
        $mdp = password_hash($mdpNew,PASSWORD_DEFAULT);
    } else {
        $mdp = password_hash($mdp,PASSWORD_DEFAULT);
    }
} else {
    $modifValide = false;

}




if ($modifValide) {
    

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
}

header("Location: profil.php");

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
