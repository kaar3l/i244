<?php
$parool="parool";
if (empty($_POST['pass'])){
  echo "Palun sisesta parool!";
  include_once('views/login.html');
}else{
  if ($_POST['pass']==$parool){
    $file = fopen("salajased_paroolid.txt","r");
    echo "<br>";
    echo fread($file,filesize("salajased_paroolid.txt"));
    fclose($file);
  }else{
    echo "Palun sisesta <b>õige</b> parool!";
    include_once('views/login.html');
  }

}
?>
