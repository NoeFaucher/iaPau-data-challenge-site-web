
<?php
    
    include("../bdd.php");



    $req = "select * from Message inner join Utilisateur on idEnvoyeur = idUtilisateur order by dateEnvoi DESC ";






    
    $cnx = connexion($serveur,$bdd,$user,$pass);

    $tab = getAllFromRequest($cnx,$req);



    foreach($tab as $msg) {

        // Recupération nom envoyeur 
        $nomEnvoyeur = $msg["nom"] ." ". $msg["prenom"];
        
        $req = "select * from MessageDestinataire inner join Utilisateur on idUtilisateur = idDestinataire where idMessage = ".$msg["idMessage"].";";

        $rowsReceveur = getAllFromRequest($cnx,$req);
        $numrow = count($rowsReceveur);
        
        $receveurs = ""; 
        for($i=0;$i<$numrow;$i++) {
            $receveur = $rowsReceveur[$i];
            $nomReceveur = $receveur["nom"]." ".$receveur["prenom"];
            $receveurs = $receveurs.$nomReceveur;
            if ($i!= $numrow-1){
                $receveurs = $receveurs.", ";
            }
        }



        echo "
                <div class='message'>
                    <p class='envoyeur' ><span>De: </span>".$nomEnvoyeur." <span>à</span> ".$receveurs."</p>
                    <p class='objet' ><span>Objet:</span> ".$msg["objet"]."</p>
                    <p class='date' >".$msg["dateEnvoi"]."</p>
                    <p class='contenu' >".$msg["contenu"]."</p>
                </div>


        ";

    }

?>