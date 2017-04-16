<div id="wrap">
	<h3>Valiku tulemus</h3>
	<p>
<?php
$folder_path = 'pildid/';
$num_files = glob($folder_path . "*.{JPG,jpg}", GLOB_BRACE);
$folder = opendir($folder_path);
$valitudpilt=$_POST["pilt"];
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
