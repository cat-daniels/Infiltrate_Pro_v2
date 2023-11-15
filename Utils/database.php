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
   

            // Include admin navbar if user is admin
            include_once("../Components/adminnav.php");
        } else {
           
            // Include user navbar if user is not admin
            include_once("../Components/usernav.php");
        }
    } else {
        
        // Include default navbar if user is not logged in
        include_once("../Components/nav.php");
    }
}

function Checkaccesslevel() {
    $access_level = 0; // Default access level for not logged in users

    if (isset($_SESSION["session_token"])) {
        $isAdmin = isset($_SESSION["isAdmin"]) ? $_SESSION["isAdmin"] : false;

        if ($isAdmin) {
            // if the user is an admin access level is 2
            $access_level = 2;
        } else {
            // if the user is a normal user access level is 1
            $access_level = 1;
        }
    }

    return $access_level;
}

?>