<?php
// get uid from session and display the orders of the user
function displayOrdersBySessionUID() {
    $uid = isset($_SESSION['uid']) ? $_SESSION['uid'] : null;

    $conn = connectdb();

    $sql = "SELECT orderId, orderNumber, firstName, lastName, address, paymentMethod, totalAmount FROM orders WHERE uid = ?";
    $stmt = $conn->prepare($sql);

    if ($stmt) {
        $stmt->bind_param("i", $uid);
        $stmt->execute();

        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            echo "<h2>Orders</h2>";
            echo '<table class="table table-striped">';
            echo "<tr><th>Order Number</th><th>First Name</th><th>Last Name</th><th>Address</th><th>Payment Method</th><th>Total Amount</th><th>Action</th></tr>";

            while ($row = $result->fetch_assoc()) {
                $orderId = $row['orderId'];
                $orderNumber = $row['orderNumber'];
                $firstName = $row['firstName'];
                $lastName = $row['lastName'];
                $address = $row['address'];
                $paymentMethod = $row['paymentMethod'];
                $totalAmount = $row['totalAmount'];

                // Displaying in a table row
                echo "<tr>";
                echo "<td>$orderNumber</td>";
                echo "<td>$firstName</td>";
                echo "<td>$lastName</td>";
                echo "<td>$address</td>";
                echo "<td>$paymentMethod</td>";
                echo "<td>$totalAmount</td>";
                echo "<td><a href='view_orders.php?orderId=$orderId'>View More</a></td>"; 
                echo "</tr>";
            }

            echo "</table>";
        } else {
            echo "No orders found for this user.";
        }

        $stmt->close();
        $conn->close();
    } else {
        echo "Error preparing statement: " . $conn->error;
    }
}

function displayOrderDetails($orderId) {
    //grab the orderid from the viewmore button and display only that order
    $conn = connectdb(); 

    $sql = "SELECT * FROM orders WHERE orderId = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $orderId); 
    $stmt->execute();

    // Fetch the result
    $result = $stmt->get_result();
    if ($result->num_rows > 0) {
        $order = $result->fetch_assoc();
        // Display order details
        echo "<h2>Order Details</h2>";
        echo "<p>Order Number: " . $order['orderNumber'] . "</p>";
        echo "<p>First Name: " . $order['firstName'] . "</p>";
        echo "<p>Last Name: " . $order['lastName'] . "</p>";
        echo "<p>Email: " . $order['email'] . "</p>";
        echo "<p>Address: " . $order['address'] . "</p>";
        echo "<p>Country: " . $order['country'] . "</p>";
        echo "<p>Post Code: " . $order['postCode'] . "</p>";
        echo "<p>Phone Number: " . $order['phoneNumber'] . "</p>";
        echo "<p>Payment Method: " . $order['paymentMethod'] . "</p>";
        echo "<p>Total Amount: $" . $order['totalAmount'] . "</p>";

        // Display order items
        $orderItems = $order['orderDetails']; 

        // Split the order details string and display each item because they're saved as a string
        $items = explode("\n", $orderItems);
        echo "<h3>Order Items</h3>";
        echo "<table border='1'>";
        echo "<tr><th>Product Name</th><th>Quantity</th><th>Price</th><th>Line Price</th></tr>";
        foreach ($items as $item) {
            $details = explode(", ", $item);

            // Check if $details array has at least two elements before accessing them
            if (count($details) >= 2) {
                $productName = isset($details[0]) ? explode(": ", $details[0])[1] : '';
                $quantity = isset($details[1]) ? explode(": ", $details[1])[1] : '';
                $price = isset($details[2]) ? explode(": ", $details[2])[1] : '';
                $linePrice = isset($details[3]) ? explode(": ", $details[3])[1] : '';

                // Display the order item details
                echo "<tr>";
                echo "<td>$productName</td>";
                echo "<td>$quantity</td>";
                echo "<td>$price</td>";
                echo "<td>$linePrice</td>";
                echo "</tr>";
            }
        }
        echo "</table>";
        echo "<br>";
        echo "<a href='manageOrders.php'><button class='btn btn-success my-2 my-sm-0' id='NavButton'>Back to Orders</button></a>";
        echo "<br>";
    } else {
        echo "Order not found!";
    }

    $stmt->close();
    $conn->close();
}


//-------------------------------Admin order functions------------------

function displayAllOrders() {
    $conn = connectdb();

    $sql = "SELECT orderId, orderNumber, firstName, lastName, address, paymentMethod, totalAmount FROM orders";
    $result = $conn->query($sql);

    if ($result) {
        if ($result->num_rows > 0) {
            echo "<table class='table table-striped'>";
            echo "<thead class='thead-light'><tr><th>Order Number</th><th>First Name</th><th>Last Name</th><th>Address</th><th>Payment Method</th><th>Total Amount</th><th>Action</th></tr></thead>";
            echo "<tbody>";

            while ($row = $result->fetch_assoc()) {
                $orderId = $row['orderId'];
                $orderNumber = $row['orderNumber'];
                $firstName = $row['firstName'];
                $lastName = $row['lastName'];
                $address = $row['address'];
                $paymentMethod = $row['paymentMethod'];
                $totalAmount = $row['totalAmount'];

                // Displaying in a table row
                echo "<tr>";
                echo "<td>$orderNumber</td>";
                echo "<td>$firstName</td>";
                echo "<td>$lastName</td>";
                echo "<td>$address</td>";
                echo "<td>$paymentMethod</td>";
                echo "<td>$totalAmount</td>";
                echo "<td><a href='view_orders.php?orderId=$orderId' class='btn btn-info'>View More</a></td>"; 
                echo "</tr>";
            }

            echo "</tbody>";
            echo "</table>";
            echo '<div class = "gap"></div>';
        } else {
            echo "No orders found.";
        }

        $conn->close();
    } else {
        echo "Error fetching orders: " . $conn->error;
    }
}


?>
