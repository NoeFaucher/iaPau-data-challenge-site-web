<?php 
include '../bdd.php';
$cnx = connexion($serveur,$bdd,$user,$pass);

//Vérifie si l'utilisateur entré est déjà dans une équipe pour ce DataChallenge
$reqCheck1 =  "SELECT idUtilisateur, Equipe.idEquipe
from UtilisateurAppartientEquipe UAE
inner join Equipe on UAE.idEquipe = Equipe.idEquipe
and Equipe.idDataEvent =  ".$_POST["idDataEv"]."
and idUtilisateur = ".$_POST["idUtil"]."
;";

$check1 = getAllFromRequest($cnx, $reqCheck1);

$reqCheckNombre = "SELECT count(idUtilisateur) 
from UtilisateurAppartientEquipe where idEquipe=".$_POST["idEqu"].";";

$number = getAllFromRequest($cnx, $reqCheckNombre);

echo var_dump($number);

if (empty($check1) && ($number[0]["countidUtilisateur"] < 8 )) {
    $req = "INSERT INTO UtilisateurAppartientEquipe (idUtilisateur, idEquipe) 
    VALUES (".$_POST["idUtil"].", ".$_POST["idEqu"].");";
    echo "done";
    setFromRequest($cnx,$req);
} else if (!empty($check1)){
    echo "L'utilisateur participe déjà à ce Data Challenge";
}else if($number[0]["countidUtilisateur"] >= 8){
    echo "Trop de membre dans cette équipe (8 max)";
}

$cnx = deconnexion();

?>