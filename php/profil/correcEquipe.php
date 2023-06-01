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


$reqQuestion = 'SELECT Question.intitule, Reponse.reponse, Reponse.note 
                FROM Question JOIN Reponse ON Question.idQuestion = Reponse.idQuestion
                JOIN Questionnaire ON Questionnaire.idQuestionnaire = Question.idQuestionnaire
                JOIN ProjetData ON ProjetData.idDataEvent = Questionnaire.idDataEvent
                JOIN Equipe ON Equipe.idProjetData = ProjetData.idProjetData
                WHERE Questionnaire.idQuestionnaire = '.$idQuestionnaire.' AND Equipe.nomEquipe = "'.$nomEquipe.'";';

$mysqlClient = connexion($serveur, $bdd, $user, $pass);

$tabQuestion = getAllFromRequest($mysqlClient, $reqQuestion);

var_dump($tabQuestion);

include "../header.php";
?>

<link rel="stylesheet" href="/css/profil.css">
    <form id="form-correc-questionnaire-gestionnaire" action="correcEquipe.php" method="post" style="margin-left:4vh;">
        <h1>Correction Questionnaire</h1>
        <?php 
        foreach($tabQuestion as $Question)
            echo $Question["intitule"]."<br>";

            echo $Question["reponse"]."<br>";
            
            echo $Question["note"]."<br>";


        ?>
        <button type="submit" style="margin-top:2vh;" class="btnStyle">Valider Correction</button>


        <label>Choix de l'equipe a corriger</label><br>
        <input type='text' id="listUtil" list='Equipe-list' class='searchInp' name="nomEquipe" placeholder='Liste des Equipes'>
        <datalist id='Equipe-list' class='dataL'>
        <?php
        foreach($tab as $util) {
            $nomEquipe =  $util["nomEquipe"];
            
            echo '<option value="' . $nomEquipe . '">' . $nomEquipe . '</option>';
        }
        ?>
        </datalist>
        <button type="submit" style="margin-top:2vh;" class="btnStyle">Corriger Questionnaire</button>
    </form>
<?php
    include "../footer.php";
?>