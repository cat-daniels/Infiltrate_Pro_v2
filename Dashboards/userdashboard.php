<html lang="en">
<?php
include_once("../public/header.php");
include_once("../Utils/database.php");
include_once("../Utils/sessionconfig.php");
//functions
include_once("../Functions/authfunctions.php");
include_once("../Functions/accountfunctions.php");

displayNavbar();

include_once("../Functions/productfunctions.php");
?>
<body>
<?php getUserAccount();?>
</body>

<?php include_once("../Components/footer.php"); ?>
</html>
