<html lang="en">
<?php
include_once("../public/header.php");
include_once("../Utils/database.php");
include_once("../Utils/sessionconfig.php");
//functions
include_once("../Functions/authfunctions.php");
include_once("../Components/items.php");
displayNavbar();

include_once("../Functions/productfunctions.php");
?>
<body>
<head>
    <!--This is for the zoomy box when you click on a picture might put in header idk-->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fancybox/3.5.7/jquery.fancybox.min.css" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/fancybox/3.5.7/jquery.fancybox.min.js"></script>

    <script>
        $(document).ready(function() {
            $('.fancybox').fancybox();
        });
    </script>
</head>
<div class="container">
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
            if ($result && $result->num_rows > 0) {
                $row = $result->fetch_assoc();

                echo '<div class="row">';
                echo '<div class="col-md-6">';
                echo '<div class="product-image">';
                echo '<img src="' . $row['Image'] . '" alt="' . $row['ProductName'] . '" class="img-fluid">';
                echo '<div class="small-images">';
                echo '</div>';
                echo '</div>';
                echo '</div>';
                echo '<div class="col-md-6">';
                echo '<div class="product-details">';
                echo '<h2>' . $row['ProductName'] . '</h2>';
                echo '<p>Price: $' . $row['Price'] . '</p>';
                echo '<p>Description: ' . $row['Description'] . '</p>';
                echo '<button class="btn btn-primary">Add to Cart</button>';
                divider();
                echo '<h4>Leave a Review</h4>';
                
                // Form for submitting reviews
                echo '<form method="post" action="processreview.php" enctype="multipart/form-data" style = "
                    background-color: #17a2b8;
                    padding: 5px;
                    color: white;
                    padding-left: 10px;
                ">';
                echo '<label for="rating">Rating:</label>';
                echo '<select name="rating">';
                echo '<option value="1">1 Star</option>';
                echo '<option value="2">2 Stars</option>';
                echo '<option value="3">3 Stars</option>';
                echo '<option value="4">4 Stars</option>';
                echo '<option value="5">5 Stars</option>';
                echo '</select>';
                echo '<br>';
                echo '<label for="review_text">Review:</label>';
                echo '<textarea name="review_text" rows="4" cols="50" required></textarea>';
                echo '<br>';
                echo '<label for="review_image">Upload Image:</label>';
                echo '<input type="file" name="review_image" id="review_image">';
                echo '<br>';
                echo '<input type="hidden" name="ProductCode" value="' . $productCode . '">';
                echo '<button type="submit" class="btn btn-success"><input type="submit" name="submit" value="Submit Review" style=""></button>';
                echo '</form>';
                echo '</div>';
                echo '</div>';
                echo '</div>';

            } else {
                echo "<div class='alert alert-danger' role='alert'>Product not found.</div>";
            }

            $stmt->close();
        } else {
            echo "<div class='alert alert-danger' role='alert'>Error in prepared statement: " . $conn->error . "</div>";
        }
        $conn->close();
    } else {
        echo "<div class='alert alert-warning' role='alert'>Product Code not provided.</div>";
    }
    ?>
    
    <?php
    echo "<br>";
    displayAllReviewsForProduct($productCode);
    echo "<div class='gap'></div>";
    ?>
</div>
</body>
<?php include_once("../Components/footer.php"); ?>
</html>
