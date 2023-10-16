<?php
//decided to seperate the functions and put in functionfile so that if I ever wanted to expand the application 
//it would be easier using a modular code.

//connect to the db
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST["email"];
    $password = $_POST["password"];
    
    // Database connection details
    $servername = "localhost";
    $username = "root";
    $db_password = "";
    $dbname = "infiltratepro"; 

    $conn = new mysqli($servername, $username, $db_password, $dbname);

    if ($conn->connect_error) {
        die("Database connection failed: " . $conn->connect_error);
    }

    $query = "SELECT * FROM users WHERE email = '$email' AND password = '$password'";
    $result = $conn->query($query);

    if ($result->num_rows == 1) {
        $user_data = $result->fetch_assoc();
        
        // Check if the user is an admin
        if ($user_data['isAdmin'] == true) {
            // If admin, redirect to admin dashboard
            $_SESSION["user_email"] = $email;
            header("Location: ../admin/admindashboard.php");
        } else {
            // If not admin, redirect to user dashboard
            $_SESSION["user_email"] = $email;
            header("Location: ../users/userdashboard.php");
        }

        exit();
    } else {
        $error_message = "Invalid email or password. Please try again.";
    }

    $conn->close();
}
?>