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



function editMode() {
    
}