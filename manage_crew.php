<?php
include 'db_connect.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $first_name = $_POST["first_name"];
    $last_name = $_POST["last_name"];
    $role = $_POST["role"];
    $flight_id = $_POST["flight_id"];

    $sql = "INSERT INTO Crew (first_name, last_name, role, flight_id) VALUES ('$first_name', '$last_name', '$role', '$flight_id')";
    $conn->query($sql);
}

$result = $conn->query("SELECT * FROM Crew");
?>
<link rel="stylesheet" href="style2.css"> <!-- Link to a CSS file for styling -->
<div>
    <a href="index.php" ><img  class = "home" src = "images/home.jpg" alt = "home">
    </a>
</div>
<h2>Manage Crew</h2>
<form method="post" action="">
    <input type="text" name="first_name" placeholder="First Name" required>
    <input type="text" name="last_name" placeholder="Last Name" required>
    <input type="text" name="role" placeholder="Role" required>
    <input type="number" name="flight_id" placeholder="Flight ID">
    <button type="submit">Add Crew</button>
</form>

<table border="1">
    <tr>
        <th>First Name</th><th>Last Name</th><th>Role</th><th>Flight ID</th><th>Actions</th>
    </tr>
    <?php while($row = $result->fetch_assoc()): ?>
    <tr>
        <td><?= $row['first_name']; ?></td>
        <td><?= $row['last_name']; ?></td>
        <td><?= $row['role']; ?></td>
        <td><?= $row['flight_id']; ?></td>
        <td>
            <a href="edit_crew.php?id=<?= $row['crew_id']; ?>">Edit</a>
            <a href="delete_crew.php?id=<?= $row['crew_id']; ?>">Delete</a>
        </td>
    </tr>
    <?php endwhile; ?>
</table>
