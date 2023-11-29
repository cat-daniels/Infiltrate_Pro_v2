<html lang="en">
<?php 
include_once("../Public/header.php");
include_once("../Components/nav.php");
include_once("../Components/items.php");
gap();
//Functions

include_once("../Functions/authfunctions.php");


// Check if the login form was submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST["email"]; // Capture user input for email
    $password = $_POST["password"]; // Capture user input for password

    // Call the LoginAccount function with user input
    $loginResult = LoginAccount($email, $password);

    // Handle potential error messages
    if ($loginResult !== null) {
        // Display error message if login failed
        echo '<p style="color: red;">' . $loginResult . '</p>';
    }
}
?>

<body>
    <div class="loginform">
        <form method="post" action="login.php">
            <div class="form-group">
                <label for="exampleInputEmail1">Email address</label>
                <input type="text" name="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter email">
                <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small>
            </div>
            <div class="form-group">
                <label for="exampleInputPassword1">Password</label>
                <input type="password" name="password" class="form-control" id="exampleInputPassword1" placeholder="Password">
            </div>
            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
        <a href="register.php"><button class="btn btn-outline-success" style="margin: 30px;">Register account instead</button></a>
    </div>
</body>

<?php include_once("../Components/footer.php"); ?>
</html>