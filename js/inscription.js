function validateInscription() {
    const nom = document.forms["inscription"]["nom_participant"];
    const prenom = document.forms["inscription"]["prenom_participant"];
    const email = document.forms["inscription"]["email_participant"];
    const mdp = document.forms["inscription"]["mot_de_passe_participant"];
    const mdpConfirmation = document.forms["inscription"]["mot_de_passe_confirmation"];
    const nivEtude = document.forms["inscription"]["niveau_etude_participant"];
    const ecole = document.forms["inscription"]["ecole_participant"];
    const ville = document.forms["inscription"]["ville_participant"];

    const emailRegExp = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;


    let verification = true;

    if (nom.value === ""){
        nom.classList.add('error');
        verification = false;
    } else {
        nom.classList.remove('error');
    }

    if (prenom.value ===""){
        prenom.classList.add('error');
        verification = false;
    } else {
        prenom.classList.remove('error');
    }

    if ((email.value === "" ) || (!emailRegExp.test(email.value))) {
        email.classList.add('error');
        verification = false;
    } else {
        email.classList.remove('error');
    }

    if ((mdp.value === "") || (mdp.value !== mdpConfirmation.value)){
        mdp.classList.add('error');
        mdpConfirmation.classList.add('error');
        verification = false;
    } else {
        mdp.classList.remove('error');
        mdpConfirmation.classList.remove('error');
    }

    if (nivEtude.value === "") {
        nivEtude.classList.add('error');
        verification = false;
    } else {
        nivEtude.classList.remove('error');
    }

    if (ecole.value === "") {
        ecole.classList.add('error');
        verification = false;
    } else {
        ecole.classList.remove('error');
    }

    if (ville.value === "") {
        ville.classList.add('error');
        verification = false;
    } else {
        ville.classList.remove('error');
    }

    return verification
}