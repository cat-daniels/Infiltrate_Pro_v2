<?php
function createOrder($firstName, $lastName, $email, $address, $country, $postCode, $paymentMethod, $totalAmount, $cardHolder = null, $cardNumber = null, $expiry = null, $cvv = null) {
    $conn = connectdb();
    
    // Prepare SQL statement based on payment method
    if ($paymentMethod === 'credit_card') {
        $sql = "INSERT INTO Orders (orderNumber, firstName, lastName, email, address, country, postCode, paymentMethod, cardHolder, cardNumber, expiry, cvv, totalAmount)
                VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
        $orderNumber = generateOrderNumber(); // Generate a unique order number
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("sssssssssssd", $orderNumber, $firstName, $lastName, $email, $address, $country, $postCode, $paymentMethod, $cardHolder, $cardNumber, $expiry, $cvv, $totalAmount);
    } else { // Bank Transfer
        $sql = "INSERT INTO Orders (orderNumber, firstName, lastName, email, address, country, postCode, paymentMethod, totalAmount)
                VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)";
        $orderNumber = generateOrderNumber(); // Generate a unique order number
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ssssssssd", $orderNumber, $firstName, $lastName, $email, $address, $country, $postCode, $paymentMethod, $totalAmount);
    }

    // Execute the prepared statement
    $success = $stmt->execute();

    $stmt->close();
    $conn->close();

    return $success;
}
?>