<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

include_once("../Utils/database.php");
include_once("../Utils/sessionconfig.php");

//user account access level = 1
//admin account access level = 2
function getUsers(){

    $conn = connectdb();
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
function getUserAccount() {
    
    if (isset($_SESSION['uid'])) {
        $uid = $_SESSION['uid'];
        
        $conn = connectdb();

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
    $user = CheckaccessLevel();

    if($user == 1){
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
            echo "</tr>";
        }
    
        echo '</tbody>';
        echo '</table>';}elseif($user == 2){echo '<table class="table table-striped">';
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
            echo '<th>Edit</th>';
            echo '<th>Delete</th>';
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
                echo "<td><a href='editAccount.php?uid={$user['uid']}' class='btn btn-info'>View</a></td>";
                echo "<td><a href='#' class='btn btn-danger'>delete</a></td>";        
                echo "</tr>";
            }
        
            echo '</tbody>';
            echo '</table>';

        }
    
}

function editUser($uid){
    $conn = connctdb();

    $sql = "SELECT * FROM products WHERE uid=?";
    $stmt = $conn->prepare($sql);

    if ($stmt === false) {
        die("Error: Unable to prepare the SQL statement");
    }

    $result = $stmt->bind_param("s", $uid);

    if ($result === false) {
        die("Error: Unable to bind parameters");
    }

    $executeResult = $stmt->execute();

    if ($executeResult === false) {
        die("Error: Unable to execute the SQL statement");
    }

    $userData = $stmt->get_result()->fetch_assoc();

    if (!$userData) {
        die("Error: Product not found");
    }

    // uid	fname lname	email password address	card_number	card_holder	
// expiration_date	cvv	isAdmin	session_token
    echo'
    <!-- Form for editing product details -->
    <form id="editUserForm" method="POST" enctype="multipart/form-data">
        <div class="form-group">
            <label for="fname">First Name</label>
            <input type="text" class="form-control" id="fname" name="fname" value="' . $usertData['fname'] . '" required>
        </div>

        <div class="form-group">
            <label for="lname">Last Name</label>
            <input type="text" class="form-control" id="lname" name="lname" value="' . $usertData['lname'] . '" required>
        </div>

        <div class="form-group">
             <label for="email">Email</label>
            <input type="text" class="form-control" id="email" name="email" value="' . $usertData['email'] . '" required>
        </div>

        <div class="form-group">
             <label for="address">Address</label>
            <input type="text" class="form-control" id="address" name="address" value="' . $usertData['address'] . '" required>
        </div>

        <div class="form-group">
        <label for="card_number">Card Number</label>
       <input type="text" class="form-control" id="card_number" name="card_number" value="' . $usertData['card_number'] . '" required>
   </div>

   <div class="form-group">
        <label for="card_Holder">Card Holder</label>
       <input type="text" class="form-control" id="card_Holder" name="card_Holder" value="' . $usertData['card_Holder'] . '" required>
   </div>

      <div class="form-group">
        <label for="expiration_date">Expiryr</label>
       <input type="text" class="form-control" id="expiration_date" name="expiration_date" value="' . $usertData['expiration_date'] . '" required>
   </div>

   <div class="form-group">
   <label for="cvv">CVV</label>
  <input type="text" class="form-control" id="expiration_date" name="expiration_date" value="' . $usertData['cvv'] . '" required>
</div>

<div class="form-group">
<label for="isAdmin">Is the user an Admin</label>
<select class="form-control" id="isAdmin" name="isAdmin" required>
    <option value="1" ' . ($userData['isAdmin'] == 1 ? 'selected' : '') . '>Yes</option>
    <option value="0" ' . ($userData['isAdmin'] == 0 ? 'selected' : '') . '>No</option>
</select>
</div>

<input type="hidden" name="userData" value="' . $userData . '">
<button type="submit" class="btn btn-success" name="updateUser">Update User</button>
</form>';
        
        $stmt->close();
        $conn->close();
        
}

    // uid	fname lname	email password address	card_number	card_holder	
// expiration_date	cvv	isAdmin	session_token
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['updateUser'])) {
    $conn = connectdb();

    $fname = $_POST["fname"];
    $lname = $_POST["lname"];
    $email = $_POST["email"];
    $address = $_POST["address"]; 
    $card_number = $_POST["card_number"]; 
    $card_holder = $_POST["card_holder"];
    $expiration_date = $_POST["exeiration_date"];
    $cvv = $_POST["cvv"];
    $isAdmin = $_POST["isAdmin"];

    $sql .= " WHERE uid=?";
        $bindParams[] = $uid;
        $bindTypes .= 's';

    $stmt = $conn->prepare($sql);

    if ($stmt === false) {
        die("Error: Unable to prepare the SQL statement");
    }

    // Bind parameters dynamically
    $stmt->bind_param($bindTypes, ...$bindParams);

    // Execute the statement
    $executeResult = $stmt->execute();

    if ($executeResult === false) {
        die("Error: Unable to execute the SQL statement");
    }

    echo "Product details updated successfully";

    $stmt->close();
    $conn->close();
}

?>