<?php
    session_start();
    include("../bdd.php");
    include("../verification.php");


    if(!isset($_SESSION["idUtilisateur"])){
        header("Location: /php/connexion/connexion.php");
    }
    
    if(!isset($_GET["equipe"]) ){
        header("Location: /");
    }

    if(estInjectionSQL($_GET["equipe"])) {
        header("Location: /");
    }


    
    $id_equipe = $_GET["equipe"];
    $idUtilisateur = $_SESSION["idUtilisateur"];
    $typeUtilisateur = $_SESSION["typeUtilisateur"];

?>

<!DOCTYPE html>
<html>
<head>
    <title>Dashboard</title>
    <link rel="stylesheet" href="/css/rendu.css">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="/js/rendu.js"></script>
</head>
<body>
    <div id="dashboard">
        <?php
            if ($typeUtilisateur == "normal") {
                echo "<h1>Vos rendus :</h1>";
            }else {
                $cnx = connexion($serveur,$bdd,$user,$pass);

                $req = "select * from Equipe where idEquipe = $id_equipe";
                $equipe = getAllFromRequest($cnx,$req);
                
                if (empty($equipe)) {
                    echo "equipe inexistante";
                    exit;
                }else {
                    $equipe = $equipe[0]["nomEquipe"];
                    echo "<h1>Les rendus de l'équipe : $equipe</h1>";
                }
            }
        ?>

        <!-- Donnée du dernier rendu -->

        <div id="dernier-rendu">
            <h2>Dernier rendu le <span id="date-rendu"> </span>: </h2>
                <p>Nombre de ligne : <span id="nb-ligne"></span></p>
                <p>Nombre de fonction : <span id="nb-fonction"></span></p>
                <p>Nombre de ligne max de fonction : <span id="nb-max"></span></p>
                <p>Nombre de ligne min de fonction : <span id="nb-min"></span></p>
                <p>Nombre de ligne moyen de fonction : <span id="nb-moyen"></span></p>

        </div>
        <?php 
            // affichage du calcule d'occurence pour le gestionnaire et l'admin
            if ($typeUtilisateur != "normal") {
        ?>
        <div id="occurence">
            <h2>Calcul d'occurence sur le dernier rendu :</h2>
            <label for="occurence-input">Mots à compter :</label>
            <input type="text" name="occurence-input" id="occurence-input" placeholder="Entrez le texte à compter...">
            <input type="button" onclick="calculerOccurence(<?php echo $_GET['equipe']; ?>)" value="Calculer" >

            <p><i>ex:</i> def,if,= pour calculer les occurrences des mots def, if et =.</p>

            <p id="retour-sur-calcul"></p>
            
            <div class="graph" id="graph-occ">
            </div>

        </div>
        <?php 
            }
        ?>

        <div class="graph-container">
            <h2>Evolution des rendus :</h2>
            <div class="graph" id="graph1">
            <canvas id="myChart1"></canvas>
            </div>
            <div class="graph" id="graph2">
            <canvas id="myChart2"></canvas>
            </div>
            <div class="graph" id="graph3">
            <canvas id="myChart3"></canvas>
            </div>
        </div>

        <!-- Retrospective des données  -->

    </div>
    <script>
    <?php
        if (isset($_GET["equipe"]))
            echo "recupData(".$_GET["equipe"].");";
    ?>
    </script>

</body>
</html>
