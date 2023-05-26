<?php 
include '../bdd.php';
$cnx = connexion($serveur,$bdd,$user,$pass);

//Vérifie si l'utilisateur entré est un chef d'équipe
$reqCheck="SELECT * from Equipe
where idEquipe=".$_POST["idEqu"]."
and idChefEquipe=".$_POST["idUtil"].";";

$check1 = getAllFromRequest($cnx, $reqCheck);

if (empty($check1)) {
    $req = "DELETE FROM UtilisateurAppartientEquipe 
    WHERE idUtilisateur=".$_POST["idUtil"]." AND idEquipe=".$_POST["idEqu"].";";
    echo "done";
    setFromRequest($cnx,$req);
}else {
    echo "L'utilisateur que vous souhaitez supprimer est le chef de l'équipe";
}



$cnx = deconnexion();
?>