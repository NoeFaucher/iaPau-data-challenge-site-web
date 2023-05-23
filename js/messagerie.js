


const ajouterDestinataire = () => {
    let dataListOptions = document.getElementById("destinataires-list").children;
    let currentSelect = document.getElementById("input-current-destinataire");
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





window.onload = () => {
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