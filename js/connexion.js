function validateConnexion() {
    const email = document.forms["connexion"]["email_participant"];
    const mdp = document.forms["connexion"]["mot_de_passe_participant"];

    const emailRegExp = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;

    let verification = true;

    if ((email.value === "" ) || (!emailRegExp.test(email.value))) {
        email.classList.add('error');
        verification = false;
    } else {
        email.classList.remove('error');
    }

    if (mdp.value === ""){
        mdp.classList.add('error');
        verification = false;
    } else {
        mdp.classList.add('form-mdp')
    }

    return verification
}

