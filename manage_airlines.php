<?php
include 'db_connect.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['add'])) {
        $airline_name = $_POST['airline_name'];
        $sql = "INSERT INTO Airlines (airline_name) VALUES ('$airline_name')";
        $conn->query($sql);
    } elseif (isset($_POST['update'])) {
        $airline_id = $_POST['airline_id'];
        $airline_name = $_POST['airline_name'];
        $sql = "UPDATE Airlines SET airline_name='$airline_name' WHERE airline_id=$airline_id";
        $conn->query($sql);
    } elseif (isset($_POST['delete'])) {
        $airline_id = $_POST['airline_id'];
        $sql = "DELETE FROM Airlines WHERE airline_id=$airline_id";
        $conn->query($sql);
    
        // Reset AUTO_INCREMENT to the highest existing airline_id + 1
        $conn->query("ALTER TABLE Airlines AUTO_INCREMENT = 1");
    }
    
}

$result = $conn->query("SELECT * FROM Airlines");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Airlines</title>
    <link rel="stylesheet" href="style2.css">
    <script>
        function editAirline(id, name) {
            document.getElementById("airline_id").value = id;
            document.getElementById("airline_name").value = name;
        }
    </script>
</head>
<body>
    <div>
        <a href="index.php" ><img  class = "home" src = "images/home.jpg" alt = "home">
        </a>
    </div>
    <h2>Manage Airlines</h2>
    <form method="POST" action="manage_airlines.php">
        <input type="hidden" name="airline_id" id="airline_id">
        <label><b>Airline Name:</b></label>
        <input type="text" name="airline_name" id="airline_name" required>
        <br><br>
        <button type="submit" name="add">Add Airline</button>
        <button type="submit" name="update">Update Airline</button>
    </form>

    <h3>Current Airlines</h3>
    <table border="1">
        <tr>
            <th>ID</th>
            <th>Airline Name</th>
            <th>Actions</th>
        </tr>
        <?php while ($row = $result->fetch_assoc()): ?>
        <tr>
            <td><?= $row['airline_id'] ?></td>
            <td><?= $row['airline_name'] ?></td>
            <td>
                <!-- Edit button fills the form with the selected airline data -->
                <button type="button" class = "edit" onclick="editAirline('<?= $row['airline_id'] ?>', '<?= $row['airline_name'] ?>')">Edit</button>
                
                <!-- Delete button submits form with hidden airline_id -->
                <form class = "del" method="POST" action="manage_airlines.php" style="display:inline;">
                    <input type="hidden" name="airline_id" value="<?= $row['airline_id'] ?>">
                    <button type="submit" name="delete">Delete</button>
                </form>
            </td>
        </tr>
        <?php endwhile; ?>
    </table>
</body>
</html>
