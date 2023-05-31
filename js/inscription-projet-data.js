// ajouter un étudiant
function ajouterEtudiant() {

    // récupération de tous les étudiants "ajoutables" (même s'ils ont déjà été ajoutés)
    var etudiantsAjoutablesNoms = document.querySelectorAll("#datalist-etudiants option");
    var valeursEtudiantsAjoutables = [];
    for (var i = 0; i < etudiantsAjoutablesNoms.length; i++) {
        var valeurEtudiant = etudiantsAjoutablesNoms[i].value;
        valeursEtudiantsAjoutables.push(valeurEtudiant);
    }

    // récupération des étudiants déjà ajoutés
    var divEtudiantAjoute = document.querySelectorAll("#etudiants-ajoutes .etudiant-ajoute span");
    var nombreDivEtudiantAjoute = divEtudiantAjoute.length;
    var valeursSpanEtudiantAjoute = [];
    for (var j = 0; j < nombreDivEtudiantAjoute; j++) {
        var valeurSpan = divEtudiantAjoute[j].textContent;
        valeursSpanEtudiantAjoute.push(valeurSpan);
    }

    // récupération du texte de l'input de l'utilisateur sélectionné
    var inputTexte = document.getElementById("nouveau-membre-equipe");
    var valeurInput = inputTexte.value;

    // récupération de l'option correspondante
    var optionCorrespondante = null;
    var options = document.querySelectorAll("#datalist-etudiants option");
    for (var i = 0; i < options.length; i++) {
        var option = options[i];
        if (option.value === valeurInput) {
            optionCorrespondante = option;
            break;
        }
    }

    // récupération du data-info de l'option correspondante
    if (optionCorrespondante) {
        var idEtudiant = optionCorrespondante.getAttribute("data-info");
    }

    // cas 1 : aucun étudiant n'a été inscrit 
    if (!valeursEtudiantsAjoutables.includes(valeurInput)) {
        alert("Veuillez entrer un étudiant.");
        return(null);
    }

    // cas 2 : l'étudiant n'existe pas 
    if (!valeursEtudiantsAjoutables.includes(valeurInput)) {
        alert("Cet étudiant n'existe pas !");
        return(null);
    }

    // cas 3 : l'étudiant a déjà été ajouté
    if (valeursSpanEtudiantAjoute.includes(valeurInput)) {
        alert("Cet étudiant a déjà été ajouté !");
        return(null);
    }

    // cas 4 : 7 étudiants ont déjà été ajoutés (limite)
    if (nombreDivEtudiantAjoute >= 7) {
        alert("Vous avez déjà ajouté 7 étudiants, la limite est atteinte");
        return(null);
    }

    // création d'un nouvel élément "div" de classe "etudiant-ajoute" avce "onclick" défini à la fonction "supprimerEtudiant()"
    var nouvelEtudiant = document.createElement("div");
    nouvelEtudiant.classList.add("etudiant-ajoute");
    nouvelEtudiant.setAttribute("onclick", "supprimerEtudiant(this)");

    // création d'un nouvel élément "span" et ajout du texte
    var nouvelEtudiantSpan = document.createElement("span");
    nouvelEtudiantSpan.textContent = valeurInput;

    // création d'un nouvel élément input caché
    var nouvelEtudiantInput = document.createElement("input");
    nouvelEtudiantInput.setAttribute("type", "hidden");
    nouvelEtudiantInput.setAttribute("name", "tableauEtudiants[]");
    nouvelEtudiantInput.value=idEtudiant;

    // ajout du "span" et du "input" à l'intérieur du "div"
    nouvelEtudiant.appendChild(nouvelEtudiantSpan);
    nouvelEtudiant.appendChild(nouvelEtudiantInput);

    // sélection de l'élément parent de nouvelEtudiant, ie le "div" "etudiants-ajoutes"
    var listeEtudiantsAjoutes = document.getElementById("etudiants-ajoutes");

    // ajout du nouvel élément dans l'élément parent
    listeEtudiantsAjoutes.appendChild(nouvelEtudiant);

    // réinitialisation de la valeur du "input"
    inputTexte.value = "";

}

// supprimer un étudiant
function supprimerEtudiant(div) {
    div.remove();
    return(null);
}

// alerte si moins de 3 étudiants en tout
function verifierEquipe(event) {
    // Sélectionne la liste des étudiants ajoutés à l'équipe
    var nombreEtudiants = document.getElementById('etudiants-ajoutes').childNodes.length;

    // Vérifie s'il y a moins de deux étudiants dans l'équipe
    if (nombreEtudiants < 2) {
        alert("Vous devez ajouter au moins deux étudiants à votre équipe !");
        event.preventDefault();
    }
}
