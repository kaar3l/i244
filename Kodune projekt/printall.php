<h1>Prindime tabeli sisu</h1>
<?php
$servername = "localhost";
$username = "root";
$password = "laptop";
$dbname = "kulutused";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 

$sql = "SELECT * FROM `kulud`";
//$sql = "SELECT id, name, age, type, cage";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // output data of each row
    while($row = $result->fetch_assoc()) {
        echo "id: " . $row["id"]. " - Aeg: " . $row["aeg"]. " " . $row["liik"]. " " . $row["summa"]. " " . $row["kommentaar"]. "<br>";
    }
} else {
    echo "0 results";
}
$conn->close();
?>