<html lang="en">
<?php
include_once("../public/header.php");
include_once("../Utils/database.php");
include_once("../Utils/sessionconfig.php");
//functions
include_once("../Functions/authfunctions.php");
include_once("../Functions/orderfunctions.php");

displayNavbar();

include_once("../Functions/productfunctions.php");
?>
<body>
<?php
if (isset($_GET['category'])) {
    $selectedCategory = $_GET['category'];
    echo $selectedCategory;
    displayCategory($selectedCategory);
}

?>
<div class = "gap"></div>
</body>

<?php include_once("../Components/footer.php"); ?>
</html>
