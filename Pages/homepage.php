<html lang="en">
<?php
include_once("../public/header.php");
include_once("../Utils/database.php");
//functions
include_once("../Functions/authfunctions.php");

displayNavbar();

include_once("../Functions/productfunctions.php");
?>
<body>
<?php
displayProducts();
?>
</body>

<?php include_once("../Components/footer.php"); ?>
</html>
