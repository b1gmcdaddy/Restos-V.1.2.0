<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "restos";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $restoId = $_POST["restoId"];
    $newRestoName = $_POST["editRestoName"];
    $newMealType = $_POST["editMealType"];
    $newRestoDesc = $_POST["editRestoDesc"];

    $sql = "UPDATE places SET resto_name = '$newRestoName', meal_type = '$newMealType', resto_desc = '$newRestoDesc' WHERE resto_id = $restoId";

    if ($conn->query($sql) === TRUE) {
        header("Location: restos.php"); 
        exit();
    } else {
        echo "Error updating record: " . $conn->error;
    }
}
?>