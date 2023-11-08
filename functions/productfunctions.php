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

function displayproductincardloggedin() {
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
            
            // so that the user can add to cart testing
            echo '<form method="post" action="../functions/cartfunctions.php">';
            echo '<input type="hidden" name="productCode" value="' . $row['ProductCode'] . '">';
            echo '<input type="hidden" name="productName" value="' . $row['ProductName'] . '">';
            echo '<input type="hidden" name="productPrice" value="' . $row['Price'] . '">';
            echo '<input type="hidden" name="addToCart" value="true">'; // Specify that this form is for adding to the cart
            echo '<button type="submit" name="addToCart" class="btn btn-secondary">Add to Cart</button>';
            echo '</form>';
                    // Display product reviews
             echo '<div class="product-reviews">';
            displayReviewsForProduct($row['ProductCode']);

            echo '</div>';
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

    $conn->close();
}
function getReviewsForProduct($product_id) {
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "infiltratepro";

    $conn = new mysqli($servername, $username, $password, $dbname);

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    $sql = "SELECT * FROM product_reviews WHERE product_id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $product_id);
    $stmt->execute();

    $result = $stmt->get_result();
    $reviews = array();

    while ($row = $result->fetch_assoc()) {
        $reviews[] = $row;
    }

    $stmt->close();
    $conn->close();

    return $reviews;
}

function displayReviewsForProduct($product_id) {
    $reviews = getReviewsForProduct($product_id);

    if (count($reviews) === 0) {
        echo '<a href="leavereview.php?ProductCode=' . $product_id . '" class="btn btn-secondary">Leave a Review</a>';
    } else {
        // Calculate the average rating
        $totalRating = 0;
        foreach ($reviews as $review) {
            $totalRating += $review['rating'];
        }
        $averageRating = $totalRating / count($reviews);

        echo "Average Rating: " . number_format($averageRating, 1); // Show the average rating as a number with one decimal place
        echo "<br>";
        
        // Add a link to the reviews page
        echo '<a href="leavereview.php?ProductCode=' . $product_id . '"class="btn btn-success">See All Reviews</a>';
    }
}

function displayAllReviewsForProduct($product_id) {
    $reviews = getReviewsForProduct($product_id);

    if (count($reviews) === 0) {
        echo "Be the first to leave a review";
    } else {
        // Calculate the average rating
        $totalRating = 0;
        foreach ($reviews as $review) {
            $totalRating += $review['rating'];
        }
        $averageRating = $totalRating / count($reviews);

        echo "Average Rating: " . number_format($averageRating, 1); // Show the average rating as a number with one decimal place
        echo "<br><br>";
       
        //display each review
        foreach ($reviews as $review) {
            echo "Rating: " . $review['rating'] . " Stars<br>";
            echo "Review: " . $review['review_text'] . "<br>";
            echo "Date: " . $review['review_date'] . "<br>";
            echo "<hr>";
        }
    }
}


?>