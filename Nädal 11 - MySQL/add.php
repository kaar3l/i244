 <?php
$servername = "localhost";
$username = "root";
$password = "laptop";
$dbname = "test";

$Id=$_POST['inputId'];
echo "<br>";
echo $Id;
$Name=$_POST['inputName'];
echo "<br>";
echo $Name;
$Age=$_POST['inputAge'];
echo "<br>";
echo $Age;
$Type=$_POST['inputType'];
echo "<br>";
echo $Type;
$Cage=$_POST['inputCage'];
echo "<br>";
echo $Cage;
echo "<br><br>";
// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$sql = "INSERT INTO loomaaed (id, name, age, type, cage)
VALUES ($Id, '$Name', $Age, '$Type', $Cage);";
//$sql = "INSERT INTO loomaaed (id, name, age, type, cage)
//VALUES ($_POST['inputId'], '$_POST['inputName']', $_POST['inputAge'], '$_POST['inputType']', $_POST['inputCage']);";

if ($conn->multi_query($sql) === TRUE) {
    echo "New records created successfully";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

$conn->close();
?>
