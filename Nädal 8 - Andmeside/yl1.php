 <!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <title>Ülesanne 1 - POST-meetodiga stiilide muutmine</title>
	<style type="text/css">
	p.muudetavText { padding: 30px 30px 30px 30px; border-width: <?=$_POST['borderWidth']?>px; background-color:<?=$_POST['bgColor']?>;color:<?=$_POST['textColor']?>;border-style: <?=$_POST['lineStyle']?>; border-color: <?=$_POST['lineColor']?>; border-radius: <?=$_POST['borderRadius']?>px}
	</style>
</head>
<body>
<div id="wrap">
    <h1>Ülesanne 1 - POST-meetodiga stiilide muutmine</h1>

<?php
$myurl=$_SERVER['PHP_SELF'];
#Vaatame, kas on esimene laadimine ja kas on POST data-t või mitte?
if (isset($_POST['lineColor']) )
{
#Post data olemas, seega ei muuda midagi.
} else {
#Post data-t pole, seega paneme default data:
    $_POST['borderWidth']="5";
    $_POST['bgColor']="#16C7DB";
    $_POST['textColor']="#000000";
    $_POST['lineStyle']="solid";
    $_POST['lineColor']="#EED637";
    $_POST['borderRadius']="5";
    $_POST['inputText']="Sisesta tekst";
}
?>

<form action="<?php echo $myurl?>" method="POST">

<table style="width:40%">
  <tr>
    <th colspan="2">PHP abil muudetav CSS kujundus:</th>
  </tr>
  <tr>
    <td colspan="2"><p class="muudetavText"><?=$_POST['inputText']?></p></td>
  </tr>
  <tr>
    <td colspan="2"><input type="text" name="inputText" value="<?=$_POST['inputText']?>"/><br></td>
  </tr>
  <tr>
    <td width="20%">Taustavärv:</td><td><input type="color" name="bgColor" value="<?=$_POST['bgColor']?>"><br></td>
  </tr>
  <tr>
    <td>Tekstivärv:</td><td><input type="color" name="textColor" value="<?=$_POST['textColor']?>"><br></td>
  </tr>
  <tr>
    <th>Piirjoon:</th>
  </tr>
  <tr>
    <td>Piirjoone laius (0-20px):</td><td><input type="number" name="borderWidth" min="1" max="20" value="<?=$_POST['borderWidth']?>"><br></td>
  </tr>
  <tr>
    <td>Piirjoone stiil:</td><td>
    <select name="lineStyle">
    <?php 
    $selectedLineStyle=$_POST['lineStyle'];
    #Et tõstetaks esimeseks valitud joone stiil ja ei muudetaks jälle defaultiks.
    echo "<option value=\"$selectedLineStyle\">$selectedLineStyle</option>"
    ?>
    <option value="dotted">dotted</option>
    <option value="dashed">dashed</option>
    <option value="solid">solid</option>
    <option value="double">double</option>
    <option value="groove">groove</option>
    <option value="ridge">ridge</option>
    <option value="inset">inset</option>
    <option value="outset">outset</option>
    <option value="none">none</option>
    <option value="hidden">hidden</option>
    </select>
    <br></td>
  </tr>
  <tr>
    <td>Piirjoone värv:</td><td><input type="color" name="lineColor" value="<?=$_POST['lineColor']?>"><br></td>
  </tr>
  <tr>
    <td>Piirjoone raadius (0-100px):</td><td><input type="number" name="borderRadius" min="1" max="100" value="<?=$_POST['borderRadius']?>"><br></td>
  </tr>
  <tr>
    <td><input type="submit" value="edasta"/></td>
  </tr>
</table>

</form>
</div>
</body>
</html>
