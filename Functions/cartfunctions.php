<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

include_once("../Utils/database.php");
include_once("../Utils/sessionconfig.php");

function getCartByUID($userID) {
    $conn = connectdb();

    $cartInfo = array();

    if ($userID) {
        $sql = "SELECT * FROM cart WHERE userID = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("i", $userID);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $cartInfo[] = $row; // Add cart item information to the array
            }
        }
        
        $stmt->close();
    }

    $conn->close();

    return $cartInfo;
}
// This is for the navbar so we can display the cartprice and qty on the navbar :D
// Function to get the total number of items in the cart
function getTotalItemsInCart() {
    $userID = isset($_SESSION['uid']) ? $_SESSION['uid'] : null;

    if ($userID) {
        $conn = connectdb();

        $sql = "SELECT SUM(quantity) AS totalItems FROM cart WHERE userID = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("i", $userID);
        $stmt->execute();
        $result = $stmt->get_result();

        $totalItems = 0;
        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            $totalItems = $row['totalItems'];
        }

        $stmt->close();
        $conn->close();

        return $totalItems;
    }

    return 0; // Return 0 if user not logged in or no items in cart
}

// Function to get the total price of items in the cart
function getTotalPriceOfCart() {
    $userID = isset($_SESSION['uid']) ? $_SESSION['uid'] : null;

    if ($userID) {
        $conn = connectdb();

        $sql = "SELECT SUM(totalPrice) AS totalPrice FROM cart WHERE userID = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("i", $userID);
        $stmt->execute();
        $result = $stmt->get_result();

        $totalPrice = 0.00;
        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            $totalPrice = $row['totalPrice'];
        }

        $stmt->close();
        $conn->close();

        if ($totalPrice !== null) {
            return number_format((float)$totalPrice, 2);
        } else {
            return '0.00'; // Return a default value if totalPrice is null
        }; // Return 0.00 if user not logged in or no items in cart - display on badge
}}
// Function to add products to the cart
function addToCart($productCode, $productName, $quantity, $productPrice, $totalPrice) {
    $userID = isset($_SESSION['uid']) ? $_SESSION['uid'] : null;

    if ($userID) {
        $conn = connectdb();

        // Check if the product is already in the cart for this user
        $sql_check = "SELECT * FROM cart WHERE userID = ? AND productCode = ?";
        $stmt_check = $conn->prepare($sql_check);
        $stmt_check->bind_param("is", $userID, $productCode);
        $stmt_check->execute();
        $result_check = $stmt_check->get_result();

        if ($result_check->num_rows > 0) {
            // Product is already in the cart, update the quantity and total price
            $row = $result_check->fetch_assoc();
            $newQuantity = $row['quantity'] + $quantity;
            $newTotalPrice = $newQuantity * $productPrice;

            // Update the quantity and total price in the cart
            $sql_update = "UPDATE cart SET quantity = ?, totalPrice = ? WHERE userID = ? AND productCode = ?";
            $stmt_update = $conn->prepare($sql_update);
            $stmt_update->bind_param("iidi", $newQuantity, $newTotalPrice, $userID, $productCode);
            $stmt_update->execute();

            if ($stmt_update->affected_rows > 0) {
                $stmt_update->close();
                $conn->close();
                return true; // Quantity and total price updated successfully
            } else {
                $stmt_update->close();
                $conn->close();
                return false; // Failed to update quantity and total price
            }
        } else {
            // Product is not in the cart, insert as a new item
            $newTotalPrice = $quantity * $productPrice;

            $sql_insert = "INSERT INTO cart (userID, productCode, productName, quantity, price, totalPrice) VALUES (?, ?, ?, ?, ?, ?)";
            $stmt_insert = $conn->prepare($sql_insert);

            if ($stmt_insert) {
                $stmt_insert->bind_param("isssdd", $userID, $productCode, $productName, $quantity, $productPrice, $newTotalPrice);
                $stmt_insert->execute();

                if ($stmt_insert->affected_rows > 0) {
                    $stmt_insert->close();
                    $conn->close();
                    return true; // Product added successfully to the cart
                } else {
                    $stmt_insert->close();
                    $conn->close();
                    return false; // Failed to add product
                }
            } else {
                echo "Error: " . $conn->error; // Print SQL error message for debugging
                $stmt_insert->close();
                $conn->close();
                return false; // Failed to prepare statement
            }
        }
    } else {
        return false; // User not logged in
    }
}
// for the updating of the cart functions

