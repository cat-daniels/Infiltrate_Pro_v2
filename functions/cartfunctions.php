<?php
error_reporting(E_ALL);
ini_set('display_errors', 'on');

session_start();

if (isset($_POST['addToCart'])) {
    $productCode = $_POST['productCode'];
    $productName = $_POST['productName'];
    $productPrice = $_POST['productPrice'];

    if (!isset($_SESSION['cart'])) {
        $_SESSION['cart'] = array();
    }

    // Check if the product is already in the cart, and if so, update the quantity
    $found = false;
    foreach ($_SESSION['cart'] as &$cartItem) {
        if ($cartItem['productCode'] === $productCode) {
            $cartItem['quantity'] += 1; // You can modify this logic to handle quantity
            $found = true;
            break;
        }
    }

    // If the product is not in the cart, add it
    if (!$found) {
        $_SESSION['cart'][] = array(
            'productCode' => $productCode,
            'productName' => $productName,
            'productPrice' => $productPrice,
            'quantity' => 1
        );
    }

    header("Location: ../users/userdashboard.php");
    exit;
}


?>
