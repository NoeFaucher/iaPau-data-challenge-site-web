<?php

$_POST = json_decode(file_get_contents('php://input'), true);
$nom = $_POST['nom'];
$prenom =$_POST['prenom'];
$email =$_POST['email'];   
$niveau =$_POST['nivEtude'];  
$ecole =$_POST['ecole'];  
$ville =$_POST['ville'];  

// Création de la connexion
$conn = new mysqli($servername, $username, $password, $dbname);

//requête SQL
$sql = "DELETE FROM utilisateur WHERE nom = '$nom' AND prenom = '$prenom' AND email = '$email' AND nivEtude = '$niveau' AND ecole = '$ecole' AND ville = '$ville'";
$result = $conn->query($sql);

$conn->close();

header('Location: utilisateurs.php');

?>