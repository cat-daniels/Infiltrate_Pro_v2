<?php
include_once("../Utils/database.php");
include_once("../Utils/sessionconfig.php");
include_once("cartfunctions.php");
error_reporting(E_ALL);
ini_set('display_errors', 1);

function displayProducts() {
    sessioncheck();
    $conn = connectdb();

    $sql = "SELECT * FROM products WHERE Featured = 1";
    $result = $conn->query($sql);

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
    if ($result->num_rows > 0) {
        $productsCounter = 0;

        while ($row = $result->fetch_assoc()) {
            if ($productsCounter % 4 === 0) {
                // Start a new row for every 4 products
                echo '<div class="row1" id = "rowset">';
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


//------------Categories------------------------
//------------Admin Product Functions---------

function getProducts(){
    $conn = connectdb();
    $sql = "SELECT * FROM products";
    $result = $conn->query($sql);
    $prodArray = array(); // Create an array to store prod data this is so we can display it in a table :)

    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $prodArray[] = $row; // Add each prod data to the array
        }
    } else {
        echo "No products found.";
    }

    // Close the database connection
    $conn->close();

    // Display the user data using the displayUsers function
    displayprodTable($prodArray);

};
function displayprodTable($prodArray){      
    echo '<table class="table table-striped">';
    echo '<thead>';
    echo '<tr>';
    echo '<th>Product Code</th>';
    echo '<th>Product Name</th>';
    echo '<th>Price</th>';
    echo '<th>Keywords</th>';
    echo '<th>Categories</th>';
    echo '<th>Featured</th>';
    echo '<th>View</th>';
    echo '<th>Delete</th>';
    echo '</tr>';
    echo '</thead>';
    echo '<tbody>';

    foreach ($prodArray as $prod) {
        echo "<tr>";
        echo "<td>{$prod['ProductCode']}</td>";
        echo "<td>{$prod['ProductName']}</td>";
        echo "<td>{$prod['Price']}</td>";
        echo "<td>{$prod['Keywords']}</td>";
        echo "<td>{$prod['Category']}</td>";
        echo "<td>{$prod['Featured']}</td>";
        
        echo "<td><a href='vieweditproduct.php?productCode={$prod['ProductCode']}' class='btn btn-info'>View</a></td>";
        echo "<td><button class='btn btn-danger' onclick='deleteprod(\"{$prod['ProductCode']}\")'>Delete</button></td>";
        echo "</tr>";
    }
    echo '</tbody>';
    echo '</table>';
}

function addProducts() {

    $conn = connectdb();
    // Static definition of keywords and categories
    $keywords = array("Electronics", "Clothing", "Books", "Accessories");
    $categories = array("Tech", "Fashion", "Literature", "Miscellaneous");

    echo '
    <!-- Button to trigger modal -->
    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#addProductModal">
        Add New Product
    </button>
    
    <!-- Modal -->
    <div class="modal fade" id="addProductModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Add New Product</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <!-- Form for adding a new product -->
                    <form id="addProductForm" method="POST" enctype="multipart/form-data">
                        <div class="form-group">
                            <label for="productName">Product Name</label>
                            <input type="text" class="form-control" id="productName" name="productName" required>
                        </div>
    
                        <div class="form-group">
                            <label for="price">Price</label>
                            <input type="number" class="form-control" id="price" name="price" step="0.01" required>
                        </div>
    
                        <div class="form-group">
                            <label for="description">Description</label>
                            <textarea class="form-control" id="description" name="description" rows="3" required></textarea>
                        </div>
    
                        <div class="form-group">
                            <label for="featured">Featured</label>
                            <select class="form-control" id="featured" name="featured" required>
                                <option value="1">Yes</option>
                                <option value="0">No</option>
                            </select>
                        </div>
    
                        <div class="form-group">
                            <label for="imageFile">Upload Image</label>
                            <input type="file" class="form-control-file" id="imageFile" name="imageFile" accept="image/*" required>
                        </div>
    

                        
    
                        <button type="submit" class="btn btn-primary">Add Product</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
    </script>
    ';
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        // Retrieve form data
        $productName = $_POST['productName'];
        $price = $_POST['price'];
        $description = $_POST['description'];
        $featured = $_POST['featured']; 
        $imagePath = '../images/' . basename($_FILES['imageFile']['name']);
        
        // Check if the file was uploaded successfully
        if (move_uploaded_file($_FILES['imageFile']['tmp_name'], $imagePath)) {
            // Insert product information into 'products' table
            $conn = connectdb();
            $conn = connectdb();

            $keywordsString = implode(", ", $keywords);
            $categoryString = implode(", ", $categories);
    
            $sql = "INSERT INTO products (ProductName, Price, Description, Keywords, Category, Featured, Image) VALUES (?, ?, ?, ?, ?, ?, ?)";
            $stmt = $conn->prepare($sql);
    
            if ($stmt === false) {
                die("Error: Unable to prepare the SQL statement");
            }
    
            $result = $stmt->bind_param("sdsssis", $productName, $price, $description, $keywordsString, $categoryString, $featured, $imagePath);
    
            if ($result === false) {
                die("Error: Unable to bind parameters");
            }
    
            $executeResult = $stmt->execute();
    
            if ($executeResult === false) {
                die("Error: Unable to execute the SQL statement");
            }
    
            echo "Product added successfully";
    
            $stmt->close();
            $conn->close();
        } else {
            die("Error: Failed to move the uploaded file. Please try again.");
        }
    }
}
?>
