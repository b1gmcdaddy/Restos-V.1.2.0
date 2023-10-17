<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "restos";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}


if (isset($_GET['id'])) {
    $restoId = $_GET['id'];

    $sql = "DELETE FROM places WHERE resto_id = $restoId";

    if ($conn->query($sql) === TRUE) {
        header("Location: index.php");
        exit;
    } else {
        echo "Error deleting record: " . $conn->error;
    }
}
// Close the database connection
$conn->close();
?>