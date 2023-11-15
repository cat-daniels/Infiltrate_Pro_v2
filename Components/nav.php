<!DOCTYPE html>
<html>
<head>
</head>
<body>
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
        <a href="../Pages/Shop.php"><button class="btn btn-info my-2 my-sm-0" id="NavButton">Shop</button></a>
      </li>
      <li class="nav-item">
      <a href="../Pages/Categories.php"><button class="btn btn-info my-2 my-sm-0" id="NavButton">Categories</button></a>
        <!-- Add dropdown here -->
      </li>
      
      <li class="nav-item">
      <a href="../Pages/Contact.php"><button class="btn btn-info my-2 my-sm-0" id="NavButton">Contact us</button></a>
      </li>
    </ul>

    <div class="cart-icon">
      <a href="../Pages/login.php" class="navbar-brand">
        <img src="../images/Vector.png" width="32" height="32" alt="Cart">
        <span class="badge">0</span>
        <span class="displaytext">$0.00</span>
      </a>
    </div>
    <!-- In order to get the correct path we put the main page in default so that it could be accessed by the default nav with ../ -->
    <a class="flex-sm-fill text-sm-right" href="../Pages/login.php"><button class="btn btn-info my-2 my-sm-0" id="NavButton">Login</button></a>
    <a class="flex-sm-fill text-sm-right" href="../Pages/register.php"><button class="btn btn-success my-2 my-sm-0" id="NavButton">Register</button></a>
  </div>
</nav>
</html>
