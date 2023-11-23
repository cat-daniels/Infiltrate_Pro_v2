<html lang="en">
<?php
include_once("../public/header.php");
include_once("../Utils/database.php");
include_once("../Utils/sessionconfig.php");
//functions
include_once("../Functions/authfunctions.php");
include_once("../Functions/orderfunctions.php");
include_once("../Components/items.php");
displayNavbar();

include_once("../Functions/productfunctions.php");
?>
<body>
<?php
Checkaccesslevel();

if (Checkaccesslevel()==1){
    topgap();
    displayOrdersBySessionUID(); 
    gap();
}elseif(Checkaccesslevel()==2){
    displayAllOrders();
}else{
    header("../Pages/login.php");
}
?>
</body>

<?php include_once("../Components/footer.php"); ?>
</html>
