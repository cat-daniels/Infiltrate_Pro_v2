<?php

function getUserAccount() {
    session_start();
    
    if (isset($_SESSION['uid'])) {
        $uid = $_SESSION['uid'];
        
        $servername = "localhost";
        $username = "root";
        $password = "";
        $dbname = "infiltratepro"; 
        
        $conn = new mysqli($servername, $username, $password, $dbname);
    
        if ($conn->connect_error) {
            die("Connections failed " . $conn->connect_error);
        }
    
        // Fetch user data for the logged-in user
        $sql = "SELECT * FROM users WHERE uid = $uid";
        $result = $conn->query($sql);
    
        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            // Create an array with the data for the logged-in user
            $userArray = array($row);
            // Close the database connection
            $conn->close();
            // Display the user data using the displayUsers function
            displayUsers($userArray);
        } else {
            echo "User not found.";
        }
    } else {
        echo "User is not logged in.";
    }
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