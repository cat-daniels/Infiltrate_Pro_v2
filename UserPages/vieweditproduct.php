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
if (isset($_GET['productCode'])) {
    $productCode = $_GET['productCode'];
    if (Checkaccesslevel() == 2) { 
        editProd($productCode);
        echo '<a href="manageProducts.php"><button type="button" class="btn btn-info">Go Back</button></a>';
        echo '<div class = "gap"></div>';
    } else {
        header("Location: ../Pages/homepage.php"); // Redirect if the access level is not 2 (Admin)
        exit();
    }
} else {
    // Redirect to homepage or display an error message if productCode is not found in the URL
    header("Location: ../Pages/homepage.php");
    exit();
}
?>

</body>

<?php include_once("../Components/footer.php"); ?>
</html>
