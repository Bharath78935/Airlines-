<?php
include 'db_connect.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $booking_id = $_POST["booking_id"];
    $ticket_number = $_POST["ticket_number"];
    $seat_class = $_POST["seat_class"];
    $seat_number = $_POST["seat_number"];
    $issued_date = $_POST["issued_date"];

    $sql = "INSERT INTO Tickets (booking_id, ticket_number, seat_class, seat_number, issued_date) 
            VALUES ('$booking_id', '$ticket_number', '$seat_class', '$seat_number', '$issued_date')";
    $conn->query($sql);
}

$result = $conn->query("SELECT * FROM Tickets");
?>
<link rel="stylesheet" href="style2.css"> <!-- Link to a CSS file for styling -->
<div>
    <a href="index.php" ><img  class = "home" src = "images/home.jpg" alt = "home">
    </a>
</div>
<h2>Manage Tickets</h2>
<form method="post" action="">
    <input type="number" name="booking_id" placeholder="Booking ID" required>
    <input type="text" name="ticket_number" placeholder="Ticket Number" required>
    <input type="text" name="seat_class" placeholder="Seat Class">
    <input type="text" name="seat_number" placeholder="Seat Number">
    <input type="datetime-local" name="issued_date" required>
    <button type="submit">Add Ticket</button>
</form>

<table border="1">
    <tr>
        <th>Ticket Number</th><th>Booking ID</th><th>Seat Class</th><th>Seat Number</th><th>Issued Date</th><th>Actions</th>
    </tr>
    <?php while($row = $result->fetch_assoc()): ?>
    <tr>
        <td><?= $row['ticket_number']; ?></td>
        <td><?= $row['booking_id']; ?></td>
        <td><?= $row['seat_class']; ?></td>
        <td><?= $row['seat_number']; ?></td>
        <td><?= $row['issued_date']; ?></td>
        <td>
            <a href="edit_ticket.php?id=<?= $row['ticket_id']; ?>">Edit</a>
            <a href="delete_ticket.php?id=<?= $row['ticket_id']; ?>">Delete</a>
        </td>
    </tr>
    <?php endwhile; ?>
</table>
