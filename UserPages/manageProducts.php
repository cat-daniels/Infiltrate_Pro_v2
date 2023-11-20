<html lang="en">
<?php
include_once("../public/header.php");
include_once("../Utils/database.php");
include_once("../Utils/sessionconfig.php");
//functions
include_once("../Functions/authfunctions.php");

displayNavbar();

include_once("../Functions/productfunctions.php");
?>
<body>

<?php
Checkaccesslevel();

if (Checkaccesslevel()==2){ 
    // this is for admin access only
    addProducts();
    getProducts();
}else{
    header("../Pages/homepage.php"); // if the access level is not 2 = Admin it will automatically take the user to homepage.php
}
?>
</body>

<?php include_once("../Components/footer.php"); ?>
</html>
