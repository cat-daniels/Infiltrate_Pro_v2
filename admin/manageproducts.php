<?php 
include_once("../includes/adminnav.php");
include_once("../includes/header.php"); 

// functions
include_once("manageproductfunctions.php"); 
?>
<body>
    <?php 
    //button to add more products
    getProducts();
    ?>
</body>
<?php // footer 
include_once("../includes/footer.php") ?>