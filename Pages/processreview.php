<html lang="en">
<?php
include_once("../public/header.php");
include_once("../Utils/database.php");
include_once("../Utils/sessionconfig.php");
//functions
include_once("../Functions/authfunctions.php");

displayNavbar();

include_once("../Functions/productfunctions.php");
?>
<body>

<?php
if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST["submit"])) {
    
    $productCode = $_POST["ProductCode"];
    $rating = $_POST["rating"];
    $reviewText = $_POST["review_text"];
  
    $conn = connectdb();
    $sql = "INSERT INTO  reviews (productCode, rating, review_text, review_date) VALUES (?, ?, ?, NOW())";
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
?>

</body>

<?php include_once("../Components/footer.php"); ?>
</html>
