<h1>Prindime esimeses puuris elavad loomad</h1>
<?php
$servername = "localhost";
$username = "root";
$password = "laptop";
$dbname = "test";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
echo "SELECT * FROM `loomaaed` WHERE cage=1";
echo "<br>";
$sql = "SELECT * FROM `loomaaed` WHERE cage=1";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // output data of each row
    while($row = $result->fetch_assoc()) {
        echo "id: " . $row["id"]. " - Name: " . $row["name"]. " " . $row["age"]. " " . $row["type"]. " " . $row["cage"]. "<br>";
    }
} else {
    echo "0 results";
}
$conn->close();
?>
