<?php
include ("../varSession.inc.php");

if ($_SESSION["estConnecte"]){
    header("Location: ../../index.php");
}

$validform = true;
if (isset($_SESSION["validation"])){
    $validform = $_SESSION["validation"];
}
?>
<html lang="fr">
    <head>
        <link rel="stylesheet" href="/css/inscription.css" />
        <meta charset="utf-8" />
        <script src="/js/inscription.js" defer></script>
        <title>Inscription</title>
    </head>
</html>
<body>
    <?php include "../header.php"; ?>
    <main>
        <p>Inscrivez-vous !</p>
        <form method="POST" class="form" id="inscription" action="verifinscription.php" onsubmit="return validateInscription()">
            <div class="champ">
                <label for="nom">
                    Nom :
                </label>
                <label>
                    <input type="text" name="nom_participant"
                        <?php
                        if ($validform) {
                            echo("class='form-nom'");
                        } else {
                            // affichage erreur
                            if (isset($_SESSION["POST"]["nom_participant"])) : ?>
                                value="<?php echo($_SESSION["POST"]["nom_participant"])?>";
                            <?php endif;
                            if (isset($_SESSION["invalide"]["nom"])){
                                echo("class='error'");
                            }
                        }
                        ?>
                    >
                    <?php
                    // message d'erreur
                    if (isset($_SESSION["invalide"]["nom"])){
                        echo("Nom invalide");
                    }
                    ?>
                </label>
            </div>
            <div class="champ">
                <label for="prenom">
                    Prénom :
                </label>
                <label>
                    <input type="text" name="prenom_participant"
                        <?php
                        if ($validform) {
                            echo("class='form-prenom'");
                        } else {
                            if (isset($_SESSION["POST"]["prenom_participant"])) : ?>
                                value="<?php echo($_SESSION["POST"]["prenom_participant"])?>";
                            <?php endif;
                            // affichage erreur
                            if (isset($_SESSION["invalide"]["prenom"])){
                                echo("class='error'");
                            }
                        }
                        ?>
                    >
                    <?php
                    // message d'erreur
                    if (isset($_SESSION["invalide"]["prenom"])){
                        echo("Prenom invalide");
                    }
                    ?>
                </label>
            </div>
            <div class="champ">
                <label for="email">
                    E-mail :
                </label>
                <label>
                    <input type="email" name="email_participant" id="email"
                        <?php
                        if ($validform) {
                            echo("class='form-email'");
                        } else {
                            if (isset($_SESSION["POST"]["email_participant"])) : ?>
                                value="<?php echo($_SESSION["POST"]["email_participant"])?>";
                            <?php endif;
                            // affichage erreur
                            if (isset($_SESSION["invalide"]["email"]) or isset($_SESSION["indisponible"]["email"])){
                                echo("class='error'");
                            }
                        }
                        ?>
                    >
                    <?php
                    if(isset($_SESSION["invalide"]["email"])){
                        echo("Adresse mail invalide");
                    }
                    if(isset($_SESSION["indisponible"]["email"])){
                        echo("Adresse mail indisponible");
                    }
                    ?>
                </label>
            </div>
            <div class="champ">
                <label for="mot-de-passe" id="mot_de_passe" >
                    Mot de passe :
                </label>
                <label>
                    <input type="password" name="mot_de_passe_participant"
                        <?php
                        if ($validform) {
                            echo("class='form-mdp'");
                        } else {
                            if (isset($_SESSION["POST"]["mot_de_passe_participant"])) : ?>
                                value="<?php echo($_SESSION["POST"]["mot_de_passe_participant"])?>";
                            <?php endif;
                            // affichage erreur
                            if (isset($_SESSION["invalide"]["mdp"]) or isset($_SESSION["different"]["mdp"])){
                                echo("class='error'");
                            }
                        }
                        ?>
                    >
                    <?php
                    if(isset($_SESSION["invalide"]["mdp"])){
                        // ATTENTION A MODIFIER
                        echo("Ne respect pas les regles de securité : 1 Maj, 1 min, 1 chiffre, 1 cara spe, taille sup à 6 ");
                    }
                    if(isset($_SESSION["different"]["mdp"])){
                        echo("Different de mot de passe confirmation");
                    }
                    ?>
                </label>
            </div>
            <div class="champ">
                <label for="mot-de-passe" id="mot_de_passe">
                    Mot de passe confirmation:
                </label>
                <label>
                    <input type="password" name="mot_de_passe_confirmation"
                        <?php
                        if ($validform) {
                            echo("class='form-mot_de_passe_confirmation'");
                        } else {
                            if (isset($_SESSION["POST"]["mot_de_passe_confirmation"])) : ?>
                                value="<?php echo($_SESSION["POST"]["mot_de_passe_confirmation"])?>";
                            <?php endif;
                            // affichage erreur
                            if (isset($_SESSION["invalide"]["mdp"]) or isset($_SESSION["different"]["mdp"])){
                                echo("class='error'");
                            }
                        }
                        ?>
                    >
                </label>
            </div>
            <div class="champ">
                <label for="niveau-etude">
                    Niveau d'étude :
                </label>
                <select id="niveau-etude" name="niveau_etude_participant"
                    <?php
                    if ($validform) {
                        echo("class='form-niveau_etude_participant'");
                    } else {
                        if (isset($_SESSION["invalide"]["nivEtude"])){
                            echo("class='error'");
                        }
                    }
                    ?>
                >
                    <option value="L1">L1</option>
                    <option value="L2">L2</option>
                    <option value="L3">L3</option>
                    <option value="M1">M1</option>
                    <option value="M2">M2</option>
                    <option value="D">D</option>
                </select>
            </div>
            <div class="champ">
                <label for="ecole" id="ecole">
                    École :
                </label>
                <label>
                    <input type="text" name="ecole_participant"
                        <?php
                        if ($validform) {
                            echo("class='form-ecole_participant'");
                        } else {
                            if (isset($_SESSION["POST"]["ecole_participant"])) {
                                echo("value=" . $_SESSION["POST"]["ecole_participant"]);
                            }
                            // affichage erreur
                            if (isset($_SESSION["invalide"]["ecole"])){
                                echo("class='error'");
                            }
                        }
                        ?>
                    >
                    <?php
                    // message d'erreur
                    if (isset($_SESSION["invalide"]["ecole"])){
                        echo("Ecole invalide");
                    }
                    ?>
                </label>
            </div>
            <div class="champ">
                <label for="ville" id="ville">
                    Ville :
                </label>
                <label>
                    <input type="text" name="ville_participant"
                        <?php
                        if ($validform) {
                            echo("class='form-ville_participant'");
                        } else {
                            if (isset($_SESSION["POST"]["ville_participant"])) : ?>
                                value="<?php echo($_SESSION["POST"]["ville_participant"])?>";
                            <?php endif;
                            // affichage erreur
                            if (isset($_SESSION["invalide"]["ville"])){
                                echo("class='error'");
                            }
                        }
                        ?>
                    >
                    <?php
                    // message d'erreur
                    if (isset($_SESSION["invalide"]["ville"])){
                        echo("Ville invalide");
                    }
                    ?>
                </label>
            </div>
            <button type="submit">S'inscrire</button>
        </form>
    </main>
    <?php include "../footer.php"; ?>
</body>
