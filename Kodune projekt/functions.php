<?php
function connect_db(){
	global $connection;
	$host="localhost";
	$user="root";
	$pass="laptop";
	$db="kulutused";
	$connection = mysqli_connect($host, $user, $pass, $db) or die("ei saa ühendust mootoriga- ".mysqli_error());
	mysqli_query($connection, "SET CHARACTER SET UTF8") or die("Ei saanud baasi utf-8-sse - ".mysqli_error($connection));
}


function kuva_kuluread(){
	// siia on vaja funktsionaalsust
//	if(!empty($_SESSION['user'])){
//		echo "Oled kenasti sisse logitud kasutaja: ";
//		echo $_SESSION['user'];
//	}else{
//		header("location: loomaaed.php?page=login");
//	}

	global $connection;
	$query = "SELECT * FROM `kulud`";
	$result= mysqli_query($connection, $query);
	if ($result->num_rows > 0) {
		echo "<table><tr>";
		echo "<th>Aeg</th>";
		echo "<th>Liik</th>";
		echo "<th>Summa</th>";
		echo "<th>Märkus</th>";
  		while($row = $result->fetch_assoc()) {
			echo "<tr>";
			echo "<td>".$row["aeg"]."</td>";
			echo "<td>".$row["liik"]."</td>";
			echo "<td>".$row["summa"]."</td>";
			echo "<td>".$row["kommentaar"]."</td>";
			echo "</tr>";
 		}
	} else {
 		echo "Pole kuluridu sisestatud";
	}
	echo "</tr></table>";
	$connection->close();
	echo "Siia võiks lisada graafiku vms ka (aeg+kulud) pi chart kululiigid";
//	include_once('views/puurid.html');
}


function lisa_kulurida(){
		global $connection;
		if(empty($_POST['date']) and empty($_POST['liik']) and empty($_POST['summa'])) {
			echo "Lisa kulurida!<br>";
			echo "Täita tuleb kuupäev, liik ja summa.";
		} else {
			$kuupaev = mysqli_real_escape_string($connection,$_POST['date']);
			$liik = mysqli_real_escape_string($connection,$_POST['liik']);
			$summa = mysqli_real_escape_string($connection,$_POST['summa']);
			$m2rkus = mysqli_real_escape_string($connection,$_POST['m2rkus']);
//			$sql = "INSERT INTO loomad (nimi, puur, liik) VALUES ('$nimi', $puur, '$uploadResult')";
//			mysqli_close($conn);
			echo $kuupaev;
			echo $liik;
			echo $summa;
			echo $m2rkus;
			if (mysqli_query($connection, $sql)) {
				echo "Uus loom lisatud edukalt";
				header("location: kulud.php?page=lisa_kulu");
			} else {
				echo "Error: " . $sql . "<br>" . mysqli_error($connection);
			}
		}
		include_once('views/reasisestusvorm.html');
}






function muuda_looma(){
	//ADMINI kontroll:
	if($_SESSION['admin']==1){
		global $connection;
		//KASUTAJA kontroll:
		if(!empty($_SESSION['user'])){
			echo "Oled kenasti sisse logitud kasutaja: ";
			echo $_SESSION['user'];
		}else{
			header("location: loomaaed.php?page=login");
		}

		//Muudetava looma id:
		$muudetavaLoomaID=$_GET['id'];


		//get_loom - võtab andmebaasist looma info rea
		$loom=get_loom($muudetavaLoomaID);
		//display_loom - echotab looma info nähtavaks
		display_loom($loom);

//		echo $_SESSION['muudetavaLoomaID'];
		echo "<br>";

		if(empty($_POST['nimi']) and empty($_POST['puur'])) {
			echo "<b>Muuda looma:</b>";
		} else {
			$loomaID=$_GET['id'];
			$nimi = mysqli_real_escape_string($connection,$_POST['nimi']);
			$puur = mysqli_real_escape_string($connection,$_POST['puur']);
			$yleslaad=$_FILES["liik"]["ylesLaetavFail"];

			$uploadResult=upload("liik");

			$loomaID=$_SESSION['muudetavaLoomaID'];
			echo "<br><br>";
//			echo "LoomaID: ";
//			echo $loomaID;
//			echo "<br><br>";
			$sql = "UPDATE loomad SET nimi='$nimi', puur=$puur, liik='$uploadResult' WHERE id=$loomaID";
//			echo $loomaID;

			if (mysqli_query($connection, $sql)) {
				echo "Loom muudetud";
				header("location: loomaaed.php?page=muuda&id=$loomaID");
			} else {
				echo "Error: " . $sql . "<br>" . mysqli_error($connection);
			}
			mysqli_close($conn);
		}
		//Salvestame nüüd loomaid ära enne uue lehe laadimist, et teaks mis looma uuendada
		$_SESSION['muudetavaLoomaID']=$muudetavaLoomaID;

		include_once('views/editvorm.html');
	} else {
		//Kuna sa poel admin, siis viskame loomaaia vaaatesse
		header("location: loomaaed.php?page=loomad");
	}
}

function get_loom($input_id){
	global $connection;
	$sql="SELECT * FROM loomad WHERE id=($input_id)";
	$result = mysqli_query($connection,$sql);
	$row = mysqli_fetch_array($result,MYSQLI_ASSOC);
	return $row;
}

function display_loom($input_loom){
	echo "<br>";
	echo "<b>Praegune looma info:</b>";
	echo "<br>";
//	echo "id: " . $input_loom["id"];
//	echo "<br>";
	echo "nimi: " . $input_loom["nimi"];
	echo "<br>";
	echo "puur: " . $input_loom["puur"];
	echo "<br>";
	echo "liik: " . $input_loom["liik"];
	echo "<br>";
	echo "<img src=" . $input_loom["liik"] . ">";
}

function logi(){
	// siia on vaja funktsionaalsust (13. nädalal)
	global $connection;
	$username = mysqli_real_escape_string($connection,$_POST['user']);
	$password = mysqli_real_escape_string($connection,$_POST['pass']);
	$sql = "SELECT id FROM kylastajad WHERE `username` = '$username' AND `passw`=SHA1('$password')";
	$sql2= "SELECT roll FROM kylastajad WHERE `username` = '$username' AND `passw`=SHA1('$password')";
	//USER test:
	$result = mysqli_query($connection,$sql);
	$row = mysqli_fetch_array($result,MYSQLI_ASSOC);
	$active = $row['active'];
	$count = mysqli_num_rows($result);
	//ADMIN test:
	$result2 = mysqli_query($connection,$sql2);
	$row2 = mysqli_fetch_array($result2,MYSQLI_ASSOC);
	$active2 = $row2['active'];
	$count2 = mysqli_num_rows($result2);
	//USER:
	if($count == 1) {
		session_start();
		$_SESSION['user'] = $username;
		//ADMIN:
		if($row2["roll"] =="admin"){
			$_SESSION['admin'] = 1;
			echo "Oled admin";
		}
		header("location: loomaaed.php?page=loomad");
	}else {
		echo "Kasutajanimi või parool on vale. Palun proovi uuesti!";
	}
	echo "<br>";
	echo $row;
	echo "<br>";
	echo $row2["roll"];
	echo "<br>";
	//echo $_SESSION['user'];

	include_once('views/login.html');
}

function logout(){
	$_SESSION=array();
	session_destroy();
	header("Location: ?");
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
