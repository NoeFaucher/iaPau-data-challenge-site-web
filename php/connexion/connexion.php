<?php
include ("../varSession.inc.php");

$validform = true;

if ($_SESSION["estConnecte"]){
    header("Location: ../../index.php");
}


if (!$_SESSION["estConnecte"]){
    if (isset($_SESSION["validation"])){
        if(!$_SESSION["validation"]){
            $validform = false;
        }
    }
}
?>
<html lang="fr">
    <head>
        <link rel="stylesheet" href="/css/connexion.css" />
        <meta charset="utf-8" />
        <script src="/js/connexion.js" defer></script>
        <title>Connexion</title>
    </head>
</html>
<body>
    <?php include "../header.php"; ?>
    <main>

        <p>Connectez-vous !</p>
        <form method="POST" class="form" id="connexion" action="verifconnexion.php" onsubmit="return validateConnexion()">
            <div class="champ">
                <label for="email" id="email">
                    Email :
                </label>
                <label>
                    <input type="email" name="email_participant"
                        <?php
                        if($validform) {
                            echo("class='form-email'");
                            echo("value=" . $_SESSION["email"]);
                        } else {
                            echo("class='error'");
                            echo("value=" . $_SESSION["POST"]["email_participant"]);
                        }
                        ?>
                    >
                </label>
            </div>
            <div class="champ">
                <label for="mot-de-passe" id="mot-de-passe">
                    Mot de passe :
                </label>
                <label>
                    <input type="password" name="mot_de_passe_participant"
                        <?php
                        if($validform) {
                            echo("class='form-mdp'");
                        } else {
                            echo("class='error'");
                            echo("value=" . $_SESSION["POST"]["mot_de_passe_participant"]);
                        }
                        ?>
                    >
                </label>
            </div>
            <button type="submit" class="form-submit" value="Connexion">Connexion</button>
        </form>
        <button class="button-inscription"><a href="/php/connexion/inscription.php">S'inscrire</a></button>
    </main>
    <?php include "../footer.php"; ?>
</body>
