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
            
    
        echo '<div class="row" id="rowset">'; // Start the initial row
    
        while ($row = $result->fetch_assoc()) {
            if ($productsCounter % 4 === 0 && $productsCounter !== 0) {
                echo '</div>'; // Close row
                echo '<div class="row" id="rowset">'; // Start a new row for every 4 products
            }
    
            echo '<div class="col-md-3">';
            echo '<div class="card mb-5" style="border-radius: 15px; box-shadow: 0 4px 8px 0 rgba(0,0,0,0.2); padding: 5px;">';
            echo '<div class="image-container" style="height: 200px; overflow: hidden; display: flex; justify-content: center; align-items: center;">'; 
            echo '<img src="' . ($row['Image'] ? '../images/' . $row['Image'] : 'placeholder_image.jpg') . '" class="card-img-top" alt="' . $row['ProductName'] . '" style="width: 80%; height: auto; object-fit: cover;">'; 
            echo '</div>';          
             echo '<div class="card-body">';
            echo '<h5 class="card-title">' . $row['ProductName'] . '</h5>';
            echo '<p class="card-text">Price: $' . $row['Price'] . '</p>';
            echo '<p class="card-text">Description: ' . $row['Description'] . '</p>';

            // View More and Add to Cart buttons aligned horizontally
            echo '<div class="d-flex justify-content-between">';
            echo '<a href="viewmore.php?ProductCode=' . $row['ProductCode'] . '" class="btn btn-primary" style="
            height: fit-content">View More</a>';
    
            echo '<form method="post" action="" style="margin-left: auto; display: flex;">'; // Apply flexbox style for form alignment
            if (sessioncheck() == true) {
                echo '<input type="hidden" name="productCode" value="' . $row['ProductCode'] . '">';
                echo '<input type="hidden" name="productName" value="' . $row['ProductName'] . '">';
                echo '<input type="hidden" name="productPrice" value="' . $row['Price'] . '">';
                echo '<input type="hidden" name="addToCart" value="true">';
                echo '<button type="submit" name="addToCartBtn" class="btn btn-secondary" style="width: 100%;">Add to Cart</button>'; // Apply width: 100%
            } else {
                echo '<a href="../Pages/login.php" class="btn btn-secondary" style="width: 100%;">Add to Cart</a>'; // Apply width: 100%
            }
            echo '</form>';
            echo '</div>'; // Close d-flex

            echo '<div class="product-reviews">';
            displayReviewsForProduct($row['ProductCode']); // Display product reviews
            echo '</div>';
    
            echo '</div>'; // Close card-body
            echo '</div>'; // Close card
            echo '</div>'; // Close col-md-3
    
            $productsCounter++;
    
            if ($productsCounter % 4 === 0) {
                echo '</div>'; // Close row after every 4 products
            }
        }
    
        if ($productsCounter % 4 !== 0) {
            echo '</div>'; // Close row if the last row is incomplete
        }
    } else {
        echo "No products found.";
    }

}

