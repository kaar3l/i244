<div id="wrap">
	<h3>Fotode galerii</h3>
	<div id="gallery">
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
  <img src="<?php echo $file_path; ?>"/>
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
</div>
</div>
