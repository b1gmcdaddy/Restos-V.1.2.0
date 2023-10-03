<?php
//connect to db
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "restos";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

//insertion
if (isset($_POST['type']) && isset($_POST['resto']) || isset($_POST['notes'])) {
    $type = $_POST['type'];
    $resto = $_POST['resto'];
    $notes = $_POST['notes'];

    $sql = "INSERT INTO places (meal_type, resto_name, resto_desc) VALUES ('$type', '$resto', '$notes')";

    if ($conn->query($sql) === TRUE) {
      header("Location: restos.php");
      exit;
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}
?>