<?php
    session_start();
    include("./php/header.php");
    include("./css/menu-vert.css");

    // l'utilisateur doit être connecté pour afficher cette section
    if ((isset($_SESSION["estConnecte"])) && ($_SESSION["estConnecte"] == true)) {

        echo "<div class='menu-vert'>";
        echo "<h2>{$_SESSION['prenom']} {$_SESSION['nom']}</h2>";
        echo "<ul>";

        echo "<li><a title='Utilisateurs' href='utilisateurs.php'>Utilisateurs</a></li>";
        echo "<li><a title='Equipe(s)' href='partie-quipe.php'>Equipe(s)</a></li>";
        echo "<li><a title='Challenge' href='challenge.php'>Challenge</a></li>";
        echo "<li><a title='Battle' href='battle.php'>Battle</a></li>";
        echo "<li><a title='Ressource' href='ressource.php'>Ressource</a></li>";
        echo "<li><a title='Messagerie' href='messagerie.php'>Messagerie</a></li>";
    
        echo "</ul>";
        echo "</div>";
    
    }

    //affichage/modifier/supprimer de la liste des challenges dont il est proprietaire
    echo "<ul>";
    foreach ($Utilisateur as $utilisateur) {
        echo "<li>";
        echo "<p>Nom : {$membre['nom']}</p>";
        echo "<p>Prenom : {$membre['prenom']}</p>";
        echo "<p>Rôle : {$membre['typeUtilisateur']}</p>";
        echo "<button><a title='ModifU' onclick='info($membre['nom'], $membre['prenom'], $membre['typeUtilisateur'])'>Modifier l'utilisateur</a></button>";
        echo "<button><a title='SupprU' onclick='supprimerUtilisateur()'>Supprimer l'utilisateur</a></button>";
        echo "</li>";
    }
    echo "</ul>";


    //affichage du form d'inscription
    echo "<h2>Inscrire un nouvel utilisateur</h2>";

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

        <button type='submit'>S'inscrire</button>
    </form>";


    include("./php/footer.php");

?>