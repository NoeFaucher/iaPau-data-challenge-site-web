<?php
include("varSession.inc.php");
?>

<script>
    var head = document.head;
    var link = document.createElement("link");

    link.type = "text/css";
    link.rel = "stylesheet";
    link.href = "/css/header.css";

    head.appendChild(link);
</script>
<header>
    <div class="banniere">
        <a href="/index.php">
            <img src="/img/iapau_round.png" id="logo"/>
        </a>
        <div class="text"></a>
            <h1>IA PAU</h1>
            <p>L'intelligence artificielle vue des Pyrénées</p>
        </div>
        <div id="profilHeader">
            <?php if ($_SESSION["estConnecte"]) { echo($_SESSION["prenom"] . " " . $_SESSION["nom"]);} ?>
            <a href=<?php if ($_SESSION["estConnecte"]) {echo("/php/profil/profil.php");} else { echo("/php/connexion/connexion.php");}?>> <img id="Client" src="/img/Client.png" alt="Client"/> </a>
        </div>
    </div>

    <!-- Navbar -->

    <div class="menu-banniere">
        <a href="/index.php">Accueil</a>
        <a href="/php/dataEvent/liste-data-events.php?typeDataEvent=challenge">Data Challenge</a>
        <a href="/php/dataEvent/liste-data-events.php?typeDataEvent=battle">Data Battle</a>
    </div>
</header>

