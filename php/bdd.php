<?php
    
    include("bddData.php");
    
    $cnx = mysqli_connect($serveur,$user,$pass);
    if (mysqli_connect_errno()) {
        echo mysqli_connect_error();
    };
    
    $res_bool = mysqli_select_db($cnx,$bdd);
    if (!$res_bool) throw new Exception("$bdd database introuvable");


?>




