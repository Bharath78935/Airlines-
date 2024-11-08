<?php
include 'db_connect.php';

$passenger_id = $_POST["passenger_id"];

$sql = "DELETE FROM Passengers WHERE passenger_id=$passenger_id";

if ($conn->query($sql) === TRUE) {
    echo "Record deleted successfully";
} else {
    echo "Error deleting record: " . $conn->error;
}

$conn->close();
?>
