<?php
include 'db_connect.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $passenger_id = $_POST["passenger_id"];
    $flight_id = $_POST["flight_id"];
    $booking_date = $_POST["booking_date"];
    $payment_id = $_POST["payment_id"];
    $seat_number = $_POST["seat_number"];
    $booking_status = $_POST["booking_status"];

    $sql = "INSERT INTO Bookings (passenger_id, flight_id, booking_date, payment_id, seat_number, booking_status) 
            VALUES ('$passenger_id', '$flight_id', '$booking_date', '$payment_id', '$seat_number', '$booking_status')";
    $conn->query($sql);
}

$result = $conn->query("SELECT * FROM Bookings");
?>
<link rel="stylesheet" href="style2.css"> <!-- Link to a CSS file for styling -->
<div>
    <a href="index.php" ><img  class = "home" src = "images/home.jpg" alt = "home">
    </a>
</div>
<h2>Manage Bookings</h2>
<form method="post" action="">
    <input type="number" name="passenger_id" placeholder="Passenger ID" required>
    <input type="number" name="flight_id" placeholder="Flight ID" required>
    <input type="datetime-local" name="booking_date" required>
    <input type="number" name="payment_id" placeholder="Payment ID">
    <input type="text" name="seat_number" placeholder="Seat Number">
    <select name="booking_status">
        <option value="Confirmed">Confirmed</option>
        <option value="Cancelled">Cancelled</option>
    </select>
    <button type="submit">Add Booking</button>
</form>

<table border="1">
    <tr>
        <th>Passenger ID</th><th>Flight ID</th><th>Booking Date</th><th>Seat Number</th><th>Status</th><th>Actions</th>
    </tr>
    <?php while($row = $result->fetch_assoc()): ?>
    <tr>
        <td><?= $row['passenger_id']; ?></td>
        <td><?= $row['flight_id']; ?></td>
        <td><?= $row['booking_date']; ?></td>
        <td><?= $row['seat_number']; ?></td>
        <td><?= $row['booking_status']; ?></td>
        <td>
            <a href="edit_booking.php?id=<?= $row['booking_id']; ?>">Edit</a>
            <a href="delete_booking.php?id=<?= $row['booking_id']; ?>">Delete</a>
        </td>
    </tr>
    <?php endwhile; ?>
</table>
