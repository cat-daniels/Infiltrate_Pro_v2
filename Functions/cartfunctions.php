<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

include_once("../Utils/database.php");
include_once("../Utils/sessionconfig.php");

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

        return number_format($totalPrice, 2); // Format total price to 2 decimal places
    }

    return '0.00'; // Return 0.00 if user not logged in or no items in cart
}
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
                // Bind parameters
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
            $cartContent = '<table>';
            $cartContent .= '<tr><th>Product Code</th><th>Product Name</th><th>Quantity</th><th>Price</th><th>Total Price</th><th>Action</th></tr>';

            while ($row = $result->fetch_assoc()) {
                $cartContent .= "<tr>";
                $cartContent .= "<td>{$row['productCode']}</td>";
                $cartContent .= "<td>{$row['productName']}</td>";
                $cartContent .= "<td><input type='number' min='1' value='{$row['quantity']}' id='quantity_{$row['productCode']}'></td>";
                $cartContent .= "<td>{$row['price']}</td>";
                $cartContent .= "<td>{$row['totalPrice']}</td>";
                $cartContent .= "<td><button onclick='updateCartItem({$userID}, {$row['productCode']})'>Update</button>";
                $cartContent .= "<button onclick='removeFromCart({$userID}, {$row['productCode']})'>Remove</button></td>";
                $cartContent .= "</tr>";
            }

            $cartContent .= '</table>';
            echo $cartContent;
        } else {
            echo "Cart is empty.";
        }

        $stmt->close();
        $conn->close();
    } else {
        echo "User not logged in.";
    }
}

// come back to this part
function updateCartItem($userID, $productCode, $newQuantity) {
    $conn = connectdb();

    // Update the quantity in the cart
    $sql_update = "UPDATE cart SET quantity = ? WHERE userID = ? AND productCode = ?";
    $stmt_update = $conn->prepare($sql_update);
    $stmt_update->bind_param("iii", $newQuantity, $userID, $productCode);
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

// Function to remove an item from the cart
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
