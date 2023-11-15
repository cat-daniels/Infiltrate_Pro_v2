<?php 

function connectdb(){
        // Database connection details
        $servername = "localhost";
        $username = "root";
        $db_password = "";
        $dbname = "infiltratepro"; 
    
        $conn = new mysqli($servername, $username, $db_password, $dbname);
    
        if (!$conn) {
            die("Database connection failed: " . mysqli_connect_error());
        }
        
        return $conn;
}

?>