<html lang="en">
<?php
include_once("../public/header.php");
include_once("../Utils/database.php");
include_once("../Utils/sessionconfig.php");

// Ui elements:
include_once("../Components/items.php");
//functions
include_once("../Functions/authfunctions.php");
include_once("../Functions/orderfunctions.php");

displayNavbar();

include_once("../Functions/productfunctions.php");
?>
<body>   
<?php
topgap();
displayBanner();
divider();
if (isset($_GET['category'])) {
    $selectedCategory = $_GET['category'];
    displayCategory($selectedCategory);
}

gap();
?>

</body>

<?php include_once("../Components/footer.php"); ?>
</html>
