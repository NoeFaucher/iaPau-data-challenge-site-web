/*
* Fonction de validation du formulaire d'inscription
* Vérifie que tous les champs obligatoires sont remplis correctement
*/
function validateInscription() {
    const nom = document.forms["inscription"]["nom_participant"];
    const prenom = document.forms["inscription"]["prenom_participant"];
    const telephone = document.forms["inscription"]["telephone_participant"];
    const email = document.forms["inscription"]["email_participant"];
    const mdp = document.forms["inscription"]["mot_de_passe_participant"];
    const mdpConfirmation = document.forms["inscription"]["mot_de_passe_confirmation"];
    const nivEtude = document.forms["inscription"]["niveau_etude_participant"];
    const ecole = document.forms["inscription"]["ecole_participant"];
    const ville = document.forms["inscription"]["ville_participant"];

    const emailRegExp = /^[^\s@]+@[^\s@]+\.[^\s@]+$/; // Expression régulière pour valider le format de l'email
    const teleRegExp = /^(0|\+33)[1-9]([-. ]?[0-9]{2}){4}$/; // Expression régulière pour valider le format du numéro de téléphone
    let verification = true;

    // Validation du champ nom
    if (nom.value === ""){
        nom.classList.add('error'); // Champ nom vide
        verification = false;
    } else {
        nom.classList.remove('error');
    }

    // Validation du champ prenom
    if (prenom.value === ""){
        prenom.classList.add('error'); // Champ prenom vide
        verification = false;
    } else {
        prenom.classList.remove('error');
    }

    // Validation du champ telephone
    if ((telephone.value === "") || (!teleRegExp.test(telephone.value))){
        telephone.classList.add('error'); // Champ telephone vide ou format incorrect
        verification = false;
    } else {
        telephone.classList.remove('error');
    }

    // Validation du champ email
    if ((email.value === "") || (!emailRegExp.test(email.value))) {
        email.classList.add('error'); // Champ email vide ou format incorrect
        verification = false;
    } else {
        email.classList.remove('error');
    }

    // Validation des champs mot de passe et confirmation
    if ((mdp.value === "") || (mdp.value !== mdpConfirmation.value)){
        mdp.classList.add('error'); // Champ mot de passe vide ou non identique à la confirmation
        mdpConfirmation.classList.add('error'); // Champ confirmation du mot de passe
        verification = false;
    } else {
        mdp.classList.remove('error');
        mdpConfirmation.classList.remove('error');
    }

    // Validation du champ niveau d'étude
    if (nivEtude.value === "") {
        nivEtude.classList.add('error'); // Champ niveau d'étude vide
        verification = false;
    } else {
        nivEtude.classList.remove('error');
    }

    // Validation du champ école
    if (ecole.value === "") {
        ecole.classList.add('error'); // Champ école vide
        verification = false;
    } else {
        ecole.classList.remove('error');
    }

    // Validation du champ ville
    if (ville.value === "") {
        ville.classList.add('error'); // Champ ville vide
        verification = false;
    } else {
        ville.classList.remove('error');
    }

    return verification;
}
