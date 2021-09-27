<?php
function AffDir($rep) {
  $dir = opendir($rep);
  while ($File = readdir($dir))
  {
    if($File != "." && $File != "..")
    {
      echo $File." ";
      list($nom, $num, $ext) = sscanf($File, "%5s-%d.%s") ;
      echo "--> $nom ; $num ; $ext<br>" ;
    }
  }
  closedir($dir);
};

AffDir("./upload");
?>