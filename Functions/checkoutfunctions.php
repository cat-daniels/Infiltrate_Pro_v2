<?php
function checkoutItems() {
    sessioncheck();
    $userID = isset($_SESSION['uid']) ? $_SESSION['uid'] : null;

    if ($userID) {
        $conn = connectdb();

        // Retrieve cart items for the logged-in user
        $sql = "SELECT * FROM cart WHERE userID = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("i", $userID);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            $cartContent = '<table>';
            $cartContent .= '<tr><th>Product Code</th><th>Product Name</th><th>Quantity</th><th>Price</th><th>Total Price</th></tr>';

            while ($row = $result->fetch_assoc()) {
                $cartContent .= "<tr>";
                $cartContent .= "<td>{$row['productCode']}</td>";
                $cartContent .= "<td>{$row['productName']}</td>";
                $cartContent .= "<td>{$row['quantity']}</td>";
                $cartContent .= "<td>{$row['price']}</td>";
                $cartContent .= "<td>{$row['totalPrice']}</td>";
                $cartContent .= "</tr>";
            }

            $cartContent .= '</table>';
            echo $cartContent;

        } else {
            echo "Cart is empty.";
        }

        $stmt->close();
        $conn->close();
    } else {
        echo "User not logged in.";
    }
}

function randomreference($uid){
    // Generate a random number
    $randomNumber = rand(10, 100);

    // Concatenate the random number with the uid,
    $reference = $randomNumber . '-' . $uid;

    return $reference;
}

function generateOrderNumber(){
    // Generate a random number
    $randomNumber = rand(10, 100);

    return $randomNumber;
}


// clear the cart after the form has been submitted:
    function clearCart($uid) {
       $conn = connectdb();    
        // SQL query to delete cart items for the provided user ID
        $sql = "DELETE FROM cart WHERE userID = ?";
        
        $stmt = $conn->prepare($sql);
    
        if ($stmt) {
            $stmt->bind_param("i", $uid);
            $stmt->execute();
            $stmt->close();
            $conn->close();
    
        } else {
            echo "Error: " . $conn->error;
        }
    }
?>