<?php
    session_start();
    include("./php/header.php");
    include("./css/menu-vert.css");

    //on doit prendre les donnees de l'utilsateur pour venir les modifier 

    // l'utilisateur doit être connecté pour afficher cette section
    if ((isset($_SESSION["estConnecte"])) && ($_SESSION["estConnecte"] == true)) {

        echo "<div class='menu-vert'>";
        echo "<h2>{$_SESSION['prenom']} {$_SESSION['nom']}</h2>";
        echo "<ul>";
    
        // l'utilisateur est un admin
        if ((isset($_SESSION["typeUtilisateur"])) && ($_SESSION["typeUtilisateur"] == "administrateur")) {
            echo "<li><a title='Utilisateurs' href='utilisateurs.php'>Utilisateurs</a></li>";
            echo "<li><a title='Equipe(s)' href='partie-quipe.php'>Equipe(s)</a></li>";
            echo "<li><a title='Challenge' href='challenge.php'>Challenge</a></li>";
            echo "<li><a title='Battle' href='battle.php'>Battle</a></li>";
            echo "<li><a title='Ressource' href='ressource.php'>Ressource</a></li>";
            echo "<li><a title='Messagerie' href='messagerie.php'>Messagerie</a></li>";
        }
    
        echo "</ul>";
        echo "</div>";
    
    }

    //affichage du form de modif
    echo "<h2>Modifier les informations d'un challenge</h2>";

    echo "<form method='POST'>
    <div class='champ'>   
        <label for='titre'>Titre :</label>
        <input type='text' name='titreChallenge' id='nomC' required>
    </div>

    <div class='champ'>   
        <label for='nomEntreprise'>Entreprise :</label>
        <input type='text' name='nomEntreprise' id='nomE' required>
    </div>

    <div class='champ'>   
        <label for='dateDebut'>Date de debut :</label>
        <input type='text' name='dateDebut' id='DateDebut' required>
    </div>

    <div class='champ'>   
        <label for='dateFIN'>Date de fin :</label>
        <input type='text' name='dateFIN' id='DateFIN' required>
    </div>

    <div class='champ'>   
        <label for='descript' id='descript'>Presentation :</label><input type='text' name='descript'>
    </div>

    <button type='submit'>Modifier</button>
</form>";


$titre = $_POST['titre'];
$nomEntreprise = $_POST['nomEntreprise'];
$dateDebut = $_POST['dateDebut'];
$dateFIN = $_POST['dateFIN'];
$descript = $_POST['descript'];

    echo "<script>alert('Les informations ont été mises à jour avec succès.');</script>";
    
    header('Location: utilisateurs.php');

    include("./php/footer.php");

?>