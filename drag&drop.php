<?php
if (isset($_FILES['myFile'])) {
    // Exemple:
    move_uploaded_file($_FILES['myFile']['tmp_name'], "upload/" . $_FILES['myFile']['name']);
    $filename = $_FILES['myFile']['name'] ;
    echo "Téléchargement de $filename : OK" ;
    echo "<pre>";
    print_r($_FILES["myFile"]) ;
    echo "</pre>";
    exit;
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>dnd binary upload</title>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <script type="text/javascript">
        function sendFile(file) {
            var uri = "drag&drop.php";
            var xhr = new XMLHttpRequest();
            var fd = new FormData();

            xhr.open("POST", uri, true);
            xhr.onreadystatechange = function() {
                if (xhr.readyState == 4 && xhr.status == 200) {
                    // Handle response.
                    // alert(xhr.responseText); // handle response.
                    document.getElementById("dropzone").innerHTML += xhr.responseText; // handle response.
                }
            };
            fd.append('myFile', file);
            // Initiate a multipart/form-data upload
            xhr.send(fd);
        }

        window.onload = function() {
            var dropzone = document.getElementById("dropzone");
            dropzone.ondragover = dropzone.ondragenter = function(event) {
                event.stopPropagation();
                event.preventDefault();
            }

            dropzone.ondrop = function(event) {
                event.stopPropagation();
                event.preventDefault();

                var filesArray = event.dataTransfer.files;
                for (var i=0; i<filesArray.length; i++) {
                    sendFile(filesArray[i]);
                }
            }
         }
    </script>
</head>
<body>
    <div>
        <div id="dropzone" style="margin:30px; width:500px; height:300px; border:1px dotted grey;">Glissez et déposez vos fichiers ici...</div>
    </div>
</body>
</html>
