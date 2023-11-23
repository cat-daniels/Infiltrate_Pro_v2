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
include_once("../Utils/database.php");
include_once("../Utils/sessionconfig.php");
include_once("../Functions/authfunctions.php");

if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST["submit"])) {
    $productCode = $_POST["ProductCode"];
    $rating = $_POST["rating"];
    $reviewText = $_POST["review_text"];

    $imagePath = null; // Initialize the imagePath variable

    if (isset($_FILES["review_image"]) && $_FILES["review_image"]["error"] === UPLOAD_ERR_OK) {
        $targetDir = "../customerimages/";
        $targetFile = $targetDir . uniqid() . '_' . basename($_FILES["review_image"]["name"]);

        // Handle image upload
        if (move_uploaded_file($_FILES["review_image"]["tmp_name"], $targetFile)) {
            $imagePath = $targetFile;
        } else {
            // Error handling for file upload failure
            echo "Sorry, there was an error uploading your file.";
        }
    }

    //IF no image is uploaded save to db wuthout an image
    $conn = connectdb();
    $sql = "INSERT INTO reviews (productCode, rating, review_text, image_path, review_date) VALUES (?, ?, ?, ?, NOW())";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("iiss", $productCode, $rating, $reviewText, $imagePath);

    if ($stmt->execute()) {
        header("Location: leavereview.php?ProductCode=" . $productCode);
        exit;
    } else {
        // Error handling
        echo "Error: " . $stmt->error;
    }

    $stmt->close();
    $conn->close();
} else {
    echo "Invalid request.";
}
?>

</body>

<?php include_once("../Components/footer.php"); ?>
</html>
