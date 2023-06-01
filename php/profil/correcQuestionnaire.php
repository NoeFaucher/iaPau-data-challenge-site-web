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
$idQuestionnaire = $_GET["idQuestionnaire"];

$req='  SELECT * FROM Equipe 
        JOIN ProjetData ON ProjetData.idProjetData = Equipe.idProjetData 
        JOIN Questionnaire on ProjetData.idDataEvent = Questionnaire.idDataEvent 
        WHERE Questionnaire.idQuestionnaire = '.$idQuestionnaire.';';

$mysqlClient = connexion($serveur, $bdd, $user, $pass);

$tab = getAllFromRequest($mysqlClient, $req);

include "../header.php";
?>

<link rel="stylesheet" href="/css/profil.css">
    <form id="form-correc-questionnaire-gestionnaire" action="correcEquipe.php" method="post" style="margin-left:4vh;">
        <h1>Correction Questionnaire</h1>
        <label>Choix de l'équipe à corriger :</label><br>
        <input type='text' id="listUtil" list='Equipe-list' class='searchInp' name="nomEquipe" placeholder='Liste des Equipes'>
        <datalist id='Equipe-list' class='dataL'>
        <?php
        foreach($tab as $util) {
            $nomEquipe =  $util["nomEquipe"];
            
            echo '<option value="' . $nomEquipe . '">' . $nomEquipe . '</option>';
        }
        ?>
        </datalist>
        <input type="hidden" name="idQuestionnaire" value="<?php echo $_GET["idQuestionnaire"]?>">
        <button type="submit" style="margin-top:2vh;" class="btnStyle">Corriger Questionnaire</button>
    </form>
<?php
    include "../footer.php";
?>