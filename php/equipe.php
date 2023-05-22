<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="../css/equipe.css">
    <title>Gestion d'équipe - IA Pau</title>
</head>
    <?php
    include 'bdd.php';
    $_SESSION["idUtilisateur"] = 1;
    $test = 2;

        if ($test == 1) {

            $req = 'SELECT Equipe.idEquipe, nomEquipe 
            FROM DataEvent INNER JOIN Equipe 
            on Equipe.idDataEvent=DataEvent.idDataEvent 
            and DataEvent.idDataEvent = any 
            (SELECT idDataEvent 
            FROM DataEvent INNER JOIN Utilisateur 
            on Utilisateur.idUtilisateur = DataEvent.idDataEvent 
            and DataEvent.idGestionnaire = '.$_SESSION["idUtilisateur"].');';
        }elseif ($test == 2) {

            $req = 'SELECT Equipe.idEquipe, nomEquipe 
            FROM DataEvent INNER JOIN Equipe 
            on Equipe.idDataEvent=DataEvent.idDataEvent;';
        }else {

            $req = 'SELECT Equipe.idEquipe, nomEquipe
            FROM UtilisateurAppartientEquipe INNER JOIN Equipe
            on UtilisateurAppartientEquipe.idEquipe = Equipe.idEquipe
            and UtilisateurAppartientEquipe.idUtilisateur = '.$_SESSION["idUtilisateur"].';';
        }
    
            
        $resultat = mysqli_query($cnx,$req);
        

        while($ligne = mysqli_fetch_assoc($resultat)){
            echo "<div class='boxEquipe'>";
            echo '<h2>'.$ligne["nomEquipe"].'</h2>';
            echo "</div>";

        }


    ?>
    
    <div class="boxEquipe">
        <h2> Team test</h2>
        <hr>
    </div>
</body>
</html>