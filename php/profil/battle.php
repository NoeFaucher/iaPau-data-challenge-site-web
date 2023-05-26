<?php
    session_start();
    include("../header.php");

// l'utilisateur est connecté
if ((isset($_SESSION["estConnecte"])) && ($_SESSION["estConnecte"] == true)) {

    // l'utilisateur est un gestionnaire
    if ((isset($_SESSION["typeUtilisateur"])) && ($_SESSION["typeUtilisateur"] == "gestionaire")) {

        //peut modifier le data Battle s'il est le sien
        if((isset($_SESSION["idGestionnaire"])) && ($_SESSION["idGestionnaire"] == "gestionaire")){

            //c'est un data battle
            if((isset($_SESSION["typeDataEvent"])) && ($_SESSION["typeDataEvent"] == "DataBattle")){

            // affichage de la liste des battles dont il est proprietaire
            echo "<ul>";

            foreach ($event as $DataEvent) {
                echo "<li>";
                echo "<h3>{$event['titre']}</h3>";
                echo "<p>Date de debut : {$event['dateDebut']}</p>";
                echo "<p>Date de fin : {$event['dateFIN']}</p>";
                echo "<p>Description : {$event['descript']}</p>";
                echo "<button><a title='DataBattle' href='../dataEvent/description-data-challenge.php'>Acces au dataBattle</a></button>";
                echo "<button><a title='ModifU' onclick='info(\"{$DataEvent['titre']}\", \"{$DataEvent['nomEntreprise']}\", \"{$DataEvent['dateDebut']}\", \"{$DataEvent['dateFIN']}\", \"{$DataEvent['descript']}\")'>Modifier le battle</a></button>";
                echo "</li>";
            }

            echo "</ul>";

            }
        }
    }

    // l'utilisateur est un admin
    if ((isset($_SESSION["typeUtilisateur"])) && ($_SESSION["typeUtilisateur"] == "administrateur")) {

        if((isset($_SESSION["typeDataEvent"])) && ($_SESSION["typeDataEvent"] == "DataBattle")){

        // affichage de la liste des battles dont il est proprietaire
        echo "<ul>";

        foreach ($event as $DataEvent) {
            echo "<li>";
            echo "<h3>{$event['titre']}</h3>";
            echo "<p>Date de debut : {$event['dateDebut']}</p>";
            echo "<p>Date de fin : {$event['dateFIN']}</p>";
            echo "<p>Description : {$event['descript']}</p>";
            echo "<button><a title='DataBattle' href='../php/description-data-challenge.php'>Acces au dataBattle</a></button>";
            echo "<button><a title='ModifU' onclick='info(\"{$DataEvent['titre']}\", \"{$DataEvent['nomEntreprise']}\", \"{$DataEvent['dateDebut']}\", \"{$DataEvent['dateFIN']}\", \"{$DataEvent['descript']}\")'>Modifier le battle</a></button>";
            echo "<button><a title='SupprB' onclick='supprimerBattle(\"{$DataEvent['titre']}\", \"{$DataEvent['nomEntreprise']}\", \"{$DataEvent['dateDebut']}\", \"{$DataEvent['dateFIN']}\", \"{$DataEvent['descript']}\")'>Supprimer le battle</a></button>";
            echo "</li>";
        }

        echo "</ul>";

        }
    }

    // l'utilisateur est un étudiant
    if ((isset($_SESSION["typeUtilisateur"])) && ($_SESSION["typeUtilisateur"] == "etudiant")) {

        // l'étudiant est inscrit
        if ((isset($_SESSION["inscrit"])) && ($_SESSION["inscrit"] == true)) {

            if((isset($_SESSION["typeDataEvent"])) && ($_SESSION["typeDataEvent"] == "DataBattle")){

            // affichage de la liste des battles dont il est proprietaire
            echo "<ul>";

            foreach ($event as $DataEvent) {
                echo "<li>";
                echo "<h3>{$event['titre']}</h3>";
                echo "<p>Date de debut : {$event['dateDebut']}</p>";
                echo "<p>Date de fin : {$event['dateFIN']}</p>";
                echo "<p>Description : {$event['descript']}</p>";
                echo "<button><a title='DataBattle' href='../php/description-data-challenge.php'>Acces au dataBattle</a></button>";
                echo "</li>";
            }
            
            echo "</ul>";

            }
        }
    }
}

?>

<script>

function supprimerBattle(titre, dateDebut, dateFIN, descript){

const event = {
    titre: titre,
    dateDebut: dateDebut,
    dateFIN: dateFIN,
    descript: descript,
}

fetch("../php/supprimerEvent.php", {
    body: JSON.stringify(event),
    method: "POST",
    headers: new Headers({
        "Content-Type": "application/json"
    })
});

}


function info(titre,nomEntreprise, dateDebut, dateFIN, descript){

    const event = {
        titre: titre,
        nomEntreprise: nomEntreprise,
        dateDebut: dateDebut,
        dateFIN: dateFIN,
        descript: descript,
    }

    fetch("../php/modifUtilisateur.php", {
        body: JSON.stringify(event),
        method: "POST",
        headers: new Headers({
            "Content-Type": "application/json"
        })
    });
}

</script>


<?php

include("../footer.php");

?>
