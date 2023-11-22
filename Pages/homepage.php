<html lang="en">
<?php
include_once("../public/header.php");
include_once("../Utils/database.php");
include_once("../Utils/sessionconfig.php");
//functions
include_once("../Functions/authfunctions.php");
// Ui elements:
include_once("../Components/items.php");

displayNavbar();

include_once("../Functions/productfunctions.php");
?>
<body>
<?php
topgap();
displaySearchBar();
divider();
displayBanner();
divider();
displayProducts();
gap();
?>
</body>

<?php include_once("../Components/footer.php"); ?>
</html>
