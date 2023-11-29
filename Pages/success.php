<html lang="en">
<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

include_once("../public/header.php");
include_once("../Utils/database.php");
include_once("../Utils/sessionconfig.php");
//functions
include_once("../Functions/authfunctions.php");

displayNavbar();

include_once("../Functions/productfunctions.php");
include_once("../Functions/checkoutfunctions.php");
include_once("../Functions/orderfunctions.php");

?>
<body>
<div class="container mt-5">
  <div class="card">
    <div class="card-body">
      <p>Thank you for ordering! Your order has been processed!</p>
      <p>your order will now show in the orders Tab call us if you have any issues</p>
    </div>
  </div>
</div>
</body>
<?php include_once("../Components/footer.php"); ?>
</html>
