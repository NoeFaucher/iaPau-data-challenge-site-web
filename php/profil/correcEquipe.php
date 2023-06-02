<?php
include "../varSession.inc.php";
include "../verification.php";
include "../bdd.php";

if ($_SESSION["estConnecte"]) {
    if ($_SESSION["typeUtilisateur"] != 'gestionnaire'){
        header("Location: profil.php");
        exit();
    }
} else {
    header("Location: ../connexion/connexion.php");
    exit();
}

$idQuestionnaire = $_POST["idQuestionnaire"];
$nomEquipe = $_POST["nomEquipe"];

if ($nomEquipe == ""){
    header("Location: correcQuestionnaire.php?idQuestionnaire=".$idQuestionnaire);
    exit();
}


$reqQuestion = 'SELECT Question.intitule, Reponse.reponse, Reponse.note, Reponse.idReponse
                FROM Question JOIN Reponse ON Question.idQuestion = Reponse.idQuestion
                JOIN Questionnaire ON Questionnaire.idQuestionnaire = Question.idQuestionnaire
                JOIN ProjetData ON ProjetData.idDataEvent = Questionnaire.idDataEvent
                JOIN Equipe ON Equipe.idProjetData = ProjetData.idProjetData
                WHERE Questionnaire.idQuestionnaire = '.$idQuestionnaire.' AND Equipe.nomEquipe = "'.$nomEquipe.'";';

$mysqlClient = connexion($serveur, $bdd, $user, $pass);

$tabQuestion = getAllFromRequest($mysqlClient, $reqQuestion);


include "../header.php";
?>

<link rel="stylesheet" href="/css/profil.css">
    <form id="form-correc-questionnaire-gestionnaire" action="correction.php" method="post" style="margin-left:4vh;">
        <h1>Correction Questionnaire</h1>
        
        <?php 
        foreach($tabQuestion as $Question) : ?>
            <hr>
            <p>Question : 
            <?php echo $Question["intitule"]; ?>
            </p>
            <p>Réponse de l'équipe à la question : 
            <?php echo $Question["reponse"]; ?>
            </p>

            <label for="vrai">Vrai</label>
            <input type="radio" id="vrai" name="reponse-<?php echo $Question["idReponse"]?>" value="1" checked style="width:4vh;margin-top:-30px;margin-left:10vh;">
            <br>
            <label for="faux">Faux</label>
            <input type="radio" id="faux" name="reponse-<?php echo $Question["idReponse"]?>" value="0" style="width:4vh;margin-top:-30px;margin-left:10vh;"><br>
            <br>
        
        <?php endforeach; ?>
        <hr>

        <input type="hidden" name="idQuestionnaire" value="<?php echo $idQuestionnaire ?>">
        <input type="hidden" name="nomEquipe" value="<?php echo $nomEquipe ?>">
        <button type="submit" style="margin-top:2vh;" class="btnStyle">Valider Correction</button>
    </form>
<?php
    include "../footer.php";
?>