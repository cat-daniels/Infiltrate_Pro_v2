<?php 

function connectdb(){
    // Database connection details
    $servername = "localhost";
    $username = "root";
    $db_password = "";
    $dbname = "infiltratepro"; 

    $conn = new mysqli($servername, $username, $db_password, $dbname);

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    return $conn;
}

function displayNavbar() {
    // Check if the user is logged in
    if (isset($_SESSION["session_token"])) {
        // Check if the user is an admin
        $isAdmin = isset($_SESSION["isAdmin"]) ? $_SESSION["isAdmin"] : false;

        if ($isAdmin) {
            // Debug: 
            echo "Admin Navbar"; 

            // Include admin navbar if user is admin
            include_once("../Components/adminnav.php");
        } else {
            // Debug: 
            echo "User Navbar"; 

            // Include user navbar if user is not admin
            include_once("../Components/usernav.php");
        }
    } else {
        // Debug: 
        echo "Default Navbar"; 

        // Include default navbar if user is not logged in
        include_once("../Components/nav.php");
    }
}
?>