//------------Categories------------------------
function displayCategory($selectedCategory) {
    $conn = connectdb();

    // Fetch all products
    $sql = "SELECT * FROM products";
    $result = $conn->query($sql);

    if ($result === false) {
        die("Error: Unable to fetch products");
    }

    $products = [];
    while ($row = $result->fetch_assoc()) {
        $categories = explode(", ", $row['Category']);
        if (in_array($selectedCategory, $categories)) {
            $products[] = $row;
        }
    }

    if (count($products) > 0) {
        echo '<div class="row">';
        $productsCounter = 0;

        foreach ($products as $product) {
            if ($productsCounter % 4 === 0 && $productsCounter !== 0) {
                echo '</div><div class="row">';
            }

            echo '<div class="col-md-3">';
            echo '<div class="card mb-4" style="border-radius: 15px; box-shadow: 0 4px 8px 0 rgba(0,0,0,0.2); padding: 5px;">';
            echo '<div class="image-container" style="height: 200px; overflow: hidden; display: flex; justify-content: center; align-items: center;">';
            echo '<img src="' . ($product['Image'] ? '../images/' . $product['Image'] : 'placeholder_image.jpg') . '" class="card-img-top" alt="' . $product['ProductName'] . '" style="width: 80%; height: auto; object-fit: cover;">';
            echo '</div>';
            echo '<div class="card-body">';
            echo '<h5 class="card-title">' . $product['ProductName'] . '</h5>';
            echo '<p class="card-text">Price: $' . $product['Price'] . '</p>';
            echo '<p class="card-text">Description: ' . $product['Description'] . '</p>';

           
            echo '<div class="d-flex justify-content-between">';
            echo '<a href="viewmore.php?ProductCode=' . $product['ProductCode'] . '" class="btn btn-primary" style="height: fit-content">View More</a>';

            echo '<form method="post" action="" style="margin-left: auto; display: flex;">';
            if (sessioncheck() == true) {
                echo '<input type="hidden" name="productCode" value="' . $product['ProductCode'] . '">';
                echo '<input type="hidden" name="productName" value="' . $product['ProductName'] . '">';
                echo '<input type="hidden" name="productPrice" value="' . $product['Price'] . '">';
                echo '<input type="hidden" name="addToCart" value="true">';
                echo '<button type="submit" name="addToCartBtn" class="btn btn-secondary" style="width: 100%;">Add to Cart</button>';
            } else {
                echo '<a href="../Pages/login.php" class="btn btn-secondary" style="width: 100%;">Add to Cart</a>';
            }
            echo '</form>';
            echo '</div>'; // Close d-flex

            echo '<div class="product-reviews">';
            displayReviewsForProduct($product['ProductCode']); // Display product reviews
            echo '</div>';

            echo '</div>'; // Close card-body
            echo '</div>'; // Close card
            echo '</div>'; // Close col-md-3

            $productsCounter++;
        }

        echo '</div>'; // Close the last row if the number of products isn't a multiple of 4
    } else {
        echo "No products found.";
    }

    $conn->close();
}

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
        echo "<td><a href='deleteprod.php?productCode={$prod['ProductCode']}' class='btn btn-danger'>delete</a></td>";
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

                        <div class="form-group">
                            <label>Keywords</label><br>';
    // Display checkboxes for keywords
    foreach ($keywords as $keyword) {
        echo '<div class="form-check form-check-inline">
                <input class="form-check-input" type="checkbox" name="keywords[]" value="' . $keyword . '">
                <label class="form-check-label">' . $keyword . '</label>
              </div>';
    }
    echo '</div>

                        <div class="form-group">
                            <label>Categories</label><br>';
    // Display checkboxes for categories
    foreach ($categories as $category) {
        echo '<div class="form-check form-check-inline">
                <input class="form-check-input" type="checkbox" name="categories[]" value="' . $category . '">
                <label class="form-check-label">' . $category . '</label>
              </div>';
    }
    echo '</div>

                        <button type="submit" class="btn btn-primary">Add Product</button>
                    </form>
                </div>
            </div>
        </div>
    </div>';

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        // Retrieve form data
        $productName = $_POST['productName'];
        $price = $_POST['price'];
        $description = $_POST['description'];
        $featured = $_POST['featured'];

        // Check if file was uploaded without errors
        if (isset($_FILES['imageFile']) && $_FILES['imageFile']['error'] === UPLOAD_ERR_OK) {
            $imageTempPath = $_FILES['imageFile']['tmp_name'];
            $imagePath = '../images/' . basename($_FILES['imageFile']['name']);

            // Move uploaded file to the target directory
            if (move_uploaded_file($imageTempPath, $imagePath)) {
                // Handle checkboxes for keywords
            $selectedKeywords = $_POST['keywords'] ?? array();
            $selectedKeywords = array_filter($selectedKeywords, function ($key) use ($keywords) {
                return in_array($key, $keywords);
                 });

            $keywordsString = implode(", ", $selectedKeywords);

            $selectedCategories = $_POST['categories'] ?? array();
            $selectedCategories = array_filter($selectedCategories, function ($category) use ($categories) {
                return in_array($category, $categories);
                });

                $categoryString = implode(", ", $selectedCategories);

                // Insert product information into 'products' table
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

                echo '<div class="alert alert-success" role="alert">
                Product added successfully
              </div>';

                $stmt->close();
            } else {
                echo "Error: Failed to move the uploaded file to the destination directory";
            }
        } else {
            echo "Error: No file uploaded or an error occurred during file upload";
        }

        $conn->close();
    }
}

