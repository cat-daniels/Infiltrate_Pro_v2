<?php 
include_once("../includes/adminnav.php");
include_once("../includes/header.php"); 

// functions
include_once("manageuserfunctions.php"); 
?>
<body>
    <?php
    //button to add more users
    getUsers();
    ?>
</body>
<?php // footer 
include_once("../includes/footer.php") ?>