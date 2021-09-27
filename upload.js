function initBar() {
    $(".bar").show();
    setProgressBar(0);
}
function  setProgressBar(percent) {
    $(".bar .progress").css("width", percent + "%");
    $(".bar .progress").data("value", percent);
    document.querySelector("#progress").innerHTML = percent + " %" ;
}
function endBar() {
    $(".bar").hide();
}

var recupererFichiers = function() {
    var fichiersInput = document.querySelector("#fileupload");
    var fichiers = fichiersInput.files;
  
    var nbFichiers = fichiers.length;
    var i = 0;

    msg = "" ;

    while(i < nbFichiers){
      var fichier = fichiers[i];
      msg += fichier.name + " (" + fichier.size + " octets) <br>" ;
      i++;
    }
    document.querySelector("#progress").innerHTML = msg ;
  }

function  upload(file) {
    var xhr = new XMLHttpRequest();
    xhr.open('POST', 'upload.php');
    initBar();
    xhr.upload.onprogress = function(e) {
        var loaded = e.loaded / e.total * 100;
        setProgressBar(loaded);
    };
    xhr.onload = function(e) {   
        //Si le statut HTTP n'est pas 200...
        if (xhr.status != 200){ 
            //...On affiche le statut et le message correspondant
            alert("Erreur " + xhr.status + " : " + xhr.statusText);
            //Si le statut HTTP est 200, on affiche le nombre d'octets téléchargés et la réponse
        }else{ 
            let a = 0
            //alert(xhr.response.length + " octets  téléchargés\n" + JSON.stringify(xhr.response));
            let section = document.querySelector("section")
            section.innerHTML = xhr.response
        }
        endBar();
    };  
        //Si la requête n'a pas pu aboutir...
    xhr.onerror = function(){
        alert("La requête a échoué");
    };

    var form = new FormData();
    form.append('file', file);
    xhr.send(form);
    };
    
// Accéder au formulaire …
// var form = document.getElementById("myForm");

// // … pour prendre en charge l'événement soumission
// form.addEventListener('submit', function (event) {
//   event.preventDefault();
//   sendData();
// });

var fileInput = document.querySelector('#fileupload');
fileInput.onchange = function() { upload(fileInput.files);};
fileInput.onchange = recupererFichiers ;