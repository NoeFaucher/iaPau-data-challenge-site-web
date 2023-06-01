


const ajouterDestinataire = () => {

    // recuperation de toutes les options dans la datalist
    let dataListOptions = document.getElementById("destinataires-list").children;
    
    // recuperation du destinataire selectionné
    let currentSelect = document.getElementById("input-current-destinataire");

    // recuperation de l'input hidden de tous les uitlisateurs déjà selectionnés
    let lesDestinataires = document.getElementById("input-destinataires");



    let arrayDestinataire = JSON.parse(lesDestinataires.value);
    
    if ( currentSelect.value !== "") {
        let i = 0;
        while(currentSelect.value !== dataListOptions[i].value) {
            i++;
        }
        if(currentSelect.value === dataListOptions[i].value &&  ! arrayDestinataire.includes(dataListOptions[i].dataset.id)) {
            arrayDestinataire.push(dataListOptions[i].dataset.id);

            let newEllSpan = document.createElement("span");

            newEllSpan.setAttribute("onclick", "supprimerDestinataire(this)");
            newEllSpan.dataset.id =dataListOptions[i].dataset.id;
            newEllSpan.innerHTML = dataListOptions[i].value;

            document.getElementById("destinataire-selectionne").appendChild(newEllSpan);
            document.getElementById("destinataire-selectionne").innerHTML += " ";
            
            currentSelect.value = "";
        }
    }

    lesDestinataires.value = JSON.stringify(arrayDestinataire);
}

const supprimerDestinataire = (element) => {
    let idToDelete = element.dataset.id;
    element.remove();

    let lesDestinataires = document.getElementById("input-destinataires");
    let arrayDestinataire = JSON.parse(lesDestinataires.value);


    const index = arrayDestinataire.indexOf(idToDelete);

    arrayDestinataire.splice(index, 1);
    
    lesDestinataires.value = JSON.stringify(arrayDestinataire);
}


const envoyerMessage = () => {
    let objet = document.getElementById("in-objet").value;
    let content = document.getElementById("input-message").value; 
    let destinataires = document.getElementById("input-destinataires").value;

    let params = "objet="+objet+"&contenu="+content+"&destinataires="+destinataires;


    fetch ("/php/messagerie/envoiMessage.php?"+params,{
        method : "GET"
    })
    .then(response => response.text())
    .then(result => {
        let pEnvoi = document.getElementById("retour-sur-envoi-mess");
        if (result === "success") {
            pEnvoi.innerHTML = "Le rendu a bien été envoyé.";
            pEnvoi.style.color = "green";
            recuperationMessage();
        }else {
            pEnvoi.innerHTML = "Une erreur s'est produite dans l'envoi du rendu.";
            pEnvoi.style.color = "red";
        }



    });


}

const recuperationMessage = () => {
    let messageConteneur = document.getElementById("message-conteneur");

    let selectVision = document.getElementById("select-selecteur-vision");

    let selectedOptionValue = selectVision.value;
    let selectedOptionData = selectVision.options[selectVision.selectedIndex].dataset.id;

    let getString = "";

    if (selectedOptionValue !== "utilisateur" && selectedOptionData != undefined) {
        getString += "?";
        getString += selectedOptionValue + "=" + selectedOptionData;
    }
    fetch ("/php/messagerie/recupMessage.php"+getString)
        .then(response => response.text())
        .then(result => {
            messageConteneur.innerHTML = result;
        });

}

const recuperationDestinataire = () => {
    let datalist = document.getElementById("destinataires-list");

     
    let selectVision = document.getElementById("select-selecteur-vision");

    let selectedOptionValue = selectVision.value;
    let selectedOptionData = selectVision.options[selectVision.selectedIndex].dataset.id;

    let getString = "";

    if (selectedOptionValue !== "utilisateur" && selectedOptionData != undefined) {
        getString += "?";
        getString += selectedOptionValue + "=" + selectedOptionData;
    }
    

    fetch ("/php/messagerie/recupDestinataire.php"+getString)
        .then(response => response.text())
        .then(result => {
            console.log(result);
            datalist.innerHTML = result;
        });

}

const recuperationVision = () => {
    let selectVision = document.getElementById("select-selecteur-vision");

    fetch ("/php/messagerie/recupVision.php")
        .then(response => response.text())
        .then(result => {
            selectVision.innerHTML = result;
        });

}


window.onload = () => {
    // ajoute le css nécessaire à la messagerie
    var head = document.head;
    var link = document.createElement("link");

    link.type = "text/css";
    link.rel = "stylesheet";
    link.href = "/css/messagerie.css";

    head.appendChild(link);

    // recupération des visions
    recuperationVision();
    // recupération des messages
    recuperationMessage();
    // recupération des destinataires
    recuperationDestinataire();


    let lesDestinataires = document.getElementById("input-destinataires");

    lesDestinataires.value = "[]";




    let currentSelect = document.getElementById("input-current-destinataire");
    currentSelect.addEventListener("keydown",(e) => {
        if (e.isComposing || e.key === "Enter") {
            e.preventDefault();
            ajouterDestinataire();

        }
    });

}