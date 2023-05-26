

let p = document.getElementById("test");

function getXHR() {
    var xhr = null;
    if (window.XMLHttpRequest) // FF & autres
        xhr = new XMLHttpRequest();
    else if (window.ActiveXObject) { // IE < 7
        try {
            xhr = new ActiveXObject("Msxml2.XMLHTTP");
        } catch (e) {
            xhr = new ActiveXObject("Microsoft.XMLHTTP");
        }
    } else { // Objet non supporté par le navigateur
        alert("Votre navigateur ne supporte pas AJAX");
        xhr = false;
    }
    return xhr;
}


function execution() {
    var xhr = getXHR();

    // On définit que l'on va faire à chq changement d'état
    xhr.onreadystatechange = function() {
        // On ne fait quelque chose que si on a tout reç̧u
        // et que le serveur est ok

        if (xhr.readyState == 4 && xhr.status == 200){
            console.log(this.responseText);
        }
    }
    // cas de la mé́thode get
    xhr.open("GET","/serveur/test.php",true) ;
    xhr.send();
}



