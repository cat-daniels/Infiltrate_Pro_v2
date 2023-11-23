<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

include_once("../Utils/database.php");
include_once("../Utils/sessionconfig.php");


function RegisterAccount(){
    

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $fname = $_POST["fname"];
        $lname = $_POST["lname"];
        $email = $_POST["email"];
        $password = $_POST["password"];

        $conn = connectdb(); // Connect db just returns the database connection we are assigning it to $Conn

        if ($conn) {
            $address = "Not yet added"; 
            $card_number = "Not yet added"; 
            $card_holder = "Not yet added";
            $expiration_date = "11/11";
            $cvv = "000";
            $isAdmin = 0;

            $query = "INSERT INTO users (email, password, fname, lname, address, card_number, card_holder, expiration_date, cvv, isAdmin) VALUES ('$email', '$password', '$fname', '$lname', '$address', '$card_number', '$card_holder', '$expiration_date', '$cvv', $isAdmin)";

            if ($conn->query($query) === TRUE) {
                // Registration successful
                $_SESSION["user_email"] = $email;
                header("Location: login.php"); // doesn't exist yet
                exit();
            } else {
                // Registration failed
                $error_message = "Registration failed. Please try again.";
                return $error_message;
            }

            // Close the database connection
            $conn->close();
        } else {
            // Connection failed
            $error_message = "Database connection failed. Please check your connection.";
            return $error_message;
        }
    }
};

function LoginAccount($email, $password) {
    
        $conn = connectdb();

        if($email == "' OR 1=1--" && $password == ""){
             // Malicious user
    $session_token = bin2hex(random_bytes(16)); 
    
    $_SESSION["session_token"] = $session_token;
    $_SESSION["uid"] = "1"; // Assuming '1' is the UID of the admin user
    
    // Update session token directly in the database for the admin user
    $update_query = "UPDATE users SET session_token = ? WHERE uid = ?";
    $stmt = $conn->prepare($update_query);
    $stmt->bind_param("si", $session_token, $_SESSION["uid"]);
    $stmt->execute();

    $_SESSION["isAdmin"] = true;
    $_SESSION["uid"] = $_SESSION["uid"];
    header("Location: ../Dashboards/admindashboard.php");
    exit();

        } else {
            $query = "SELECT * FROM users WHERE email = '$email' AND password = '$password'";
            $result = $conn->query($query);
    
            if ($result->num_rows == 1) {
                $user_data = $result->fetch_assoc();
    
                // Generate a unique session token
                $session_token = bin2hex(random_bytes(16)); 
    
                // Store the session token in the user's record in the database
                $uid = $user_data['uid'];
                $update_query = "UPDATE users SET session_token = '$session_token' WHERE uid = $uid";
                $conn->query($update_query);
    
                // Set session variables
                $_SESSION["session_token"] = $session_token;
                $_SESSION["uid"] = $uid;
    
                if ($user_data['isAdmin'] == true) {
                    $_SESSION["isAdmin"] = true;
                    $_SESSION["uid"] = $uid;
                    header("Location: ../Dashboards/admindashboard.php");
                    exit();
                } else {
                    $_SESSION["isAdmin"] = false;
                    $_SESSION["uid"] = $uid;
                    header("Location: ../Pages/homepage.php");
                    exit();
                }
            } else {
                $error_message = "Invalid email or password. Please try again.";
                return $error_message;
            }
        }
    
        $conn->close();
    }




if (isset($_GET['logout']) && $_GET['logout'] == 'true') {
    logout();
}

function logout() {
    // Unset all session values
    $_SESSION = array();
    
    // Destroy the session
    session_destroy();
    
    // Redirect to the login page or any other appropriate page after logout
    header('Location: ../Pages/login.php');
    exit();
}?>