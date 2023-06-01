// recupère l'ensemble des résultats d'un équipe
const recupData = equipe => {
    
    fetch ("recupRendus.php?equipe="+equipe,{
        method: "GET"
    })
    .then(response => response.text())
    .then(result => {
        afficherDonnee(JSON.parse(result));
    });
    
}

// affiche l'ensemble des résultats
const afficherDonnee = data => {

    if (data.lenght == 0) {
        document.getElementById("dernier-rendu").style.display = "none";
        return;
    }

    let resultat = JSON.parse(data[0]["resultatJson"]);

    document.getElementById("date-rendu").innerHTML = data[0]["dateRendu"];
    document.getElementById("nb-ligne").innerHTML = resultat["nbLigne"];
    document.getElementById("nb-fonction").innerHTML = resultat["nbFonction"];
    document.getElementById("nb-max").innerHTML = resultat["nbLigneMaxFonction"];
    document.getElementById("nb-min").innerHTML = resultat["nbLigneMinFonction"];
    document.getElementById("nb-moyen").innerHTML = resultat["nbLigneMoyenFonction"];

    // Recuperation de toute les données
    let labels = [];
    let dataNbLigne = [];
    let dataNbFonction = [];
    let dataNbMin = [];
    let dataNbMax = [];
    let dataNbMoyen = [];
    data.forEach(element => {
        labels.push(element["dateRendu"]);
        resultat = JSON.parse(element["resultatJson"]);
        dataNbLigne.push(resultat["nbLigne"]);
        dataNbFonction.push(resultat["nbFonction"]);
        dataNbMin.push(resultat["nbLigneMinFonction"]);
        dataNbMax.push(resultat["nbLigneMaxFonction"]);
        dataNbMoyen.push(resultat["nbLigneMoyenFonction"]);
    });

    // Premier graphique (nombre de ligne)
    var chartData1 = {
        labels: labels,
        datasets: [{
        label: 'Nombre de ligne',
        backgroundColor: '#9966ff',
        borderColor: '#9966ff80',
        data: dataNbLigne
        }]
    };
    const config1 = {
    type: 'line',
    data: chartData1,
    options: {
        responsive: true,
        plugins: {
        legend: {
            position: 'top',
        },
        title: {
            display: true,
            text: 'Nombre de ligne'
        }
        }
    },
    };
    var ctx1 = document.getElementById('myChart1').getContext('2d');
    var myChart1 = new Chart(ctx1, config1);
    
    // Deuxième graphique (nombre de fonction)
    var chartData2 = {
        labels: labels,
        datasets: [{
        label: 'Nombre de fonction',
        backgroundColor: '#ff9f40',
        borderColor: '#ff9f4080',
        data: dataNbFonction
        }]
    };
    const config2 = {
    type: 'line',
    data: chartData2,
    options: {
        responsive: true,
        plugins: {
        legend: {
            position: 'top',
        },
        title: {
            display: true,
            text: 'Nombre de fonction'
        }
        }
    },
    };
    var ctx2 = document.getElementById('myChart2').getContext('2d');
    var myChart2 = new Chart(ctx2, config2);

    // Troisième graphique (nombre de ligne fonction (min,max,moyen))
    var chartData3 = {
        labels: labels,
        datasets: [{
        label: 'Nombre de ligne max',
        backgroundColor: '#ff6384',
        borderColor: '#ff638480',
        data: dataNbMax
        },{
        label: 'Nombre de ligne min',
        backgroundColor: '#36a2eb',
        borderColor: '#36a2eb80',
        data: dataNbMin
        },{
        label: 'Nombre de ligne moyen',
        backgroundColor: '#4bc0c0',
        borderColor: '#4bc0c080',
        data: dataNbMoyen
        }]
    };
    const config3 = {
    type: 'line',
    data: chartData3,
    options: {
        responsive: true,
        plugins: {
        legend: {
            position: 'top',
        },
        title: {
            display: true,
            text: 'Nombre de ligne dans les fonctions'
        }
        }
    },
    };
    var ctx3 = document.getElementById('myChart3').getContext('2d');
    var myChart3 = new Chart(ctx3, config3);

}

const envoyerCode = (element,equipe) => {
    let link = document.getElementById("lien_code_gitlab").value;

    let codedLink = window.btoa(encodeURIComponent(link));
    
    fetch ("creerRendu.php?equipe="+equipe+"&lien="+codedLink,{
        method: "GET"
    })
    .then(response => response.text())
    .then(result => {
        let pEnvoi = document.getElementById("retour-sur-envoi");

        if (result === "success") {
            pEnvoi.innerHTML = "Le rendu a bien été envoyé.";
            pEnvoi.style.color = "green";

            // réinitialisation de l'input
            let inputEnvoiResultats = document.querySelector("#texte-input-lien-gitlab input");
            inputEnvoiResultats.value = "";

            // création du bouton "consulter mes résultats", s'il n'existe pas déjà
            let divBoutons = document.querySelector(".boutons-rendu");
            let lienResultats = divBoutons.querySelector("a");
            if (lienResultats == null) {
                let lienRendu = document.createElement("a");
                lienRendu.setAttribute("href", "rendu.php?equipe=" + equipe);
                lienRendu.innerHTML = "Consulter mes résultats";
                divBoutons.appendChild(lienRendu);
            }

            // titre "Rendus de mon équipe"
            var titre = document.querySelector('#titre-rendus-equipe span');
            titre.textContent = "Rendus de mon équipe";

            // ajout du lien dans la liste des rendus de l'équipe
            var liste = document.getElementById('liste-rendus-equipe');
            var nouvelElement = document.createElement('li');
            nouvelElement.className = 'paragraphe-presentation';
            var lien = document.createElement('a');
            lien.href = link;
            lien.textContent = link;
            var dateDuJour = new Date();
            var annee = dateDuJour.getFullYear();
            var mois = ("0" + (dateDuJour.getMonth() + 1)).slice(-2);
            var jour = ("0" + dateDuJour.getDate()).slice(-2);
            var heures = ("0" + dateDuJour.getHours()).slice(-2);
            var minutes = ("0" + dateDuJour.getMinutes()).slice(-2);
            var secondes = ("0" + dateDuJour.getSeconds()).slice(-2);
            var dateFormatee = annee + "-" + mois + "-" + jour + " " + heures + ":" + minutes + ":" + secondes;
            var texteDate = document.createTextNode(dateFormatee + " : ");
            nouvelElement.appendChild(texteDate);
            nouvelElement.appendChild(lien);
            liste.appendChild(nouvelElement);

        }else {
            pEnvoi.innerHTML = "Une erreur s'est produite dans l'envoi du rendu.";
            pEnvoi.style.color = "red";
        }
    });

}
