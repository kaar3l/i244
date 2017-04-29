 <!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <title>Siin saad lisada MySQL tabelisse sisu</title>
</head>
<body>
<div id="wrap">
    <h1>Siin saad lisada MySQL tabelisse sisu:</h1>

<form action="add.php" method="POST">

<table border="1" style="width:40%">
  <tr>
    <td><input type="text" name="inputId" value="id"/></td>
    <td><input type="text" name="inputName" value="name"/></td>
    <td><input type="text" name="inputAge" value="age"/></td>
    <td><input type="text" name="inputType" value="type"/></td>
    <td><input type="text" name="inputCage" value="cage"/></td>
  </tr>

</table>
<input type="submit" value="edasta"/>
</form>
</div>
<h1>Praegune tabelis sisu:</h1>
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

$sql = "SELECT * FROM `loomaaed`";
//$sql = "SELECT id, name, age, type, cage";
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

</body>
</html>
