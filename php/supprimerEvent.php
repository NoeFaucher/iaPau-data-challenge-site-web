<?php

$_POST = json_decode(file_get_contents('php://input'), true);
$titre = $_POST['titre'];
$nomEntreprise = $_POST['entreprise'];
$dateDebut =$_POST['dateDebut'];
$dateFIN =$_POST['dateFIN'];   
$descript =$_POST['descript'];  
$type = $_SESSION['typeDataEvent'];

// Création de la connexion
$conn = new mysqli($servername, $username, $password, $dbname);

//requête SQL
$sql = "DELETE FROM DataEvent WHERE titre = '$titre' AND nomEntreprise = '$nomEntreprise' AND dateDebut = '$dateDebut' AND dateFIN = '$dateFIN' AND descript = '$descript'";
$result = $conn->query($sql);

$conn->close();

if($type = 'DataChallenge'){
    header('Location: challenge.php');
}else{
    header('Location: battle.php');
}

?>