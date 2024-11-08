<?php
include 'db_connect.php';

$passenger_id = $_POST["passenger_id"];
$first_name = $_POST["first_name"];
$last_name = $_POST["last_name"];
$email = $_POST["email"];
$phone_number = $_POST["phone_number"];
$passport_no = $_POST["passport_no"];
$date_of_birth = $_POST["date_of_birth"];

$sql = "UPDATE Passengers SET 
        first_name='$first_name', 
        last_name='$last_name', 
        email='$email', 
        phone_number='$phone_number',
        passport_no='$passport_no',
        date_of_birth='$date_of_birth' 
        WHERE passenger_id=$passenger_id";

if ($conn->query($sql) === TRUE) {
    echo "Record updated successfully";
} else {
    echo "Error updating record: " . $conn->error;
}

$conn->close();
?>
