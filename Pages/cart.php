<html lang="en">
<?php
include_once("../public/header.php");
include_once("../Utils/database.php");
include_once("../Utils/sessionconfig.php");
//functions
include_once("../Functions/authfunctions.php");

displayNavbar();

include_once("../Functions/productfunctions.php");
include_once("../Functions/cartfunctions.php");
?>
<body>
<?php
displayCart();
?>
</body>

<?php include_once("../Components/footer.php"); ?>
</html>
