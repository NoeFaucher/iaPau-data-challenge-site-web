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

$words = explode(" ", $_POST["nomUtil"]);

$prenom = $words[0]; // "prenom"
$nom = $words[1]; // "nom"

$resultat = getIdUtilisateurByNom($cnx, $prenom, $nom);

$idUtilisateur = $resultat["idUtilisateur"];

$mdp = password_hash($_POST["newMdp"],PASSWORD_DEFAULT);



if ($_POST["typeUtil"] == "normal") {
    modifUser($cnx,$idUtilisateur,$_POST["telephone"],$_POST["mail"],$mdp,$_POST["nivEtude"],$_POST["nom"],$_POST["prenom"],$_POST["ecole"],$_POST["ville"]);
}elseif($_POST["typeUtil"] == "gestionnaire"){
    modifUser($cnx,$idUtilisateur,$_POST["telephone"],$_POST["mail"],$mdp,NULL,$_POST["nom"],$_POST["prenom"],NULL,NULL);
}







?>
