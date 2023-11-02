<?php
// Connect to the database (similar to your getproducts function)

if (isset($_GET['productCode'])) {
    $productCode = $_GET['productCode'];
    
    // Perform a query to fetch the product details based on $productCode
    $sql = "SELECT * FROM products WHERE ProductCode = '$productCode'";
    $result = $conn->query($sql);
    
    if ($result->num_rows == 1) {
        $product = $result->fetch_assoc(); // Fetch the product details
    } else {
        echo "Product not found.";
        // Handle the case when the product is not found.
    }
}

// Handle form submission to update the product details
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve and sanitize the edited product details from the form
    $newProductName = $_POST['newProductName'];
    $newPrice = $_POST['newPrice'];
    $newKeywords = $_POST['newKeywords'];
    $newCategory = $_POST['newCategory'];
    $newFeatured = $_POST['newFeatured'];
    
    // Perform an SQL query to update the product details
    $updateSql = "UPDATE products SET ProductName = '$newProductName', Price = '$newPrice', Keywords = '$newKeywords', Category = '$newCategory', Featured = '$newFeatured' WHERE ProductCode = '$productCode'";
    
    if ($conn->query($updateSql) === TRUE) {
        echo "Product details updated successfully.";
        // Redirect the user to the product view page or any other relevant page.
    } else {
        echo "Error updating product details: " . $conn->error;
    }
}

// Close the database connection
$conn->close();
?>

<!DOCTYPE html>
<html>
<head>
    <title>Edit Product</title>
</head>
<body>
    <!-- Create a form to edit the product details -->
    <form method="post" action="">
        <label for="newProductName">Product Name:</label>
        <input type="text" name="newProductName" value="<?php echo $product['ProductName']; ?>"><br>
        
        <label for="newPrice">Price:</label>
        <input type="text" name="newPrice" value="<?php echo $product['Price']; ?>"><br>
        
        <label for="newKeywords">Keywords:</label>
        <input type="text" name="newKeywords" value="<?php echo $product['Keywords']; ?>"><br>
        
        <label for="newCategory">Category:</label>
        <input type="text" name="newCategory" value="<?php echo $product['Category']; ?>"><br>
        
        <label for="newFeatured">Featured:</label>
        <input type="text" name="newFeatured" value="<?php echo $product['Featured']; ?>"><br>
        
        <input type="submit" value="Update Product">
    </form>
</body>
</html>
