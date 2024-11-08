<?php
include 'db_connect.php';

$sql = "SELECT * FROM Passengers";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    echo "<table><tr><th>ID</th><th>Name</th><th>Email</th><th>Phone</th></tr>";
    while($row = $result->fetch_assoc()) {
        echo "<tr><td>".$row["passenger_id"]."</td><td>".$row["first_name"]." ".$row["last_name"]."</td><td>".$row["email"]."</td><td>".$row["phone_number"]."</td></tr>";
    }
    echo "</table>";
} else {
    echo "0 results";
}
$conn->close();
?>
