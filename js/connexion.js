/*
* Test le format de l'email rentré par utilisateur
* Test si le mdp n'est pas vide
*/
function validateConnexion() {
    /* Récupération de l'email et du mot de passe rentrés dans le formulaire */
    const email = document.forms["connexion"]["email_participant"];
    const mdp = document.forms["connexion"]["mot_de_passe_participant"];

    /* Expression régulière pour tester l'email */
    const emailRegExp = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;

    let verification = true;

    /* Test de l'email */
    if ((email.value === "" ) || (!emailRegExp.test(email.value))) {
        /* Email invalide ou vide */
        email.classList.add('error');
        verification = false;
    } else {
        email.classList.remove('error');
    }

    /* Test du mot de passe */
    if (mdp.value === ""){
        /* Mot de passe vide */
        mdp.classList.add('error');
        verification = false;
    } else {
        mdp.classList.remove('error');
    }

    return verification;
}

