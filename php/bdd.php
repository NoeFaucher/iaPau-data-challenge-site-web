<?php
    
    include("bddData.php");
    
    $cnx = mysqli_connect($serveur,$user,$pass);
    if (mysqli_connect_errno($cnx)) {
        echo mysqli_connect_error();
    };
    
    $res_bool = mysqli_select_db($cnx,$bdd_name);
    if (!$res_bool) throw new Exception("$bdd_name database introuvable");


?>




