<html lang="en">
<?php
include_once("../public/header.php");
include_once("../Utils/database.php");
include_once("../Utils/sessionconfig.php");
//functions
include_once("../Functions/authfunctions.php");

displayNavbar();

include_once("../Functions/accountfunctions.php");
?>
<body>

<?php
if (isset($_GET['uid'])) {
    $uid = $_GET['uid'];
    if (Checkaccesslevel() == 2) { 
        deleteUser($uid);
    } else {
        header("Location: ../Pages/homepage.php"); // Redirect if the access level is not 2 (Admin)
        exit();
    }}
?>

</body>

<?php include_once("../Components/footer.php"); ?>
</html>