<?php 
    // variables temporaires pour l'instant
    $nomDataChallenge = "Ici faudra mettre le nom du data challenge";
    $nomEntreprise = "Germain Peugeot";
    $dateDebut = "22 mai 2021";
    $dateFin = "22 mai 2023";
    $presentation = "Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum. Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum. Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.";

    echo "
    <div id='presentation-data-challenge'>
        <div id='nom-data-challenge'>
            <span>".$nomDataChallenge."</span>
        </div>
        <div id='infos-data-challenge'>
            <span>Organisé par ".$nomEntreprise." - Du ".$dateDebut." au ".$dateFin."</span>
        </div>
        <p id='paragraphe-presentation-data-challenge'>".$presentation."</p>
    ";
    if ((isset($_SESSION["loggedIn"])) && ($_SESSION["loggedIn"] == true)) {
        echo "
        <form id='inscription'>
            <div id='bouton-inscription'>
                <button type='submit'>Inscrire mon équipe</button>
            </div>
        </form>";
    }
    else {
        echo "<span>Veuillez vous connecter pour vous inscrire à ce data challenge.";
    }
    echo "</div>";

?>