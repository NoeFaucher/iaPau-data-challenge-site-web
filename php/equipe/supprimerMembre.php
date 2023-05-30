<?php 
include '../bdd.php';
$cnx = connexion($serveur,$bdd,$user,$pass);

//Vérifie si l'utilisateur entré est un chef d'équipe
$reqCheck="SELECT * from Equipe
where idEquipe=".$_POST["idEqu"]."
and idChefEquipe=".$_POST["idUtil"].";";

$check1 = getAllFromRequest($cnx, $reqCheck);

$numbCheck = "SELECT count(idUtilisateur) 
from UtilisateurAppartientEquipe where idEquipe=".$_POST["idEqu"].";";

$number = getAllFromRequest($cnx, $numbCheck);

if (empty($check1) && $number[0]["count(idUtilisateur)"] > 3) {
    $req = "DELETE FROM UtilisateurAppartientEquipe 
    WHERE idUtilisateur=".$_POST["idUtil"]." AND idEquipe=".$_POST["idEqu"].";";
    echo "done";
    setFromRequest($cnx,$req);
}else if(!empty($check1)){
    echo "L'utilisateur que vous souhaitez supprimer est le chef de l'équipe";
}else if($number[0]["count(idUtilisateur)"] <= 3){
    echo "La taille de l'équipe ne peut pas être plus petite";
}



$cnx = deconnexion();
?>