<?php
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $fname = $_POST["fname"];
    $lname = $_POST["lname"];
    $email = $_POST["email"];
    $password = $_POST["password"];
    
    // Database connection details
    $servername = "localhost";
    $username = "root";
    $db_password = "";
    $dbname = "infiltratepro"; 

    $conn = new mysqli($servername, $username, $db_password, $dbname);

    if (!$conn) {
        die("Database connection failed: " . mysqli_connect_error());
    }
    
    $address = "Not yet added"; 
    $card_number = "Not yet added"; 
    $card_holder = "Not yet added";
    $expiration_date = "11/11";
    $cvv = "000";
    $isAdmin = 0; // 0 for regular user, 1 for admin *user through the registration process is always set to false

    $query = "INSERT INTO users (email, password, fname, lname, address, card_number, card_holder, expiration_date, cvv, isAdmin) VALUES ('$email', '$password', '$fname', '$lname', '$address', '$card_number', '$card_holder', '$expiration_date', '$cvv', $isAdmin)";
    if ($conn->query($query) === TRUE) {
        // Registration successful
        $_SESSION["user_email"] = $email;
        header("Location: ../users/userdashboard.php"); // Redirect to the dashboard page
        exit();
    } else {
        // Registration failed
        $error_message = "Registration failed. Please try again.";
    }

    mysqli_close($conn);
}
?>
