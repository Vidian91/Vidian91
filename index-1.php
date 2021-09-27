<!DOCTYPE html> 
<html> 
    <head> 
    <title> Exemple de téléchargement de fichier JavaScript Ajax </title> 
    <link type="text/css" href="style.css" rel="stylesheet" ?>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
     <script type="text/javascript" src="upload.js" async></script>
     <script type="text/javascript" src="exemple.js" async></script>
    </head> 
<body> 

  <!-- Logique de téléchargement de fichier JavaScript Ajax --> 
  <!-- <script> 
  async function uploadFile() { 
      console.log("entrée fonction")
      let formData = new FormData(); 
      formData.append("file", fileupload.files[0]); 
      await   fetch('upload.php', {
          méthode : "POST",
          corps : formData
        }); 
        alert(' Le fichier a été téléchargé avec succès. '); 
    } 
    </script> -->

<form method="post" action="upload.php" enctype="multipart/form-data">
     <input type="hidden" name="MAX_FILE_SIZE" value="25000000" />
     <input type="file" name="fichiers" id="mon_fichier" multiple placeholder="25 Mo maxi"/><br />
     <input type="submit" name="submit" value="Envoyer" />
</form
>
    <!-- Éléments de formulaire de saisie HTML5 --> 
<form>
    <input id ="fileupload" type = "file" name ="fichiers" multiple />  
</form>
    <p id="progress"></p>
    <div class="bar">
        <div class="progress"></div>
    </div>
    <button id ="upload-button" onclick ="upload(fileInput.files)"> Upload </button>

    <section></section>

 <!-- Exemple sur:  https://developer.mozilla.org/fr/docs/Web/HTML/Element/Input/file -->

<form method="post" enctype="multipart/form-data">
  <div>
    <label for="image_uploads">Sélectionner des images à uploader (PNG, JPG)</label>
    <input type="file" id="image_uploads" name="fichiers" accept=".jpg, .jpeg, .png" multiple>
  </div>
  <div class="preview">
    <p>Aucun fichier sélectionné pour le moment</p>
  </div>
  <div>
    <button>Envoyer</button>
  </div>
</form>

</body> 
</html>