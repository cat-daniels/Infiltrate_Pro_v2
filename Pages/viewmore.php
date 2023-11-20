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
// This will grab the product code from the url check the db and display that product
if (isset($_GET['ProductCode'])) {
    $productCode = $_GET['ProductCode'];

    $conn = connectdb();

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

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
</body>

<?php include_once("../Components/footer.php"); ?>
</html>
