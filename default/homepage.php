<!DOCTYPE html>
<html lang="en">
<?php 
include_once("../includes/header.php");
include_once("../includes/nav.php");
include_once("../includes/footer.php");
?>
<body>
<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "infiltratepro"; 

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$sql = "SELECT * FROM products";
$result = $conn->query($sql);

if ($result->num_rows > 0) {

    // going to put this into columns
    while ($row = $result->fetch_assoc()) {
        echo '<div class="card" style="width: 18rem;">';
        // Display the image if available
        if (!empty($row['Image'])) {
            $imagePath = '../images/' . $row['Image']; // Construct the full path
            echo '<img src="' . $imagePath . '" class="card-img-top" alt="' . $row['ProductName'] . '">';
        } else {
            echo '<img src="placeholder_image.jpg" class="card-img-top" alt="No Image">';
        }
        echo '<div class="card-body">';
        echo '<h5 class="card-title">' . $row['ProductName'] . '</h5>';
        echo '<p class="card-text">Price: $' . $row['Price'] . '</p>';
        echo '<p class="card-text">Description: ' . $row['Description'] . '</p>';
        echo '</div>';
        echo '</div>';
    }
} else {
    echo "No products found.";
}

$conn->close();
?>
</body>
</html>