function editProd($productCode) {
    $conn = connectdb();

    $sql = "SELECT * FROM products WHERE ProductCode=?";
    $stmt = $conn->prepare($sql);

    if ($stmt === false) {
        die("Error: Unable to prepare the SQL statement");
    }

    $result = $stmt->bind_param("s", $productCode);

    if ($result === false) {
        die("Error: Unable to bind parameters");
    }

    $executeResult = $stmt->execute();

    if ($executeResult === false) {
        die("Error: Unable to execute the SQL statement");
    }

    $productData = $stmt->get_result()->fetch_assoc();

    if (!$productData) {
        die("Error: Product not found");
    }

    // Display the retrieved product information form
    echo '
    <!-- Form for editing product details -->
    <form id="editProductForm" method="POST" enctype="multipart/form-data">
        <div class="form-group">
            <label for="productName">Product Name</label>
            <input type="text" class="form-control" id="productName" name="productName" value="' . $productData['ProductName'] . '" required>
        </div>

        <div class="form-group">
            <label for="price">Price</label>
            <input type="number" class="form-control" id="price" name="price" step="0.01" value="' . $productData['Price'] . '" required>
        </div>

        <div class="form-group">
            <label for="description">Description</label>
            <textarea class="form-control" id="description" name="description" rows="3" required>' . $productData['Description'] . '</textarea>
        </div>

        <div class="form-group">
            <label for="featured">Featured</label>
            <select class="form-control" id="featured" name="featured" required>
                <option value="1" ' . ($productData['Featured'] == 1 ? 'selected' : '') . '>Yes</option>
                <option value="0" ' . ($productData['Featured'] == 0 ? 'selected' : '') . '>No</option>
            </select>
        </div>

        <div class="form-group">
            <label for="imageFile">Upload Image</label>
            <input type="file" class="form-control-file" id="imageFile" name="imageFile" accept="image/*">
        </div>

        <div class="form-group">
            <label for="keywords">Keywords</label><br>';

    // Keywords checkbox creation based on existing values
    $keywords = explode(", ", $productData['Keywords']);
    $existingKeywords = ['Electronics', 'Clothing', 'Books', 'Accessories']; 
    foreach ($existingKeywords as $keyword) {
        $isChecked = in_array($keyword, $keywords) ? 'checked' : '';
        echo '<input type="checkbox" name="keywords[]" value="' . $keyword . '" ' . $isChecked . '> ' . $keyword . '<br>';
    }

    echo '</div>

        <div class="form-group">
            <label for="category">Category</label><br>';

    // Categories checkbox creation based on existing values
    $categories = explode(", ", $productData['Category']);
    $existingCategories = ['Tech', 'Fashion', 'Literature', 'Miscellaneous']; // Sample categories
    foreach ($existingCategories as $category) {
        $isChecked = in_array($category, $categories) ? 'checked' : '';
        echo '<input type="checkbox" name="category[]" value="' . $category . '" ' . $isChecked . '> ' . $category . '<br>';
    }

    echo '</div>
        <input type="hidden" name="productCode" value="' . $productCode . '">
        <button type="submit" class="btn btn-success" name="updateProduct">Update Product</button>
    </form>';
    $stmt->close();
    $conn->close();
    
    // Handling POST request for updating product details
    if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['updateProduct'])) {
        $conn = connectdb();

        $productName = $_POST['productName'];
        $price = $_POST['price'];
        $description = $_POST['description'];
        $featured = $_POST['featured'];
        $keywords = implode(", ", $_POST['keywords']);
        $categories = implode(", ", $_POST['category']);
        

        $sql = "UPDATE products SET ";
        $bindParams = array();
        $bindTypes = '';
        $comma = "";

        if (!empty($productName)) {
            $sql .= "ProductName=?, ";
            $bindParams[] = $productName;
            $bindTypes .= 's';
        }

        if (!empty($price)) {
            $sql .= "Price=?, ";
            $bindParams[] = $price;
            $bindTypes .= 'd';
        }

        if (!empty($description)) {
            $sql .= "Description=?, ";
            $bindParams[] = $description;
            $bindTypes .= 's';
        }

        if (!empty($featured)) {
            $sql .= "Featured=?, ";
            $bindParams[] = $featured;
            $bindTypes .= 's';
        }

        if (!empty($keywords)) {
            $sql .= "Keywords=?, ";
            $bindParams[] = $keywords;
            $bindTypes .= 's';
        }

        if (!empty($categories)) {
            $sql .= "Category=?, ";
            $bindParams[] = $categories;
            $bindTypes .= 's';
        }

        // Remove the last comma and space
        $sql = rtrim($sql, ", ");

        // Add the WHERE condition
        $sql .= " WHERE ProductCode=?";
        $bindParams[] = $productCode;
        $bindTypes .= 's';

        $stmt = $conn->prepare($sql);

        if ($stmt === false) {
            die("Error: Unable to prepare the SQL statement");
        }

        // Bind parameters dynamically
        $stmt->bind_param($bindTypes, ...$bindParams);

        // Execute the statement
        $executeResult = $stmt->execute();

        if ($executeResult === false) {
            die("Error: Unable to execute the SQL statement");
        }

        echo '<div class="alert alert-success" role="alert">
                Product edited successfully
              </div>';

        $stmt->close();
        $conn->close();
    }
}

