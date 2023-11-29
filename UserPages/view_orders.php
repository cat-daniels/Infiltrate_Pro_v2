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
Checkaccesslevel();
if (isset($_GET['orderId'])) {
    $orderId = $_GET['orderId'];
if (Checkaccesslevel()==1){
    displayOrderDetails($orderId);
}elseif(Checkaccesslevel()==2){
    displayOrderDetails($orderId);
}else{
    header("../Pages/login.php");
}}

?>
<div class = "gap"></div>
</body>

<?php include_once("../Components/footer.php"); ?>
</html>
