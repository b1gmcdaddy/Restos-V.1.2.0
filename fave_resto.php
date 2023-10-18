<?php
include("config.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $restoId = $_POST["restoId"];
    
    $sql = "UPDATE places SET is_Fave = 'fave' WHERE resto_id = $restoId";
    if ($conn->query($sql) === TRUE) {
        echo "success";
    } else {
        echo "error";
    }
}