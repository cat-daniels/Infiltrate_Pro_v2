<?php
if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST["submit"])) {
    
    $productCode = $_POST["ProductCode"];
    $rating = $_POST["rating"];
    $reviewText = $_POST["review_text"];

    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "infiltratepro";

    $conn = new mysqli($servername, $username, $password, $dbname);

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    $sql = "INSERT INTO product_reviews (product_id, rating, review_text, review_date) VALUES (?, ?, ?, NOW())";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("iis", $productCode, $rating, $reviewText);

    if ($stmt->execute()) {
        // Review added successfully, you can redirect the user to the product details page
        header("Location: leavereview.php?ProductCode=" . $productCode);
        exit;
    } else {
        // Error handling
        echo "Error: " . $stmt->error;
    }

    $stmt->close();
    $conn->close();
} else {
    // Handle invalid form submissions
    echo "Invalid request.";
}
