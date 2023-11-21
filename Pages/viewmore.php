<?php
include_once("../public/header.php");
include_once("../Utils/database.php");
include_once("../Utils/sessionconfig.php");
//functions
include_once("../Functions/authfunctions.php");

displayNavbar();

include_once("../Functions/productfunctions.php");
?>
<body class="bg-light">
<?php
// This will grab the product code from the url check the db and display that product
if (isset($_GET['ProductCode'])) {
    sessioncheck();
    $productCode = $_GET['ProductCode'];

    $conn = connectdb();

    $sql = 'SELECT * FROM products WHERE ProductCode = ?';
    $stmt = $conn->prepare($sql);

    
    if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['addToCartBtn'])) {
        // Retrieve data from the form
        $productCode = $_POST['productCode'];
        $productName = $_POST['productName'];
        $productPrice = $_POST['productPrice'];
        $quantity = 1; 
        $totalPrice = $productPrice * $quantity; // Calculate total price
    
        // Add the product to the cart
        $addedToCart = addToCart($productCode, $productName, $quantity, $productPrice, $totalPrice, $conn);
    
        // Check if the product was added successfully to the cart
        if ($addedToCart) {
            echo '<div class="alert alert-success" role="alert">Product added to cart successfully!</div>';
        } else {
            echo '<div class="alert alert-danger" role="alert">Failed to add product to cart. Please try again.</div>';
        }
    }
    if ($stmt) {
        $stmt->bind_param("s", $productCode);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result) {
            if ($result && $result->num_rows > 0) {
                $row = $result->fetch_assoc();
                // Display product details in a centered container
                echo '<div class="container mt-5">';
                echo '<div class="row justify-content-center">';
                echo '<div class="col-lg-8">';
                echo '<div class="product-details">';
                echo '<h2>' . $row['ProductName'] . '</h2>';
                echo '<img src="' . $row['Image'] . '" alt="' . $row['ProductName'] . '" class="img-fluid">';
                echo '<p>Price: $' . $row['Price'] . '</p>';
                echo '<p>Description: ' . $row['Description'] . '</p>';
                //Add to cart button and See reviews button
                echo '<div class="d-flex justify-content-between">';
                echo '<form method="post" action="">';
                if (sessioncheck() == true) {
                    echo '<input type="hidden" name="addToCart" value="true">';
                    echo '<button type="submit" name="addToCartBtn" id="addToCartBtn" class="btn btn-secondary">Add to Cart</button>';
                } else {
                    echo '<a href="../Pages/login.php" class="btn btn-secondary">Log in to Add to Cart</a>';
                }
                echo '</form>';
                echo '<a href="leavereview.php" class="btn btn-secondary">See Review</a>';
                echo '</div>'; // Close d-flex div
                echo '</div>'; // Close product-details div
                echo '</div>'; // Close col-lg-8 div
                echo '</div>'; // Close row div
                echo '</div>'; // Close container div
            } else {
                echo "Product not found.";
            }
        } else {
            echo "Error: " . $conn->error;
        }

        $stmt->close();
        $conn->close();
    } else {
        echo "Product Code not provided.";
    }}
    ?>

    <?php include_once("../Components/footer.php"); ?>

    <!-- Bootstrap JS scripts -->
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
