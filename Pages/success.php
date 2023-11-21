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
    thank you for ordering! will put success message here.
</body>
<?php include_once("../Components/footer.php"); ?>
</html>
