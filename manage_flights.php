<?php
include 'db_connect.php';

// Handle form submission for adding a flight
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $flight_number = $_POST["flight_number"];
    $departure_time = $_POST["departure_time"];
    $arrival_time = $_POST["arrival_time"];
    $origin = $_POST["origin"];
    $destination = $_POST["destination"];
    $plane_id = $_POST["plane_id"];
    $status = $_POST["status"];

    $sql = "INSERT INTO Flights (flight_number, departure_time, arrival_time, origin, destination, plane_id, status) 
            VALUES ('$flight_number', '$departure_time', '$arrival_time', '$origin', '$destination', '$plane_id', '$status')";
    $conn->query($sql);
}

// Display flights
$result = $conn->query("SELECT * FROM Flights");
?>
 <link rel="stylesheet" href="style2.css"> <!-- Link to a CSS file for styling -->
     <!-- Home Button -->
     <div>
            <a href="index.php" ><img  class = "home" src = "images/home.jpg" alt = "home">
            </a>
    </div>
<h2>Manage Flights</h2>
<form method="post" action="">
    <input type="text" name="flight_number" placeholder="Flight Number" required>
    <input type="datetime-local" name="departure_time" required>
    <input type="datetime-local" name="arrival_time" required>
    <input type="text" name="origin" placeholder="Origin" required>
    <input type="text" name="destination" placeholder="Destination" required>
    <input type="number" name="plane_id" placeholder="Plane ID" required>
    <select name="status">
        <option value="On Time">On Time</option>
        <option value="Delayed">Delayed</option>
        <option value="Cancelled">Cancelled</option>
    </select>
    <button type="submit">Add Flight</button>
</form>

<table border="1">
    <tr>
        <th>Flight Number</th><th>Departure</th><th>Arrival</th><th>Origin</th><th>Destination</th><th>Status</th><th>Actions</th>
    </tr>
    <?php while($row = $result->fetch_assoc()): ?>
    <tr>
        <td><?= $row['flight_number']; ?></td>
        <td><?= $row['departure_time']; ?></td>
        <td><?= $row['arrival_time']; ?></td>
        <td><?= $row['origin']; ?></td>
        <td><?= $row['destination']; ?></td>
        <td><?= $row['status']; ?></td>
        <td>
            <a href="edit_flight.php?id=<?= $row['flight_id']; ?>">Edit</a>
            <a href="delete_flight.php?id=<?= $row['flight_id']; ?>">Delete</a>
        </td>
    </tr>
    <?php endwhile; ?>
</table>
