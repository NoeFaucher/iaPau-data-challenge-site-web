function validateConnexion() {
    const email = document.forms["connexion"]["email_participant"];
    const mdp = document.forms["connexion"]["mot_de_passe_participant"];

    let verification = true;

    if (email.value === ""){
        email.classList.remove('form-email');
        email.classList.add('error');
        verification = false;
    } else {
        email.classList.remove('error');
        email.classList.add('form-mdp')
    }

    if (mdp.value === ""){
        mdp.classList.remove('form-mdp');
        mdp.classList.add('error');
        verification = false;
    } else {
        mdp.classList.remove('error');
        mdp.classList.add('form-mdp')
    }

    return verification
}

