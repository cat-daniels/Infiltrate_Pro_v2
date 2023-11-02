<?php

    function getproducts(){
        $servername = "localhost";
        $username = "root";
        $password = "";
        $dbname = "infiltratepro"; 
        
        $conn = new mysqli($servername, $username, $password, $dbname);
    
        if($conn->connect_error){
            die("Connections failed " . $conn->connect_error);
        }
    
        
        $sql = "SELECT * FROM products";
        $result = $conn->query($sql);
        $prodArray = array(); // Create an array to store prod data this is so we can display it in a table :)
    
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $prodArray[] = $row; // Add each prod data to the array
            }
        } else {
            echo "No products found.";
        }
    
        // Close the database connection
        $conn->close();
    
        // Display the user data using the displayUsers function
        displayProducts($prodArray);
    }
    
    function displayProducts($prodArray) {
        echo '<table class="table table-striped">';
        echo '<thead>';
        echo '<tr>';
        echo '<th>Product Code</th>';
        echo '<th>Product Name</th>';
        echo '<th>Price</th>';
        echo '<th>Keywords</th>';
        echo '<th>Categories</th>';
        echo '<th>Featured</th>';
        echo '<th>View</th>';
        echo '<th>Delete</th>';
        echo '</tr>';
        echo '</thead>';
        echo '<tbody>';
    
        foreach ($prodArray as $prod) {
            echo "<tr>";
            echo "<td>{$prod['ProductCode']}</td>";
            echo "<td>{$prod['ProductName']}</td>";
            echo "<td>{$prod['Price']}</td>";
            echo "<td>{$prod['Keywords']}</td>";
            echo "<td>{$prod['Category']}</td>";
            echo "<td>{$prod['Featured']}</td>";
            echo "<td><a href='vieweditproduct.php?productCode={$prod['ProductCode']}' class='btn btn-info'>View</a></td>";
            echo "<td><button class='btn btn-danger' onclick='deleteprod(\"{$prod['ProductCode']}\")'>Delete</button></td>";
            echo "</tr>";
        }
        echo '</tbody>';
        echo '</table>';
    }
    
 // removed for now working on logout function instead
?>