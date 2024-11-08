<?php
include 'db_connect.php'; // Ensure this file is in the same directory

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $first_name = $_POST["first_name"];
    $last_name = $_POST["last_name"];
    $email = $_POST["email"];
    $phone_number = $_POST["phone_number"];
    $passport_no = $_POST["passport_no"];
    $date_of_birth = $_POST["date_of_birth"];

    // Prepared statement for safety and to prevent SQL injection
    $stmt = $conn->prepare("INSERT INTO Passengers (first_name, last_name, email, phone_number, passport_no, date_of_birth) 
                            VALUES (?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("ssssss", $first_name, $last_name, $email, $phone_number, $passport_no, $date_of_birth);

    if ($stmt->execute()) {
        echo "New passenger created successfully!";
    } else {
        echo "Error: " . $stmt->error;
    }

    $stmt->close();
} else {
    echo "Invalid request method.";
}

$conn->close();
?>
