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

// vérification du nom de l'équipe : alerte si une équipe avec le même nom existe déjà
function validerNomEquipe() {
    var nomEquipe = $('#nom-equipe-input').val().trim();
    if (nomEquipe == "") {
        messageErreurCouleurNomEquipe(1, "Vous ne pouvez pas choisir un nom d'équipe vide !")
        return(null);
    }
    $.ajax({
        url: 'verification-nom-equipe.php',
        method: 'POST',
        data: { nomEquipe: nomEquipe },
        success: function(response) {
            messageErreurCouleurNomEquipe((response === 'existe'), "Une autre équipe possède déjà ce nom !")
            return(null);
        },
        error: function() {
            alert("Une erreur s'est produite lors de la vérification. Veuillez réessayer plus tard. Si le problème persiste, contactez un gestionnaire ou l'administrateur.");
            return(null);
        }
    });
}

// fonction annexe à la fonction validerNomEquipe, affichage du message d'erreur et mise de la couleur sur le "input"
// bool = 1 : erreur, bool = 0 : pas d'erreur
function messageErreurCouleurNomEquipe(bool, message) {
    var input = document.getElementById('nom-equipe-input');
    var messageErreur = document.getElementById('texte-erreur-nom-equipe');
    if (bool) {
        input.style.border = "2px solid red";
        messageErreur.textContent = message;
        messageErreur.style.color = "red";
    }
    else {
        input.style.border = "2px solid green";
        messageErreur.textContent = "Nom d'équipe valide.";
        messageErreur.style.color = "green";
    }
}

// alerte si moins de 3 étudiants en tout ou si le nom de l'équipe existe déjà
function verifierEquipe(event) {

    // vérifie s'il n'y a pas de message d'erreur pour le nom de l'équipe
    var messageErreur = document.getElementById('texte-erreur-nom-equipe').textContent;
    if (messageErreur !== "Nom d'équipe valide.") {
        alert("Le nom de votre équipe n'est pas correct !");
        event.preventDefault();
    }

    // vérifie s'il y a moins de deux étudiants dans l'équipe
    var nombreEtudiants = document.getElementById('etudiants-ajoutes').childNodes.length;
    if (nombreEtudiants < 2) {
        alert("Vous devez ajouter au moins deux étudiants à votre équipe !");
        event.preventDefault();
    }

}