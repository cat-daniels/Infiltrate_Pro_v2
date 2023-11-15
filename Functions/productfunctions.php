<?php
include_once("../Utils/database.php");
include_once("../Utils/sessionconfig.php");

function displayProducts() {
    sessioncheck();
    $conn = connectdb();

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
            
            echo '<div class="d-flex justify-content-between">'; // Use Bootstrap's d-flex for flex container
            echo '<a href="viewmore.php?ProductCode=' . $row['ProductCode'] . '" class="btn btn-primary flex-grow-1">View More</a>';

            // Add to Cart button logic
            echo '<form class="d-flex flex-grow-1" method="post" action="">';
            if (sessioncheck() == true) {
                echo '<input type="hidden" name="productCode" value="' . $row['ProductCode'] . '">';
                echo '<input type="hidden" name="productName" value="' . $row['ProductName'] . '">';
                echo '<input type="hidden" name="productPrice" value="' . $row['Price'] . '">';
                echo '<input type="hidden" name="addToCart" value="true">';
                echo '<button type="submit" name="addToCartBtn" id="Navbutton" class="btn btn-secondary flex-grow-1">Add to Cart</button>';
            } else {
                echo '<a href="../Pages/login.php" id="Navbutton" class="btn btn-secondary flex-grow-1">Log in to Add to Cart</a>';
            }
            echo '</form>';
            echo '</div>'; // Close d-flex

            echo '</div>'; // Close card-body
            echo '</div>'; // Close card
            echo '</div>'; // Close col-md-3

            $productsCounter++;

            if ($productsCounter % 4 === 0) {
                // Close the row after every 4 products
                echo '</div>'; // Close row
            }
        }

        // Close the last row if it's not already closed
        if ($productsCounter % 4 !== 0) {
            echo '</div>'; // Close row
        }
    } else {
        echo "No products found.";
    }

    $conn->close();
}
?>
