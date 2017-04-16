<!DOCTYPE html>
<?php
require_once('head.html');
?>
<head>
<link rel="stylesheet" type="text/css" href="style.css">
</head>
<div id="wrap">
	<h3>Vali oma lemmik :)</h3>
	<form action="tulemus.php" method="GET">


<?php
$folder_path = 'pildid/';
$num_files = glob($folder_path . "*.{JPG,jpg}", GLOB_BRACE);
$folder = opendir($folder_path);
if($num_files > 0)
{
 while(false !== ($file = readdir($folder))) 
 {
  $file_path = $folder_path.$file;
  $extension = strtolower(pathinfo($file ,PATHINFO_EXTENSION));
  if($extension=='jpg') 
  {
   ?>
<p>
  <img src="<?php echo $file_path; ?>" height="100" /><br>
  <input type="radio" value="<?php echo $file; ?>" id="$file_path" name="pilt"/>
</p>
<?php
  }
 }
}
else
{
 echo "the folder was empty !";
}
closedir($folder);
?>
<br><input type="submit" value="Valin!"/>
</form>



</div>
<?php
require_once('foot.html');
?>
