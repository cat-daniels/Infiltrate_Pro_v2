<html lang="en">
<?php 
include_once("../Public/header.php");
include_once("../Components/nav.php");

//Functions

include_once("../Functions/authfunctions.php");



// Check if the registration form was submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Call the RegisterAccount function
    $registration_result = RegisterAccount();

    // Handle potential error messages
    if ($registration_result !== null) {
        // Display error message if registration failed
        echo '<p style="color: red;">' . $registration_result . '</p>';
    }
}
?> 

<body>
    <div class="loginform">
        <form method="post" action="register.php">
            <div class="form-group">
                <label for="fname">First Name</label>
                <input type="text" class="form-control" id="fname" name="fname">
            </div>
            <div class="form-group">
                <label for="lname">Last Name</label>
                <input type="text" class="form-control" id="lname" name="lname"  >
            </div>
            <div class="form-group">
                <label for="email">Email address</label>
                <input type="email" class="form-control" id="email" name="email"  >
            </div>
            <div class="form-group">
                <label for="password">Password</label>
                <input type="password" class="form-control" id="password" name="password"  >
            </div>
            <button type="submit" class="btn btn-primary" style="margin-left: 20%; padding: 10px; margin-top:5px; margin-bottom: 10px;">Register Account</button>
        </form>
        <a href="login.php"><button class="btn btn-outline-success" style="margin-left: 24%;">Login Instead</button></a>
    </div>
</body>

<?php include_once("../Components/footer.php"); ?>
</html>