<?php
    session_start();
    $id_equipe = $_GET["equipe"];
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
        <h1>Vos rendus :</h1>

        <!-- Donnée du dernier rendu -->

        <div id="dernier-rendu">
            <h2>Dernier rendu le <span id="date-rendu"> </span>: </h2>
                <p>Nombre de ligne : <span id="nb-ligne"></span></p>
                <p>Nombre de fonction : <span id="nb-fonction"></span></p>
                <p>Nombre de ligne max de fonction : <span id="nb-max"></span></p>
                <p>Nombre de ligne min de fonction : <span id="nb-min"></span></p>
                <p>Nombre de ligne moyen de fonction : <span id="nb-moyen"></span></p>

        </div>

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
