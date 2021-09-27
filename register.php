<?php
/* register.php */

header("Content-type: text/plain");

/*
NOTE: You should never use `print_r()` in production scripts, or
otherwise output client-submitted data without sanitizing it first.
Failing to sanitize can lead to cross-site scripting vulnerabilities.
*/

echo ":: data received via GET ::\n\n";
print_r($_GET);

echo "\n\n:: Data received via POST ::\n\n";
print_r($_POST);

echo "\n\n:: Data received as \"raw\" (text/plain encoding) ::\n\n";
if (isset($HTTP_RAW_POST_DATA)) { echo $HTTP_RAW_POST_DATA; }

echo "\n\n:: Files received ::\n\n";
print_r($_FILES);

if (isset($_FILES['photos'])) {
    // jeprint_r($_FILES['photos']['name']) ;

    $nbFiles = count($_FILES['photos']['name']) ;
    echo "<br>il y a $nbFiles fichiers" ;

    for ( $i=0; $i < $nbFiles; $i++) {
        $filename = $_FILES['photos']['name'][$i] ;
        if(move_uploaded_file($_FILES['photos']['tmp_name'][$i], "upload/" . $filename)) {
            echo "<br>$filename:$i:OK" ;
        } else {
            echo "<br>$filename:$i:KO" ;
        }
    }
    // echo "<br>Téléchargement de $filename : OK" ;
    // jeprint_r($_FILES["myFile"]) ;
    exit;
    }

    function jeprint_r($mavariable){
        echo "<pre>";
        print_r($mavariable);
        echo "</pre><br>";
      }
?>