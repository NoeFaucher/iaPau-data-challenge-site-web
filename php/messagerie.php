<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/css/messagerie.css">
    <title>Document</title>
    <script src="/js/messagerie.js"></script>
</head>
<body>
    <?php
        $curent_user = 2;
    ?>


    <div class="message-conteneur">

        <?php
            include("bdd.php");

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


    </div>
    
   
    <form action="envoiMessage.php" method="post">

        <label for="objet">Objet:</label>
        <input type="text" name="objet" id="in-objet" required>

        <label for="list-destinataire">Destinataires:</label>

        <div class="gestion-destinataire">
            <input type="text" id="input-current-destinataire" name="list-destinataire" list="destinataires-list" autocomplete="on" >
            <datalist id="destinataires-list">
                <?php

                    $req = "select nom,prenom,idUtilisateur from Utilisateur;";





                    // $numrow = mysqli_num_rows($result);
                    $tab = getAllFromRequest($cnx,$req);


                    foreach($tab as $util) {
                        $nom_prenom = $util["nom"].' '.$util["prenom"];
                        $idDestinataire = $util['idUtilisateur'];
                        echo '<option value="'.$nom_prenom.'" data-id="'.$idDestinataire.'">'.$nom_prenom.'</option>;';
                    }
                    
                
                    $cnx = deconnexion();
                ?>
            </datalist>
            <input type="button" value="Ajouter destinataire" onclick="ajouterDestinataire()">
            <p>
                Destinataires sélectionnés : 
                <span id="destinataire-selectionne">
                
                </span>
            </p>
            
            <input id="input-destinataires" type="hidden" name="destinataires" value="[]" required >

        </div>

        



        <label for="contenu">Message:</label>
        <textarea name="contenu" id="input-message" cols="30" rows="10"></textarea>
        <input type="submit" value="Envoyer">

    </form>
    <?php
        if(isset($_GET["send"])){
            if ($_GET["send"] == "true") {
                echo "message envoyé";
            }else {
                echo "problème dans l'envoie du message";
            }
        }
    ?>

</body>
</html>