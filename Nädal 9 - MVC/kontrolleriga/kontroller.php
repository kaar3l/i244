<!DOCTYPE html>
<?php
require_once('head.html');
?>
<head>
<link rel="stylesheet" type="text/css" href="style.css">
</head>

<?php
$reqestedPage=$_GET["page"];
switch ($reqestedPage) {
    case "gallery":
        include("views/gallery.php");
        break;
    case "vote":
        include("views/vote.php");
        break;
    case "main":
        include("views/main.php");
        break;
    case "results":
        include("views/results.php");
        break;
    default:
        echo "Viga! Palun proovi uuesti.";
}
?>

<?php
require_once('foot.html');
?>
