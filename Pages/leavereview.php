<html lang="en">
<?php
include_once("../public/header.php");
include_once("../Utils/database.php");
include_once("../Utils/sessionconfig.php");
//functions
include_once("../Functions/authfunctions.php");

displayNavbar();

include_once("../Functions/productfunctions.php");
?>
<body>

<?php
if (isset($_GET['ProductCode'])) {
    $productCode = $_GET['ProductCode'];
  
    $conn = connectdb();
    $sql = 'SELECT * FROM products WHERE ProductCode = ?';
    $stmt = $conn->prepare($sql);
    if ($stmt) {
        $stmt->bind_param("s", $productCode);
        $stmt->execute();
        $result = $stmt->get_result();
        if ($result) {
            if ($result->num_rows > 0) {
                $row = $result->fetch_assoc();
                
                echo '<div class="container">';
                echo '<div class="row">';
                echo '<div class="col-md-6">';
                echo '<div class="product-image">';
                echo '<img src="' . $row['Image'] . '" alt="' . $row['ProductName'] . '">';
                echo '<div class="small-images">';
                echo '</div>';
                echo '<button class="btn btn-primary" >Add to Cart</button>';
                echo '<button class="btn btn-secondary">See Reviews</button>';
                echo '</div>';
                echo '</div>';
                echo '<div class="col-md-6">';
                echo '<div class="product-details">';
                echo '<h2>' . $row['ProductName'] . '</h2>';
                echo '<p>Price: $' . $row['Price'] . '</p>';
                echo '<p>Description: ' . $row['Description'] . '</p>';
                // Display more details here
                echo '</div>';
                echo '</div>';
                echo '</div>';
                
                displayAllReviewsForProduct($productCode);
            } else {
                echo "Product not found.";
            }
        } else {
            echo "Error: " . $conn->error;
        }
        $stmt->close();
    } else {
        echo "Error in prepared statement: " . $conn->error;
    }
    $conn->close();
} else {
    echo "Product Code not provided.";
}
?>
<form method="post" action="processreview.php">
    <label for="rating">Rating:</label>
    <select name="rating">
        <option value="1">1 Star</option>
        <option value="2">2 Stars</option>
        <option value="3">3 Stars</option>
        <option value="4">4 Stars</option>
        <option value="5">5 Stars</option>
    </select>
    <br>
    <label for="review_text">Review:</label>
    <textarea name="review_text" rows="4" cols="50" required></textarea>
    <br>
    <input type="hidden" name="ProductCode" value="<?php echo $_GET['ProductCode']; ?>">
    <input type="submit" name="submit" value="Submit Review">
</form>
</body>
<?php
echo "<br>";
echo '<a href="viewmore.php?ProductCode=' . $productCode . '"class="btn btn-success">go back</a>';
echo "<div class='gap'></div>";
?>
<?php include_once("../Components/footer.php"); ?>
</html>
