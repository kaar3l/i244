<!DOCTYPE html>
<?php
require_once('head.html');
?>
<head>
<link rel="stylesheet" type="text/css" href="style.css">
</head>
<div id="wrap">
	<h3>Valiku tulemus</h3>
	<p>

<?php
$folder_path = 'pildid/';
$num_files = glob($folder_path . "*.{JPG,jpg}", GLOB_BRACE);
$folder = opendir($folder_path);
$valitudpilt=$_GET["pilt"];
$valitudpath=$folder_path.$valitudpilt;
?>
<?php
if (isset($valitudpilt) ) {
  echo "Tänan valiku eest!<br>";
  echo "Sinu valitud pilt:";
  echo "<br>";
  echo "<img src=\"";
  echo $valitudpath;
  echo "\"";
} else {
  echo "Miks sa pilti ei valinud? Pidid ju valima!";
}
?>
<?php
closedir($folder);
?>

</p>

</div>
<?php
require_once('foot.html');
?>
