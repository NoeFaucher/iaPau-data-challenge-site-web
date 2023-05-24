<?php
include ("../varSession.inc.php");
$_SESSION["estconnecte"] = false;

if (isset($_SESSION["validation"])){
    $validform = $_SESSION["estconnecte"];
}else {
    $validform = true;
}
var_dump($validform);
?>
<html lang="fr">
    <head>
        <link rel="stylesheet" href="../../css/connexion.css" />
        <meta charset="utf-8" />
        <script src="../../js/connexion.js" defer></script>
        <title>Connexion</title>
    </head>
</html>
<body>
    <?php include "header.php"; ?>
    <main>
        <p>Connectez-vous !</p>
        <form method="POST" class="form" id="connexion" action="verifconnexion.php" onsubmit="return validateConnexion()">
            <div class="champ">
                <label for="email" id="email">
                    Email :
                </label>
                <input type="text" name="email_participant"
                    <?php
                    if($validform) {
                        echo("class='form-email'");
                    } else {
                        echo("class='error'");
                    }
                    ?>
                >
            </div>
            <div class="champ">
                <label for="mot-de-passe" id="mot-de-passe" class="form-mdp">
                    Mot de passe :
                </label>
                <input type="password" name="mot_de_passe_participant"
                    <?php
                    if($validform) {
                        echo("class='form-email'");
                    } else {
                        echo("class='error'");
                    }
                    ?>
                >
            </div>
            <button type="submit" class="form-submit" value="Connexion">Connexion</button>
        </form>
    </main>
    <?php include "footer.php"; ?>
</body>
