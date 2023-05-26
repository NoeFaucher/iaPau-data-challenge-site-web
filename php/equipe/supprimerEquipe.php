<?php 
include '../bdd.php';
$cnx = connexion($serveur,$bdd,$user,$pass);

$req = "DELETE FROM Equipe where idEquipe = ".$_POST["idEqu"].";";

setFromRequest($cnx,$req);

echo $req;

$cnx = deconnexion();

?>