function displayCart() {
    sessioncheck();
    $userID = isset($_SESSION['uid']) ? $_SESSION['uid'] : null;

    if ($userID) {
        $conn = connectdb();

        // Retrieve cart items for the logged-in user
        $sql = "SELECT * FROM cart WHERE userID = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("i", $userID);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            $cartContent = '<table class="table table-striped" style = "text-align: center;">';
            $cartContent .= '<tr><th>Product Code</th><th>Product Name</th><th>Quantity</th><th>Price</th><th>Total Price</th><th>Action</th></tr>';

            while ($row = $result->fetch_assoc()) {
                $cartContent .= "<tr>";
                $cartContent .= "<td>{$row['productCode']}</td>";
                $cartContent .= "<td>{$row['productName']}</td>";
                $cartContent .= "<td>";
                $cartContent .= "<a class='plusminus' href='?action=update&userID={$userID}&productCode={$row['productCode']}&newQuantity=" . ($row['quantity'] + 1) . "'>+</a>";
                $cartContent .= "{$row['quantity']}"; // Display the quantity
                $cartContent .= "<a class='plusminus' href='?action=update&userID={$userID}&productCode={$row['productCode']}&newQuantity=" . ($row['quantity'] - 1) . "'>-</a>";
                $cartContent .= "</td>";
                $cartContent .= "<td>{$row['price']}</td>";
                $cartContent .= "<td>{$row['totalPrice']}</td>";
                $cartContent .= "<td>";
                $cartContent .= "<a href='?action=remove&userID={$userID}&productCode={$row['productCode']}' class='btn btn-danger'>Remove</a>";                $cartContent .= "</td>";
                $cartContent .= "</tr>";
            }

            $cartContent .= '</table>';
            echo $cartContent;

            if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET['action'])) {
                if ($_GET['action'] === 'update' && isset($_GET['newQuantity'])) {
                    $userID = $_GET['userID'];
                    $productCode = $_GET['productCode'];
                    $newQuantity = $_GET['newQuantity'];
                    updateCartItem($userID, $productCode, $newQuantity);
                    echo '<meta http-equiv="refresh" content="0;url=cart.php">';
                    exit;
                 }
            }
        } else {
            echo "Cart is empty.";
        }

        $stmt->close();
        $conn->close();
    } else {
        echo "User not logged in.";
    }
}


// come back to this part ***Done***
function updateCartItem($userID, $productCode, $newQuantity) {
    $conn = connectdb();

    // Get the product's price from the database
    $sql_price = "SELECT price FROM cart WHERE userID = ? AND productCode = ?";
    $stmt_price = $conn->prepare($sql_price);
    $stmt_price->bind_param("ii", $userID, $productCode);
    $stmt_price->execute();
    $result = $stmt_price->get_result();

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $productPrice = $row['price'];
        $newTotalPrice = $newQuantity * $productPrice;

        // Update the quantity and total price in the cart
        $sql_update = "UPDATE cart SET quantity = ?, totalPrice = ? WHERE userID = ? AND productCode = ?";
        $stmt_update = $conn->prepare($sql_update);
        $stmt_update->bind_param("diii", $newQuantity, $newTotalPrice, $userID, $productCode);
        $stmt_update->execute();

        if ($stmt_update->affected_rows > 0) {
            $stmt_update->close();
            $conn->close();
            return true; // Quantity updated successfully
        } else {
            $stmt_update->close();
            $conn->close();
            return false; // Failed to update quantity
        }
    }

    $conn->close();
    return false; // Product not found or error fetching price
}

// Function to remove an item from the cart **Note this will totally remove the item from the cart
function removeFromCart($userID, $productCode) {
    $conn = connectdb();

    // Remove the item from the cart
    $sql_remove = "DELETE FROM cart WHERE userID = ? AND productCode = ?";
    $stmt_remove = $conn->prepare($sql_remove);
    $stmt_remove->bind_param("ii", $userID, $productCode);
    $stmt_remove->execute();

    if ($stmt_remove->affected_rows > 0) {
        $stmt_remove->close();
        $conn->close();
        return true; // Item removed successfully
    } else {
        $stmt_remove->close();
        $conn->close();
        return false; // Failed to remove item
    }
}


?>
