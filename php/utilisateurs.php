<?php
    session_start();
    include("header.php");
    include("bdd.php");

    $request = "SELECT prenom, nom, email, nivEtude, ecole, ville FROM Utilisateur INNER JOIN Utilisateur WHERE typeUtilisateur= 'normal'";
    $cnx = connexion($serveur, $bdd, $user, $pass);
    $Utilisateur = getAllFromRequest($cnx,$request);


    // l'utilisateur est connecté
if ((isset($_SESSION["estConnecte"])) && ($_SESSION["estConnecte"] == true)){

        echo "<div class='menu-vert'>";
        echo "<h2>{$_SESSION['prenom']} {$_SESSION['nom']}</h2>";
        echo "<ul>";

        echo "<li><a title='Utilisateurs' href='../php/utilisateurs.php'>Utilisateurs</a></li>";
        echo "<li><a title='Equipe(s)' href='../php/partie-quipe.php'>Equipe(s)</a></li>";
        echo "<li><a title='Challenge' href='../php/challenge.php'>Challenge</a></li>";
        echo "<li><a title='Battle' href='../php/battle.php'>Battle</a></li>";
        echo "<li><a title='Ressource' href='../php/ressource.php'>Ressource</a></li>";
        echo "<li><a title='Messagerie' href='../php/messagerie.php'>Messagerie</a></li>";
    
        echo "</ul>";
        echo "</div>";
    
    
    //affichage/modifier/supprimer de la liste des utilisateurs
    echo "<ul>";
    foreach ($Utilisateur as $utilisateur) {
        echo "<li>";
        echo "<p>Nom : {$utilisateur['nom']}</p>";
        echo "<p>Prenom : {$utilisateur['prenom']}</p>";
        echo "<p>Rôle : {$utilisateur['typeUtilisateur']}</p>";
        echo "<button><a title='ModifU' onclick='info(\"{$Utilisateur['nom']}\", \"{$Utilisateur['prenom']}\", \"{$Utilisateur['email']}\", \"{$Utilisateur['nivEtude']}\", \"{$Utilisateur['ecole']}\", \"{$Utilisateur['ville']}\")'>Modifier l'Utilisateur</a></button>";
        echo "<button><a title='SupprU' onclick='supprimerUtilisateur(\"{$Utilisateur['nom']}\", \"{$Utilisateur['prenom']}\", \"{$Utilisateur['email']}\", \"{$Utilisateur['nivEtude']}\", \"{$Utilisateur['ecole']}\", \"{$Utilisateur['ville']}\")'>Supprimer l'utilisateur</a></button>";
        echo "</li>";
    }
    echo "</ul>";
    ?>

    //affichage du form d'inscription
    <h2>Inscrire un nouvel utilisateur</h2>

    <form method='POST'>
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
            <select id='niveauEtude' name='niveau_etude_participant'>
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
    </form>

<?php } ?>

<script>

function supprimerUtilisateur(nom, prenom, email, nivEtude, ecole, ville){

const utilisateur = {
    nom: nom,
    prenom: prenom,
    email: email,
    niveau: niveauEtude,
    ecole: ecole,
    ville: ville,
}

fetch("../php/supprimer.php", {
    body: JSON.stringify(utilisateur),
    method: "POST",
    headers: new Headers({
        "Content-Type": "application/json"
    })
});
}


function info(nom, prenom, email, nivEtude, ecole, ville){

    const utilisateur = {
        nom: nom,
        prenom: prenom,
        email: email,
        niveau: niveauEtude,
        ecole: ecole,
        ville: ville,
    }

    fetch("../php/modifUtilisateur.php", {
        body: JSON.stringify(utilisateur),
        method: "POST",
        headers: new Headers({
            "Content-Type": "application/json"
        })
    });
}

</script>


<?php

    include("../php/footer.php");

?>