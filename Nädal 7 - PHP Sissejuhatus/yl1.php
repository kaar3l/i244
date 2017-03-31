<head>
</head>
<html>
<title>PHP Sissejuhatus</title>
<?php echo 'Current PHP version: ' . phpversion(); ?>
<body><p><b>Ülesanne 1 - Stringi keeramine tagurpidi</b></p>

<?php
$input = "Lorem ipsum";
echo "<b>Algne string: </b>";
echo $input,"<br>";
$stringLength=strlen($input);
echo "<b>Töödeldud string tähtedena echo: </b>";
$output="";
for($i = 0; $i < $stringLength; $i++)
{
   $j=$stringLength-$i-1;
   echo $input[$j];
   $output .=$input[$j];
}
echo "<br>";
echo "<b>Töödeldud string eraldi stringiks: </b>";
echo $output;
?>
<meta charset="UTF-8" />
<!DOCTYPE html>
