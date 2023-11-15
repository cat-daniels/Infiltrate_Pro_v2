<?php
include_once("../Utils/database.php");

function RegisterAccount(){
    session_start();

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

function LoginAccount($email, $password){
    session_start();

    $conn = connectdb();
    
    $query = "SELECT * FROM users WHERE email = '$email' AND password = '$password'";
    $result = $conn->query($query);

    if ($result->num_rows == 1) {
        $user_data = $result->fetch_assoc();

        // Generate a unique session token
        $session_token = bin2hex(random_bytes(16)); // Adjust the length as needed

        // Store the session token in the user's record in the database
        $uid = $user_data['uid'];
        $update_query = "UPDATE users SET session_token = '$session_token' WHERE uid = $uid";
        $conn->query($update_query);

        // Set session variables
        $_SESSION["session_token"] = $session_token;

        // Redirect to appropriate dashboard based on user role (admin or user)
        if ($user_data['isAdmin'] == true) {
            // If admin, redirect to admin dashboard
            header("Location: ../Dashboards/admindashboard.php");
        } else {
            // If not admin, redirect to user dashboard
            header("Location: ../Dashboards/userdashboard.php");
        }

        exit();
    } else {
        $error_message = "Invalid email or password. Please try again.";
        return $error_message;
    }

    $conn->close();
};

function logout(){function logout() {
    session_start();
    $_SESSION = array();

    if (ini_get("session.use_cookies")) {
        $params = session_get_cookie_params();
        setcookie(session_name(), '', time() - 42000, $params["path"], $params["domain"], $params["secure"], $params["httponly"]);
    }

    session_destroy();

    // Redirect to the login page or home page after logout
    header("Location: ../Pages/login.php"); // Replace with your login page URL
    exit();
}

// Usage example:
if (isset($_POST["logout"])) {
    logout();
}};
?>