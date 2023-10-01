<?php 
include_once("includes/header.php");
include_once("includes/nav.php");
include_once("includes/footer.php");

?> 

<!DOCTYPE html>
<html lang="en">
<body>
<?php
// Connection works but images don't temp file will delete when better structure is found

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "infiltratepro"; 

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$sql = "SELECT * FROM productdb";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        echo "<div>";
        echo "<h2>" . $row["prodName"] . "</h2>";
        echo "<p>Price: $" . $row["prodPrice"] . "</p>";
        echo "<p>Description: " . $row["prodDesc"] . "</p>";
        echo "<p>Keywords: " . $row["keywords"] . "</p>";
        echo "<p>Categories: " . $row["categories"] . "</p>";
        echo "<p>Featured: " . ($row["isFeatured"] ? "Yes" : "No") . "</p>";

        // Display the image if available
        if (!empty($row["prodImage"])) {
            $imageData = base64_encode($row["prodImage"]);
            echo '<img src="data:image/jpeg;base64,' . $imageData . '" alt="Product Image">';
        } else {
            echo "No image available";
        }

        echo "</div>";
    }
} else {
    echo "No products found.";
}

$conn->close();
?>
</body>
</html>