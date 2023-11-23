<html lang="en">
<?php
include_once("../public/header.php");
include_once("../Utils/database.php");
include_once("../Utils/sessionconfig.php");
include_once("../Components/items.php");

//functions
include_once("../Functions/authfunctions.php");
include_once("../Functions/countfunctions.php");

displayNavbar();

include_once("../Functions/productfunctions.php");
?>
<head>
<style>
        .card {
            border: 1px solid #ccc;
            padding: 20px;
            height: 200px;
            margin: 10px;
            width: 300px;
             display: flex;
            flex-direction: column;
            justify-content: center;
            text-align: center;
        }

        .Title {
            height: 80px;
            text-align: center;
        }
    </style>

</head>
<body>
<?php
$cartCount = getCartCount();
$orderCount = getOrderCount();
$prodCount = getProductCount();
$saleCount = getTotalSalesAmount();

topgap();
?>
<div class = "Title"><h1>Welcome Admin!</h1></div>
     <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-6 col-lg-4">
            <div class="card "style="color: white; background-color: #28a745;">
                    <h3>Orders</h3>
                    <h5>Total No of Orders: <?php echo $orderCount; ?></h5>
                </div>            </div>
            <div class="col-md-6 col-lg-3">
            <div class="card "style="color: white; background-color: #6c757d;">
                    <h3>Cart</h3>
                    <h5>Total No of Abandoned Carts: <?php echo $cartCount; ?></h5>
                </div>
            </div>
            <div class="w-100"></div>
            <div class="col-md-6 col-lg-4">
            <div class="card "style="color: white; background-color: #dc3545;">
                    <h3>Products</h3>
                    <h5>Total No of Products: <?php echo $prodCount; ?></h5>
                </div>
            </div>
            <div class="col-md-6 col-lg-3">
            <div class="card "style="color: white; background-color: #007bff;">
                    <h3>Sales</h3>
                    <h5>Total Sales Amount: <?php echo $saleCount; ?></h5>
                </div>
            </div>
        </div>
    </div>

</body>

<?php gap(); include_once("../Components/footer.php"); ?>
</html>
