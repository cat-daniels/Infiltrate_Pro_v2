<!DOCTYPE html>
<html>
<head>
</head>
<body>
<?php
include_once("../Functions/cartfunctions.php")
?>

<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarTogglerDemo03"
    aria-controls="navbarTogglerDemo03" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
  <a class="navbar-brand" href="../Pages/homepage.php">
    <img src="../images/logo.png" width="250" height="65" class="d-inline-block align-top" alt="">
  </a>

  <div class="collapse navbar-collapse" id="navbarTogglerDemo03">
    <ul class="navbar-nav mr-auto mt-2 mt-lg-0">
      <li class="nav-item">
        <a href="../Pages/helpdashboard.php"><button class="btn btn-success my-2 my-sm-0" id="NavButton">Infiltrate Help</button></a>
      </li>
      <li class="nav-item">
        <a href="../Pages/homepage.php"><button class="btn btn-info my-2 my-sm-0" id="NavButton">Shop</button></a>
      </li>
      <li class="nav-item dropdown">
    <div class="dropdown">
        <button class="btn btn-info my-2 my-sm-0 dropdown-toggle" type="button" id="navbarDropdown" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            Categories
        </button>
        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
            <a class="dropdown-item" href="../Pages/Categories.php?category=Tech">Tech</a>
            <a class="dropdown-item" href="../Pages/Categories.php?category=Fashion">Fashion</a>
            <a class="dropdown-item" href="../Pages/Categories.php?category=Literature">Literature</a>
            <a class="dropdown-item" href="../Pages/Categories.php?category=Miscellaneous">Miscellaneous</a>
            <!-- Add more categories here if needed -->
        </div>
</li>
      
      <li class="nav-item">
      <a href="../Pages/Contact.php"><button class="btn btn-info my-2 my-sm-0" id="NavButton">Contact us</button></a>
      </li>
      <li class="nav-item">
      <a href="../UserPages/manageOrders.php"><button class="btn btn-info my-2 my-sm-0" id="NavButton">Orders</button></a>
      </li>

      <li class="nav-item">
      <a href="../Dashboards/userdashboard.php"><button class="btn btn-info my-2 my-sm-0" id="NavButton">My Account</button></a>
      </li>

    </ul>

    <div class="cart-icon">
      <a href="../Pages/cart.php" class="navbar-brand">
        <img src="../images/Vector.png" width="32" height="32" alt="Cart">
        <span class="badge"><?php echo getTotalItemsInCart(); ?></span>
        <span class="displaytext">$<?php echo getTotalPriceOfCart(); ?></span>
    </a>
      </a>
    </div>
    <!-- In order to get the correct path we put the main page in default so that it could be accessed by the default nav with ../ -->
    <a href="../Functions/authfunctions.php?logout=true" class="btn btn-danger my-2 my-sm-0" id="NavButton">Logout</a>


</nav>
</html>
