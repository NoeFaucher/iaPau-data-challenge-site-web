<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="../css/equipe.css">
    <title>Gestion d'équipe - IA Pau</title>
</head>
<body>
    <p>Page équipe</p>
    <?php
    $_SESSION["typeUtilisateur"] = 'gestionnaire';
    $_SESSION["idUtilisateur"] = 2;



    switch ($_SESSION["typeUtilisateur"]) {
        case 'administrateur':
            $req = 'SELECT idDataEvent FROM DataEvent';
            break;

        case 'gestionnaire':
            $req = 'SELECT Equipe.idEquipe, nomEquipe 
            FROM DataEvent INNER JOIN Equipe 
            on Equipe.idDataEvent=DataEvent.idDataEvent 
            and DataEvent.idDataEvent = any 
                (SELECT idDataEvent 
                FROM DataEvent INNER JOIN Utilisateur 
                on Utilisateur.idUtilisateur = DataEvent.idDataEvent 
                and DataEvent.idGestionnaire = '.$_SESSION["idUtilisateur"].');';

        
            break;

        case 'normal':
            
            break;
    
        default:
            header("Location: ../index.php?error=1");
            break;
    }

    /*
    "SELECT Equipe.idEquipe, nomEquipe 
    FROM DataEvent INNER JOIN Equipe 
    on Equipe.idDataEvent=DataEvent.idDataEvent 
    and DataEvent.idDataEvent = any 
        (SELECT idDataEvent 
        FROM DataEvent INNER JOIN Utilisateur 
        on Utilisateur.idUtilisateur = DataEvent.idDataEvent 
        and DataEvent.idGestionnaire = 2);"
    */


    ?>
</body>
</html>