function deleteProd($productCode) {
    $conn = connectdb();

    $sql = "SELECT * FROM products WHERE ProductCode=?";
    $stmt = $conn->prepare($sql);

    if ($stmt === false) {
        die("Error: Unable to prepare the SQL statement");
    }

    $result = $stmt->bind_param("s", $productCode);

    if ($result === false) {
        die("Error: Unable to bind parameters");
    }

    $executeResult = $stmt->execute();

    if ($executeResult === false) {
        die("Error: Unable to execute the SQL statement");
    }

    $productData = $stmt->get_result()->fetch_assoc();

    if (!$productData) {
        die("Error: Product not found");
    }

    echo '<div>Are you sure you want to delete product: ' . $productData['ProductName'] . '?</div>';
    echo '<form method="POST">
            <input type="hidden" name="productCode" value="' . $productCode . '">
            <button type="submit" name="confirmDelete">Yes, Delete</button>
          </form>';

    if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['confirmDelete'])) {
        $sql = "DELETE FROM products WHERE ProductCode=?";
        $stmt = $conn->prepare($sql);

        if ($stmt === false) {
            die("Error: Unable to prepare the SQL statement");
        }

        $result = $stmt->bind_param("s", $productCode);

        if ($result === false) {
            die("Error: Unable to bind parameters");
        }

        $executeResult = $stmt->execute();

        if ($executeResult === false) {
            die("Error: Unable to execute the SQL statement");
        }

        echo "Product deleted successfully";

        $stmt->close();
    }

    $conn->close();
}


function getReviewsForProduct($productCode) {
   $conn = connectdb();

    $sql = "SELECT * FROM reviews WHERE productCode = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $productCode);
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
function displayReviewsForProduct($productCode) {
    $reviews = getReviewsForProduct($productCode);
    if (count($reviews) === 0) {
        echo '<div class="row">';
        echo '<div class="col text-center">';
        echo '<a href="leavereview.php?ProductCode=' . $productCode . '" class="btn btn-success btn-block">Leave a Review</a>';
        echo '</div>';
        echo '</div>';   } else {
        // Calculate the average rating
        $totalRating = 0;
        foreach ($reviews as $review) {
            $totalRating += $review['rating'];
        }
        $averageRating = $totalRating / count($reviews);
        echo '<div class="col text-center">';
        echo "Average Rating: " . number_format($averageRating, 1);// Show the average rating as a number with one decimal place
        echo '</div>'; 
        
        // Add a link to the reviews page
        echo '<div class="row">';
        echo '<div class="col text-center">';
        echo '<a href="leavereview.php?ProductCode=' . $productCode . '" class="btn btn-success btn-block">Leave a Review</a>';
        echo '</div>';
        echo '</div>';
        }
}
function displayAllReviewsForProduct($productCode) {
    $reviews = getReviewsForProduct($productCode);
    if (count($reviews) === 0) {
        echo "<h4 style='text-align: center; background-color: steelblue; color: white; padding: 5px; border-radius: 5px;'>Be the first to leave a review</h4>";

    } else {
        // Calculate the average rating
        $totalRating = 0;
        foreach ($reviews as $review) {
            $totalRating += $review['rating'];
        }
        $averageRating = $totalRating / count($reviews);
        echo "<h4 style='text-align: center; background-color: steelblue; color: white; padding: 5px; border-radius: 5px;'>Average Rating: " . number_format($averageRating, 1) . "</h4>";

        // Display each review
        foreach ($reviews as $review) {
            echo '<div class="review-container">';
            echo '<div class="review" style="background-color: #f5f5f5; box-shadow: 0px 2px 4px rgba(0, 0, 0, 0.1); padding: 20px; margin-bottom: 20px;">';
            echo "Rating: " . $review['rating'] . " Stars<br>";
            echo "Review: " . $review['review_text'] . "<br>";
            echo "Date: " . $review['review_date'] . "<br>";

            // Display small image with an anchor to enlarge
            echo '<a href="' . $review['image_path'] . '" class="fancybox" data-fancybox="review-gallery" data-caption="Review Image">';
            echo '<img src="' . $review['image_path'] . '" alt="Review Image" style="max-width: 100px; max-height: 100px; border-radius: 5px;">';
            echo '</a>';
            
            echo "</div></div>";
        }
    }
}





?>
