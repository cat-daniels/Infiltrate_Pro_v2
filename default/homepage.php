<?php 
include_once("../includes/header.php");
include_once("../includes/nav.php");
include_once("../includes/footer.php");

?> 

<!DOCTYPE html>
<html lang="en">
<body><?php
$hostname = "localhost";
$username = "root";
$password = "";
$database = "infiltratepro";

// Create a database connection
$conn = new mysqli($hostname, $username, $password, $database);

// Check the connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// SQL query to retrieve user data
$sql = "SELECT * FROM users";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // Output data of each row
    while ($row = $result->fetch_assoc()) {
        echo "UID: " . $row["uid"] . "<br>";
        echo "First Name: " . $row["fname"] . "<br>";
        echo "Last Name: " . $row["lname"] . "<br>";
        echo "Email: " . $row["email"] . "<br>";
        echo "Address: " . $row["address"] . "<br>";
        echo "Card Number: " . $row["card_number"] . "<br>";
        echo "Card Holder: " . $row["card_holder"] . "<br>";
        echo "Expiration Date: " . $row["expiration_date"] . "<br>";
        echo "CVV: " . $row["cvv"] . "<br>";
        echo "Is Admin: " . ($row["isAdmin"] ? "Yes" : "No") . "<br>";
        echo "<hr>";
    }
} else {
    echo "No users found.";
}

// Close the database connection
$conn->close();
?>
Make sure to replace "your_hostname", "your_username", "your_password", and "your_database" with your actual database credentials. This code connects to your MySQL database, retrieves user data from the users table, and displays it on the web page.

Please note that this is a basic example, and in a production environment, you should implement proper error handling, security measures, and potentially use a framework or an ORM for more robust database interactions. Additionally, you should not display sensitive user data like passwords or credit card information in a real application.





>?
</body>
</html>