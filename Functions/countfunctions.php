<?php
include_once("../Utils/database.php");

function getOrderCount() {
    $conn = connectdb();

    $sql = "SELECT COUNT(*) AS totalOrders FROM orders";
    $result = $conn->query($sql);

    $totalOrders = 0;
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $totalOrders = $row['totalOrders'];
    }

    $conn->close();

    return $totalOrders;
}

function getCartCount() {
    $conn = connectdb();

    $sql = "SELECT COUNT(*) AS cartCount FROM cart";
    $result = $conn->query($sql);

    $cartCount = 0;
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $cartCount = $row['cartCount'];
    }

    $conn->close();

    return $cartCount;
}

function getProductCount() {
    $conn = connectdb();

    $sql = "SELECT COUNT(*) AS totalProducts FROM products";
    $result = $conn->query($sql);

    $totalProducts = 0;
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $totalProducts = $row['totalProducts'];
    }

    $conn->close();

    return $totalProducts;
}

function getTotalSalesAmount() {
    $conn = connectdb();

    $sql = "SELECT SUM(totalAmount) AS totalSales FROM orders";
    $result = $conn->query($sql);

    $totalSales = 0.00;
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $totalSales = $row['totalSales'];
    }

    $conn->close();

    return number_format((float)$totalSales, 2);
}
?>
