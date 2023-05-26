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
        <link rel="stylesheet" href="/css/connex-inscri.css" />
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
            <button type="submit" class="form-submit">S'inscrire</button><br>
            <a href="connexion.php" id="inscri">J'ai déjà un compte
            <svg fill="grey" version="1.1" id="Capa_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" 
                width="1em" height="1em" viewBox="0 0 31.592 31.592"
                xml:space="preserve">
            <g>
                <g>
                    <path d="M19.812,20.062c-0.037,0.069-0.111,0.137-0.111,0.2v6.392c0,1.056-0.889,1.875-1.94,1.875H4.394
                        c-1.055,0-1.931-0.82-1.931-1.875V9.537c0-1.054,0.876-1.938,1.931-1.938h13.364c0.385,0,0.741,0.128,1.04,0.323l2.146-2.377
                        c-0.377-0.224-0.814-0.34-1.287-0.34H2.393C1.063,5.205,0,6.271,0,7.603v20.949c0,1.389,1.107,2.51,2.495,2.51h17.159
                        c1.39,0,2.508-1.121,2.508-2.51V17.484l-2.07,2.319C20.003,19.904,19.916,19.99,19.812,20.062z"/>
                    <path d="M5.646,10.881c-0.681,0-1.232,0.516-1.232,1.198c0,0.679,0.552,1.196,1.232,1.196h8.35l2.186-2.394H5.646z"/>
                    <path d="M12.619,15.055c0.012-0.042,0.026-0.069,0.042-0.138H5.646c-0.681,0-1.232,0.55-1.232,1.231
                        c0,0.676,0.552,1.229,1.232,1.229h6.308L12.619,15.055z"/>
                    <path d="M9.901,19.022H6.213H5.646c-0.681,0-1.23,0.551-1.23,1.229c0,0.678,0.55,1.23,1.23,1.23H7.82h0.681h1.401
                        c0.545,0,1.005-0.36,1.168-0.848c0.009-0.131,0.03-0.271,0.064-0.396c-0.003-0.617-0.458-1.121-1.053-1.205
                        C10.022,19.025,9.962,19.022,9.901,19.022z"/>
                    <path d="M23.08,5.309l-7.905,8.811l-0.535,0.597l4.278,3.836l0.535-0.596l7.902-8.81l0.639-0.709l-4.279-3.838L23.08,5.309z
                        M22.645,9.294l-5.098,5.681c-0.064,0.071-0.152,0.114-0.249,0.12c-0.097,0.005-0.188-0.028-0.261-0.092l-0.254-0.227
                        c-0.146-0.133-0.158-0.36-0.025-0.509l5.098-5.682c0.062-0.071,0.152-0.114,0.25-0.119c0.094-0.005,0.188,0.028,0.26,0.091
                        l0.25,0.228C22.766,8.918,22.775,9.146,22.645,9.294z M24.124,6.595l0.252,0.226c0.146,0.132,0.16,0.358,0.028,0.506
                        c0,0-0.002,0.001-0.002,0.002l-0.44,0.494c-0.019,0.02-0.038,0.037-0.06,0.052c-0.057,0.04-0.121,0.064-0.189,0.068
                        c-0.096,0.005-0.188-0.028-0.26-0.092l-0.254-0.226c-0.07-0.063-0.113-0.153-0.118-0.249c-0.007-0.095,0.026-0.189,0.092-0.26
                        l0.442-0.494C23.748,6.476,23.979,6.462,24.124,6.595z"/>
                    <polygon points="24.518,3.707 24.128,4.139 28.404,7.978 28.795,7.543 29.458,6.805 25.18,2.967 		"/>
                    <path d="M31.178,3.023l-2.426-2.175c-0.245-0.22-0.566-0.334-0.896-0.316s-0.641,0.166-0.858,0.411l-1.431,1.594l4.276,3.837
                        l1.431-1.594C31.732,4.27,31.691,3.482,31.178,3.023z M29.757,4.775l-2.592-2.325l0.749-0.834l2.591,2.325L29.757,4.775z"/>
                    <path d="M13.487,21.139l4.917-2.015l-4.274-3.835l-1.473,5.107c-0.065,0.229,0.005,0.476,0.182,0.633
                        C13.016,21.187,13.267,21.231,13.487,21.139z M14.519,16.652l2.485,2.229l-1.932,0.792l-1.131-1.014L14.519,16.652z"/>
                </g>
            </g>
            </svg>
            </a>
        </form>
    </main>
    <?php include "../footer.php"; ?>
</body>
