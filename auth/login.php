
<?php
include_once("../includes/header.php");
include_once("../includes/nav.php");
include_once("../includes/footer.php");


?>
<!DOCTYPE html>
<html>
<head>
  <link rel="stylesheet" href="../style/style.css">
</head>
<body>
  <div class="loginform">
<form>
  <div class="form-group">
    <label for="exampleInputEmail1">Email address</label>
    <input type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter email">
    <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small>
  </div>
  <div class="form-group">
    <label for="exampleInputPassword1">Password</label>
    <input type="password" class="form-control" id="exampleInputPassword1" placeholder="Password">
  </div>
    <button type="submit" class="btn btn-primary">Submit</button>
</form>
<a href="register.php"><button class="btn btn-outline-success" style = "margin: 30px;">Register account instead</button></a>
</div>
</body>
</html>