 <?php
// header("Content-type: text/plain");
//
// Exemple sur: https://developer.mozilla.org/fr/docs/Web/HTML/Element/Input/file#accept
//

function jeprint_r($mavariable){
  echo "<pre>";
  print_r($mavariable);
  echo "</pre><br>";
}

jeprint_r($_POST) ;
echo "<br>on passe là" ;
if (isset($_FILES['myFile'])) {
  jeprint_r($_FILES) ;
    $filename = $_FILES['myFile']['name'][0] ;
    if(move_uploaded_file($_FILES['myFile']['tmp_name'], "upload/" . $_FILES['myFile']['name'])) {
      echo "$filename:OK" ;
    } else {
      echo "$filename:KO" ;
    }
    // echo "<br>Téléchargement de $filename : OK" ;
    exit;
}
?>

<!DOCTYPE html>
<html>
<head>
  <title>Complete file example</title>
  <style>
    html {
      font-family: sans-serif;
    }

    form {
      width: 600px;
      background: #ccc;
      margin: 0 auto;
      padding: 20px;
      border: 1px solid black;
    }

    form ol {
      padding-left: 0;
    }

    form li, #disp {
      background: #eee;
      display: flex;
      justify-content: space-between;
      margin-bottom: 10px;
      list-style-type: none;
      border: 1px solid black;
    }
    form li p {
      display: inline-block;
    }

    form img {
      height: 64px;
      order: 1;
    }

    form p {
      line-height: 32px;
      padding-left: 10px;
    }

    form label, form button {
      background-color: #7F9CCB;
      padding: 5px 10px;
      border-radius: 5px;
      border: 1px ridge black;
      font-size: 0.8rem;
      height: auto;
    }

    form label:hover, form button:hover {
      background-color: #2D5BA3;
      color: white;
    }

    form label:active, form button:active {
      background-color: #0D3F8F;
      color: white;
    }

    .mark {
      width:  1rem ;
    }
  </style>
</head>
<body>
  <form method="post" enctype="multipart/form-data" action="">
    <div>
      <label for="image_uploads">Choisir des images à télécharger (PNG, JPG)</label>
      <input type="file" id="image_uploads" name="image_uploads" accept=".jpg, .jpeg, .png" multiple>
    </div>
    <div class="preview">
      <p id="disp">Pas de fichier sélectionné pour téléchargement</p>
    </div>
    <div>
      <button id="envoi">Submit</button>
    </div>
  </form>
  <div id="outputMessage"></div>


  <script>
    const input = document.querySelector('input');
    const preview = document.querySelector('.preview');

    input.style.opacity = 0;

    input.addEventListener('change', updateImageDisplay);

    function updateImageDisplay() {
      while(preview.firstChild) {
        preview.removeChild(preview.firstChild);
      }

      const curFiles = input.files;
      if(curFiles.length === 0) {
        const para = document.createElement('p');
        para.textContent = 'Pas de fichier sélectionné pour téléchargement (upload)';
        preview.appendChild(para);
      } else {
        const list = document.createElement('ol');
        preview.appendChild(list);

        index = 0 ;
        for(const file of curFiles) {
          const listItem = document.createElement('li');
          const divLeft = document.createElement('div') ;
          const uploaded = document.createElement('p') ;
          const para = document.createElement('p');
          uploaded.className = "mark" ;
          // <i class="bi bi-check-lg"></i>
          uploaded.id = "file" + index++ ;
          divLeft.appendChild(uploaded);
          divLeft.appendChild(para);

          if(validFileType(file)) {
            para.innerHTML = `Fichier: <b>${file.name}</b> (${returnFileSize(file.size)}).`;
            const image = document.createElement('img');
            image.src = URL.createObjectURL(file);

            listItem.appendChild(image);
          } else {
            para.textContent = `Fichier ${file.name}: Type de fichier non valide...!`;
            // listItem.appendChild(para);
          }

          listItem.appendChild(divLeft);
          list.appendChild(listItem);
        }
      }
    }

// https://developer.mozilla.org/en-US/docs/Web/Media/Formats/Image_types
    const fileTypes = [
        'image/apng',
        'image/bmp',
        'image/gif',
        'image/jpeg',
        'image/pjpeg',
        'image/png',
        'image/svg+xml',
        'image/tiff',
        'image/webp',
        `image/x-icon`
    ];

    function validFileType(file) {
      return fileTypes.includes(file.type);
    }

    function returnFileSize(number) {
      if(number < 1024) {
        return number + 'bytes';
      } else if(number > 1024 && number < 1048576) {
        return (number/1024).toFixed(1) + 'KB';
      } else if(number > 1048576) {
        return (number/1048576).toFixed(1) + 'MB';
      }
    }

    function displayResultIcon( element, filename, result ) {
      if (result == "OK")
        document.getElementById(element).innerHTML = '<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="green" class="bi bi-check-lg" viewBox="0 0 16 16"><path d="M13.485 1.431a1.473 1.473 0 0 1 2.104 2.062l-7.84 9.801a1.473 1.473 0 0 1-2.12.04L.431 8.138a1.473 1.473 0 0 1 2.084-2.083l4.111 4.112 6.82-8.69a.486.486 0 0 1 .04-.045z"/></svg>' ;
      else
        document.getElementById(element).innerHTML = '<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="red" class="bi bi-x-lg" viewBox="0 0 16 16"><path d="M1.293 1.293a1 1 0 0 1 1.414 0L8 6.586l5.293-5.293a1 1 0 1 1 1.414 1.414L9.414 8l5.293 5.293a1 1 0 0 1-1.414 1.414L8 9.414l-5.293 5.293a1 1 0 0 1-1.414-1.414L6.586 8 1.293 2.707a1 1 0 0 1 0-1.414z"/></svg>';
      
      document.getElementById("outputMessage").innerHTML += "<br>Téléchargement de " + filename + ": " + result; // handle response.
    }

        function sendFile(file, num) {
            var uri = "exemple.php";
            var xhr = new XMLHttpRequest();
            var fd = new FormData();

            xhr.open("POST", uri, true);
            xhr.onreadystatechange = function() {
                if (xhr.readyState == 4 && xhr.status == 200) {
                  document.getElementById("outputMessage").innerHTML += xhr.responseText ;
                  // la réponse est de la forme:  nom_du_fichier:OK
                  const buffer = xhr.responseText.split(":") 
                   displayResultIcon("file"+xhr.index, xhr.filename, buffer[1])
                } else  {
                  // displayResultIcon("file"+xhr.index, xhr.filename, "KOOOOK")
                }
            };
            // on stocke l'index dans la liste des fichiers à envoyer + le nom du fichier
            // pour affichage d'une coche verte (OK) ou d'une croix rouge (KO)
            xhr.index = num ;
            xhr.filename = file.name ;
            fd.append('myFile', file);
            // Initiate a multipart/form-data upload
            xhr.send(fd);
        }

        window.onload = function() {
            var submit = document.getElementById("envoi");
            
            submit.onclick = function(event) {
                event.stopPropagation();
                event.preventDefault();

                // var filesArray = event.dataTransfer.files;
                for (var i=0; i<input.files.length; i++) {
                    sendFile(input.files[i], i);
                }
            }
         }
    </script>

  </script>
</body>
</html>