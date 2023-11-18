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
  <a href="checkout.php" class="btn btn-success my-2 my-sm-0" id="NavButton">Checkout Items</a>

</body>

<?php include_once("../Components/footer.php"); ?>
</html>
