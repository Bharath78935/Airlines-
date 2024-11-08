<?php
include 'db_connect.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Add new airport
    if (isset($_POST['add_airport'])) {
        $airport_code = $_POST['airport_code'];
        $airport_name = $_POST['airport_name'];
        $city = $_POST['city'];
        $country = $_POST['country'];

        // Check if the airport code already exists
        $checkSql = "SELECT * FROM airports WHERE airport_code = ?";
        $stmt = $conn->prepare($checkSql);
        $stmt->bind_param("s", $airport_code);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            echo "Error: Airport code '$airport_code' already exists. Please use a different code.";
        } else {
            // Prepare and bind
            $sql = "INSERT INTO airports (airport_code, airport_name, city, country) VALUES (?, ?, ?, ?)";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("ssss", $airport_code, $airport_name, $city, $country);
            
            if ($stmt->execute()) {
                echo "New airport added successfully.";
            } else {
                echo "Error adding airport: " . $stmt->error;
            }
        }

        $stmt->close(); // Close the statement
    }

    // Delete airport
    if (isset($_POST['delete_airport'])) {
        $airport_id = $_POST['airport_id'];

        if ($airport_id) {
            $sql = "DELETE FROM airports WHERE airport_code=?";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("s", $airport_id);
            if ($stmt->execute()) {
                echo "Airport deleted successfully.";
            } else {
                echo "Error deleting airport: " . $stmt->error;
            }
            $stmt->close();
        } else {
            echo "Airport ID is missing.";
        }
    }
}

// Fetch airports for display
$sql = "SELECT * FROM airports";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Airports</title>
    <link rel="stylesheet" href="style2.css"> <!-- Link to a CSS file for styling -->
    <script>
        function openUpdateModal(airportCode, airportName, city, country) {
            document.getElementById('modal-airport-code').value = airportCode;
            document.getElementById('modal-airport-name').value = airportName;
            document.getElementById('modal-city').value = city;
            document.getElementById('modal-country').value = country;
            document.getElementById('updateModal').style.display = 'block';
        }

        function closeUpdateModal() {
            document.getElementById('updateModal').style.display = 'none';
        }
    </script>
</head>
<body>

        <!-- Home Button -->
        <div>
            <a href="index.php" ><img  class = "home" src = "images/home.jpg" alt = "home">
            </a>
        </div>
    <h1>Manage Airports</h1>

    <!-- Table to display airports -->
    <table border="1">
        <tr>
            <th>Airport Code</th>
            <th>Airport Name</th>
            <th>City</th>
            <th>Country</th>
            <th>Actions</th>
        </tr>
        <?php while ($row = $result->fetch_assoc()): ?>
        <tr>
            <td><?php echo $row['airport_code']; ?></td>
            <td><?php echo $row['airport_name']; ?></td>
            <td><?php echo $row['city']; ?></td>
            <td><?php echo $row['country']; ?></td>
            <td>
                <form class = "del" action="manage_airports.php" method="post" style="display:inline;">
                    <input type="hidden" name="airport_id" value="<?php echo $row['airport_code']; ?>">
                    <button type="submit" name="delete_airport">Delete</button>
                </form>
                <button class = "edit" onclick="openUpdateModal('<?php echo $row['airport_code']; ?>', '<?php echo $row['airport_name']; ?>', '<?php echo $row['city']; ?>', '<?php echo $row['country']; ?>')">Update</button>
            </td>
        </tr>
        <?php endwhile; ?>
    </table>

    <!-- Form for adding a new airport -->
    <h1>Add New Airport</h1>
    <form action="manage_airports.php" method="post">
        <label for="airport_code">Airport Code:</label>
        <input type="text" name="airport_code" id="airport_code" required>
        <label for="airport_name">Airport Name:</label>
        <input type="text" name="airport_name" id="airport_name" required>
        <label for="city">City:</label>
        <input type="text" name="city" id="city" required>
        <label for="country">Country:</label>
        <input type="text" name="country" id="country" required>
        <button type="submit" name="add_airport">Add Airport</button>
    </form>

    <!-- Modal for updating airport -->
    <div id="updateModal" style="display:none; position:fixed; top: 50%; left: 50%; transform: translate(-50%, -50%); background: white; padding: 20px; border: 1px solid black;">
        <h2>Update Airport</h2>
        <form action="manage_airports.php" method="post">
            <input type="hidden" name="airport_id" id="modal-airport-code">
            <label for="modal-airport-name">Airport Name:</label>
            <input type="text" name="airport_name" id="modal-airport-name" required>
            <label for="modal-city">City:</label>
            <input type="text" name="city" id="modal-city" required>
            <label for="modal-country">Country:</label>
            <input type="text" name="country" id="modal-country" required>
            <button type="submit" name="update_airport">Update Airport</button>
            <button type="button" onclick="closeUpdateModal()">Cancel</button>
        </form>
    </div>
</body>
</html>