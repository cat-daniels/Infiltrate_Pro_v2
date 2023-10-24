<?php

    function getUsers(){
        $servername = "localhost";
        $username = "root";
        $password = "";
        $dbname = "infiltratepro"; 
        
        $conn = new mysqli($servername, $username, $password, $dbname);
    
        if($conn->connect_error){
            die("Connections failed " . $conn->connect_error);
        }
    
        
        $sql = "SELECT * FROM users";
        $result = $conn->query($sql);
        $userArray = array(); // Create an array to store user data this is so we can display it in a table :)
    
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $userArray[] = $row; // Add each user data to the array
            }
        } else {
            echo "No users found.";
        }
    
        // Close the database connection
        $conn->close();
    
        // Display the user data using the displayUsers function
        displayUsers($userArray);
    }
    
    function displayUsers($userArray) {
        echo '<table class="table table-striped">';
        echo '<thead>';
        echo '<tr>';
        echo '<th>UID</th>';
        echo '<th>First Name</th>';
        echo '<th>Last Name</th>';
        echo '<th>Email</th>';
        echo '<th>Address</th>';
        echo '<th>Card Number</th>';
        echo '<th>Card Holder</th>';
        echo '<th>Expiration Date</th>';
        echo '<th>CVV</th>';
        echo '<th>Is Admin</th>';
        echo '</tr>';
        echo '</thead>';
        echo '<tbody>';
    
        foreach ($userArray as $user) {
            echo "<tr>";
            echo "<td>{$user['uid']}</td>";
            echo "<td>{$user['fname']}</td>";
            echo "<td>{$user['lname']}</td>";
            echo "<td>{$user['email']}</td>";
            echo "<td>{$user['address']}</td>";
            echo "<td>{$user['card_number']}</td>";
            echo "<td>{$user['card_holder']}</td>";
            echo "<td>{$user['expiration_date']}</td>";
            echo "<td>{$user['cvv']}</td>";
            echo "<td>" . ($user["isAdmin"] ? "Yes" : "No") . "</td>";
            echo "</tr>";
        }
    
        echo '</tbody>';
        echo '</table>';
    }
    
?>