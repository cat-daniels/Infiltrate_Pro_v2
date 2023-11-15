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

if (Checkaccesslevel()==1){
   echo "logged in as user showing product user"; 
}elseif(Checkaccesslevel()==2){
    echo "logged in as Admin showing product Admin";
}else{
    header("../Pages/login.php");
}
?>
</body>

<?php include_once("../Components/footer.php"); ?>
</html>
