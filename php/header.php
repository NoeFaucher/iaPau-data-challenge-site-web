<?php
include ("varSession.inc.php");
?>
<link rel="stylesheet" type="text/css" href="/css/header.css" />
<script src="/js/header.js"></script>
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
            <?php if ($_SESSION["estconnecte"]) { echo($_SESSION["prenom"] . " " . $_SESSION["nom"]);} ?>
            <a href=<?php if ($_SESSION["estconnecte"]) {echo("/php/profil.php");} else { echo("/php/connexion/connexion.php");}?>> <img id="Client" src="/img/Client.png" alt="Client"/> </a>
        </div>
    </div>

    <!-- Navbar -->

    <div class="menu-banniere">
        <a href="/index.php">Accueil</a>
        <a href="/php/liste-data-events.php?typeDataEvent=challenge">Data Challenge</a>
        <a href="/php/liste-data-events.php?typeDataEvent=battle">Data Battle</a>
    </div>
</header>
