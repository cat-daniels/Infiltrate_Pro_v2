<?php

function displayproductincard(){
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "infiltratepro"; 

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$sql = "SELECT * FROM products WHERE Featured = 1";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    $productsCounter = 0;

    while ($row = $result->fetch_assoc()) {
        if ($productsCounter % 4 === 0) {
            // Start a new row for every 4 products
            echo '<div class="row">';
        }

        echo '<div class="col-md-3">';
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
        echo '<a href="viewmore.php?ProductCode=' . $row['ProductCode'] . '" class="btn btn-primary">View More</a>';
        echo '<a href="../auth/login.php" class="btn btn-secondary">Add to Cart</a>';
        echo '</div>';
        echo '</div>';
        echo '</div>';

        $productsCounter++;

        if ($productsCounter % 4 === 0) {
            // Close the row after every 4 products
            echo '</div>';
        }
    }

    // Close the last row if it's not already closed
    if ($productsCounter % 4 !== 0) {
        echo '</div>';
    }
} else {
    echo "No products found.";
}

$conn->close();}
?>