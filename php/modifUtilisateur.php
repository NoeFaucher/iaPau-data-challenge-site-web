<?php
    session_start();
    include("./php/header.php");
    include("./css/menu-vert.css");

    //on doit prendre les donnees de l'utilsateur pour venir les modifier 

    // l'utilisateur doit être connecté pour afficher cette section
    if ((isset($_SESSION["loggedIn"])) && ($_SESSION["loggedIn"] == true)) {

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
    echo "<h2>Modifier les informations d'un utilisateur</h2>";

    echo "<form method='POST'>
        <div class='champ'>   
            <label for='nom'>Nom :</label>
            <input type='text' name='nom_participant' id='nom' required>
        </div>

        <div class='champ'>   
            <label for='prenom'>Prénom :</label>
            <input type='text' name='prenom_participant' id='prenom' required>
        </div>

        <div class='champ'>   
            <label for='email'>E-mail :</label>
            <input type='text' name='mail_participant' id='email' required>
        </div>

        <div class='champ'>   
            <label for='niveau-etude'>Niveau d'étude :</label>
            <select id='niveau-etude' name='niveau_etude_participant'>
                <option value='L1'>L1</option>
                <option value='L2'>L2</option>
                <option value='L3'>L3</option>
                <option value='M1'>M1</option>
                <option value='M2'>M2</option>
                <option value='D'>D</option>
            </select>
        </div>

        <div class='champ'>   
            <label for='ecole' id='ecole'>École :</label><input type='text' name='ecole_participant'>
        </div>

        <div class='champ'>   
            <label for='ville' id='ville'>Ville :</label><input type='text' name='ville_participant'>
        </div>

        <button type='submit'>Modifier</button>
    </form>";

    $nom = $_POST['nom'];
    $prenom = $_POST['prenom'];
    $email = $_POST['email'];
    $niveau = $_POST['niveau-etude'];
    $ecole = $_POST['ecole'];
    $ville = $_POST['ville'];

    echo "<script>alert('Les informations ont été mises à jour avec succès.');</script>";
    
    header('Location: utilisateurs.php');

    include("./php/footer.php");

?>