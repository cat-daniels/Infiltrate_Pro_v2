
<?php
include_once("../includes/header.php");
include_once("../includes/nav.php");


// functions
include_once("../functions/errormessages.php");
include_once("../functions/registerfunctions.php");
?>
<!DOCTYPE html>
<html>
<head>
  <link rel="stylesheet" href="../style/style.css">
</head>
<body>
    <div class = "loginform">
<form method="post" action="../functions/registerfunctions.php">
    <div class="form-group">
        <label for="fname">First Name</label>
        <input type="text" class="form-control" id="fname" name="fname" required>
    </div>
    <div class="form-group">
        <label for="lname">Last Name</label>
        <input type="text" class="form-control" id="lname" name="lname" required>
    </div>
    <div class="form-group">
        <label for="email">Email address</label>
        <input type="email" class="form-control" id="email" name="email" required>
    </div>
    <div class="form-group">
        <label for="password">Password</label>
        <input type="password" class="form-control" id="password" name="password" required>
    </div>
        <button type="submit" class="btn btn-primary" style = "margin-left: 20%; padding: 10px; margin-top:5px; margin-bottom: 10px;">Register Account</button>
</form>
<a href="login.php"><button class="btn btn-outline-success" style = "margin-left: 24%;">Login Instead</button></a>

</div>
</body>
</html>

<?php include_once("../includes/footer.php");?>