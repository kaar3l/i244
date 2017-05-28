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
	//Kasutajakontroll
	if(!empty($_SESSION['user'])){
		//On ilusti kasutajaga sees
	}else{
		header("location: kulud.php?page=login");
	};

	//Kuvab kuluread, mis on sisestatud
	echo "<p>Lehel on näha kõik väljaminekud vastavalt liikidele ja summa kokku.</p>";
	global $connection;
	$query = "SELECT * FROM `kulud`";
	$result= mysqli_query($connection, $query);
	if ($result->num_rows > 0) {
		echo "<table><tr>";
		echo "<th>Aeg</th>";
		echo "<th>Liik</th>";
		echo "<th>Summa</th>";
		echo "<th>Märkus</th>";
		$kokku=0;
  	while($row = $result->fetch_assoc()) {
			echo "<tr>";
			echo "<td>".$row["aeg"]."</td>";
			$liiginimi=tagasta_kululiik($row["liik"]);
			echo "<td>".$liiginimi."</td>";
			echo "<td>".$row["summa"]."</td>";
			$kokku=$kokku+$row["summa"];
			echo "<td>".$row["kommentaar"]."</td>";
			echo "</tr>";
 		}
		echo "</table>";
		echo "<table><tr>";
		echo "<th>Kokku:</th>";
		echo "<th>$kokku</th>";
	} else {
 		echo "Pole kuluridu sisestatud";
	}
	echo "</tr></table>";
	v2ljastasummad();
	$connection->close();
}

function lisa_kulurida(){
	//Kasutajakontroll
	if(!empty($_SESSION['user'])){
		//On ilusti kasutajaga sees
	}else{
		header("location: kulud.php?page=login");
	};

		//Lisab kuluridadesse ridu juurde vormi seest
		global $connection;

		include_once('views/reasisestus.html');

		if(empty($_POST['date']) and empty($_POST['liik']) and empty($_POST['summa'])) {

		} else {
			$kuupaev = mysqli_real_escape_string($connection,$_POST['date']);
			$liik = mysqli_real_escape_string($connection,$_POST['liik']);
			//koma sisestamisel vahetame punkti vastu
			$summapunktiga=str_replace(',', '.', $_POST['summa']);
			$summa = mysqli_real_escape_string($connection,$summapunktiga);
			$m2rkus = mysqli_real_escape_string($connection,$_POST['m2rkus']);
			$sql = "INSERT INTO `kulutused`.`kulud` (aeg, liik, summa, kommentaar) VALUES ('$kuupaev', $liik, $summa, '$m2rkus')";
			if (mysqli_query($connection, $sql)) {
				echo "Uus rida lisatud edukalt";
				header("location: kulud.php?page=kuluread");
			} else {
				echo "Error: " . $sql . "<br>" . mysqli_error($connection);
			}
			mysqli_close($conn);
		}
}

function lisa_kululiike(){
	//Kasutajakontroll
	if(!empty($_SESSION['user'])){
		//On ilusti kasutajaga sees
	}else{
		header("location: kulud.php?page=login");
	};
	
	//Lisab kululiike juurde
	//Näitab kululiigid
		global $connection;
		display_kululiigid();

		include_once('views/liigisisestus.html');

		if(empty($_POST['liik'])) {
			//Do nothing
		} else {
			$liik = mysqli_real_escape_string($connection,$_POST['liik']);
			$m2rkus = mysqli_real_escape_string($connection,$_POST['m2rkus']);
			$sql = "INSERT INTO `kulutused`.`kululiigid` (liik, kommentaar) VALUES ('$liik', '$m2rkus')";
			echo $_POST['liik'];
			echo "<br>";
			echo $_POST['m2rkus'];
			echo "<br>";
			if (mysqli_query($connection, $sql)) {
				echo "Uus rida lisatud edukalt";
				header("location: kulud.php?page=lisaliike");
			} else {
				echo "Error: " . $sql . "<br>" . mysqli_error($connection);
			}
			mysqli_close($conn);
		}
}

function display_kululiigid(){
	global $connection;
	$query = "SELECT * FROM `kululiigid`";
	$result= mysqli_query($connection, $query);
	if ($result->num_rows > 0) {
		echo "<table><tr>";
		echo "<th>Liik</th>";
		echo "<th>Märkus</th>";
  		while($row = $result->fetch_assoc()) {
			echo "<tr>";
			echo "<td>".$row["liik"]."</td>";
			echo "<td>".$row["kommentaar"]."</td>";
			echo "</tr>";
 		}
	} else {
 		echo "Pole kululiike sisestatud";
	}
	echo "</tr></table>";
}

function display_kululiigivalik(){
	global $connection;
	$query = "SELECT * FROM `kululiigid`";
	$result= mysqli_query($connection, $query);
	if ($result->num_rows > 0) {
		  echo ("<select name='liik'>");
  		while($row = $result->fetch_assoc()) {
				echo $row["liik"];
				echo "<option value=".$row["id"].">".$row["liik"]."</option>";
 			}
			echo ("</select>");
			return ($kululiik);
	} else {
 			return ("Sisesta kululiik");
	}
}


function tagasta_kululiik($id){
	global $connection;
	$query = "SELECT * FROM `kululiigid` WHERE id=$id";
	$result= mysqli_query($connection, $query);
	if ($result->num_rows > 0) {
  	while($row = $result->fetch_assoc()) {
			return $row["liik"];
		}
	} else {
 		return ("error");
	}
}

function logi(){
	global $connection;
	$username = mysqli_real_escape_string($connection,$_POST['user']);
	$password = mysqli_real_escape_string($connection,$_POST['pass']);
	$sql = "SELECT id FROM `kulutused`.`kasutajad` WHERE `user` = '$username' AND `pass`=SHA1('$password')";
	$sql2= "SELECT admin FROM `kulutused`.`kasutajad` WHERE `user` = '$username' AND `pass`=SHA1('$password')";
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
		if($row2["admin"] ==1){
			$_SESSION['admin'] = 1;
			echo "Oled admin";
		}
		header("location: kulud.php?page=kuluread");
	}else {
		//echo "Kasutajanimi või parool on vale. Palun proovi uuesti!";
	}
	echo "<br>";
	echo $row;
	echo "<br>";
	echo $row2["roll"];
	echo "<br>";
	echo $_SESSION['user'];
	echo "<br>";
	echo $_SESSION['roll'];

	include_once('views/login.html');
}

function logout(){
	$_SESSION=array();
	session_destroy();
	header("Location: ?");
}

function v2ljastasummad(){
	//vväljastab summad kulullikide kaupa
	global $connection;
	$query = "SELECT liik, SUM(summa) FROM kulud GROUP BY liik";
	$result= mysqli_query($connection, $query);
	if ($result->num_rows > 0) {

		echo "<table><tr>";
  	while($row = $result->fetch_assoc()) {
			$now_id=tagasta_kululiik($row["liik"]);
			$now_sum=$row["SUM(summa)"];

			$data[$now_id][1]=$now_id;
			$data[$now_id][2]=$now_sum;

			echo "<tr>";
			echo "<td>$now_id</td>";
			echo "<td>$now_sum</td>";
			echo "</tr>";
		}
		echo "</table>";
		echo "<br>";

		generate_piechart($data);

	} else {
 		echo ("error");
	}
}


function generate_piechart($input){
	//Võtab inputiks maatriksi ja genereerib jsi piecharti
	include_once('views/piechart.html');
}



















/*
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
/*
?>
