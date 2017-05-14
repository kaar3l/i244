<?php


function connect_db(){
	global $connection;
	$host="localhost";
	$user="root";
	$pass="laptop";
	$db="test";
	$connection = mysqli_connect($host, $user, $pass, $db) or die("ei saa ühendust mootoriga- ".mysqli_error());
	mysqli_query($connection, "SET CHARACTER SET UTF8") or die("Ei saanud baasi utf-8-sse - ".mysqli_error($connection));
}


function kuva_puurid(){
	// siia on vaja funktsionaalsust
	if(!empty($_SESSION['user'])){
		echo "Oled kenasti sisse logitud kasutaja: ";
		echo $_SESSION['user'];
	}else{
		header("location: loomaaed.php?page=login");
	}

	global $connection;
	$p= mysqli_query($connection, "select distinct(puur) as puur from loomad order by puur asc");
	$puurid=array();
	while ($r=mysqli_fetch_assoc($p)){
		$l=mysqli_query($connection, "SELECT * FROM loomad WHERE  puur=".mysqli_real_escape_string($connection, $r['puur']));
		while ($row=mysqli_fetch_assoc($l)) {
			$puurid[$r['puur']][]=$row;
		}
	}

	include_once('views/puurid.html');
}

function logi(){
	// siia on vaja funktsionaalsust (13. nädalal)
	global $connection;
	$username = mysqli_real_escape_string($connection,$_POST['user']);
	$password = mysqli_real_escape_string($connection,$_POST['pass']);
	$sql = "SELECT id FROM kylastajad WHERE `username` = '$username' AND `passw`=SHA1('$password')";
	$result = mysqli_query($connection,$sql);
	$row = mysqli_fetch_array($result,MYSQLI_ASSOC);
	$active = $row['active'];
	$count = mysqli_num_rows($result);
	if($count == 1) {
		session_start();
		$_SESSION['user'] = $username;
		header("location: loomaaed.php?page=loomad");
	}else {
		echo "Kasutajanimi või parool on vale. Palun proovi uuesti!";
	}
	echo "<br>";
	echo $count;
	echo "<br>";
	echo $_SESSION['user'];

	include_once('views/login.html');
}

function logout(){
	$_SESSION=array();
	session_destroy();
	header("Location: ?");
}

function lisa(){
	// siia on vaja funktsionaalsust (13. nädalal)
	global $connection;
	if(!empty($_SESSION['user'])){
		echo "Oled kenasti sisse logitud kasutaja: ";
		echo $_SESSION['user'];
	}else{
		header("location: loomaaed.php?page=login");
	}
	include_once('views/loomavorm.html');

	if(empty($_POST['nimi']) and empty($_POST['puur'])) {
		echo "Lisa loom";	
	} else {
		$nimi = mysqli_real_escape_string($connection,$_POST['nimi']);
		$puur = mysqli_real_escape_string($connection,$_POST['puur']);
		$yleslaad=$_FILES["liik"]["ylesLaetavFail"];
		$uploadResult=upload("liik");
		$sql = "INSERT INTO loomad (nimi, puur, liik) VALUES ('$nimi', $puur, '$uploadResult')";
		if (mysqli_query($connection, $sql)) {
			echo "Uus loom lisatud edukalt";
			header("location: loomaaed.php?page=loomad");
		} else {
			echo "Error: " . $sql . "<br>" . mysqli_error($connection);
		}
		mysqli_close($conn);
	}
}

function upload($name){
	$allowedExts = array("jpg", "jpeg", "gif", "png");
	$allowedTypes = array("image/gif", "image/jpeg", "image/png","image/pjpeg");
	$extension = end(explode(".", $_FILES[$name]["name"]));

	if ( in_array($_FILES[$name]["type"], $allowedTypes)
		&& ($_FILES[$name]["size"] < 100000)
		&& in_array($extension, $allowedExts)) {
    // fail õiget tüüpi ja suurusega
		if ($_FILES[$name]["error"] > 0) {
			$_SESSION['notices'][]= "Return Code: " . $_FILES[$name]["error"];
			return "";
		} else {
      // vigu ei ole
			if (file_exists("pildid/" . $_FILES[$name]["name"])) {
        // fail olemas ära uuesti lae, tagasta failinimi
				$_SESSION['notices'][]= $_FILES[$name]["name"] . " juba eksisteerib. ";
				return "pildid/" .$_FILES[$name]["name"];
			} else {
        // kõik ok, aseta pilt
				move_uploaded_file($_FILES[$name]["tmp_name"], "pildid/" . $_FILES[$name]["name"]);
				return "pildid/" .$_FILES[$name]["name"];
			}
		}
	} else {
		return "";
	}
}

?>
