function getXHR() {
    var xhr = null;
    if (window.XMLHttpRequest)
       xhr = new XMLHttpRequest();
    else if (window.ActiveXObject) {
         try {
           xhr = new ActiveXObject("Msxml2.XMLHTTP");
         } catch (e) {
           xhr = new ActiveXObject("Microsoft.XMLHTTP");
         }
    } else {
       alert("Votre navigateur ne supporte pas AJAX");
       xhr = false;
    }
    return xhr;
  }




function ajouterMembre(elem,idEqu,idUtilConnecte,idDataEv) {
    var xhr = getXHR();


    var utilEntre = elem.parentNode.querySelector('.searchInp').value;

    let dataListOptions = elem.parentNode.querySelector('.dataL').children;

    for (let i = 0; i < dataListOptions.length; i++) {
        let option = dataListOptions[i];
        if (utilEntre == option.value) {
            var idUtil = option.dataset.id;
        }
      }

    xhr.onreadystatechange = function() {

       if (xhr.readyState == 4 && xhr.status == 200){
        if (this.responseText.includes("done")) {
          var newP = document.createElement("p");
          newP.textContent = utilEntre;
          if (idUtil != null) {
            elem.parentNode.querySelector('.membres').appendChild(newP);
          }
        } else if (this.responseText.includes("participe")){
          alert("L'utilisateur participe déjà à ce Data Challenge.");
        }else if (this.responseText.includes("Trop")){
          alert("Trop de membre dans cette équipe (8 max).")
        }
        console.log(this.responseText);
       }
    }

    
    xhr.open("POST","ajoutMembre.php",true) ;
    xhr.setRequestHeader('Content-Type',
           'application/x-www-form-urlencoded;charset=utf-8');
    xhr.send("idUtilConnecte="+idUtilConnecte+"&idEqu="+idEqu+"&idUtil="+idUtil+"&idDataEv="+idDataEv);
    
  }

  function supprimerMembre(elem,idEqu,idUtilConnecte) {
    var xhr = getXHR();

    var utilEntre = elem.parentNode.querySelector('.searchInp').value;

    let dataListOptions = elem.parentNode.querySelector('.dataL').children;

    for (let i = 0; i < dataListOptions.length; i++) {
        let option = dataListOptions[i];
        if (utilEntre == option.value) {
            var idUtil = option.dataset.id;
        }
      }

    xhr.onreadystatechange = function() {

       if (xhr.readyState == 4 && xhr.status == 200){
          if (this.responseText.includes("done")) {
            Array.from(elem.parentNode.querySelector('.membres').children).forEach(mbr => {
              if (mbr.textContent == utilEntre) {
                mbr.remove();
              }
            });
          }else if (this.responseText.includes("chef")){
            alert("L'utilisateur que vous souhaitez supprimer est le chef de l'équipe.");
          }else if (this.responseText.includes("taille")){
            alert("La taille minimale de l'équipe est de 3 membres, suppression impossible  ");
          }
       }
    }

    
    xhr.open("POST","supprimerMembre.php",true) ;
    xhr.setRequestHeader('Content-Type',
           'application/x-www-form-urlencoded;charset=utf-8');
    xhr.send("idUtilConnecte="+idUtilConnecte+"&idEqu="+idEqu+"&idUtil="+idUtil);
    
  }


  function supprimerEquipe(elem,idEqu) {
    var xhr = getXHR();

    

    xhr.onreadystatechange = function() {

       if (xhr.readyState == 4 && xhr.status == 200){
        console.log(this.responseText);
          elem.parentNode.parentNode.remove();
       }
    }

    
    xhr.open("POST","supprimerEquipe.php",true) ;
    xhr.setRequestHeader('Content-Type',
           'application/x-www-form-urlencoded;charset=utf-8');
    xhr.send("idEqu="+idEqu);
    
  }