<html lang="en">
<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

include_once("../public/header.php");
include_once("../Utils/database.php");
include_once("../Utils/sessionconfig.php");
//functions
include_once("../Functions/authfunctions.php");

displayNavbar();

include_once("../Functions/productfunctions.php");
include_once("../Functions/checkoutfunctions.php");
include_once("../Functions/orderfunctions.php");

?>


<body>
<?php checkoutItems();?>
<button type="button" class="btn btn-success my-2 my-sm-0" id="NavButton" data-toggle="modal" data-target="#checkoutModal">
  Confirm
</button>

<!-- Modal -->
<div class="modal fade" id="checkoutModal" tabindex="-1" role="dialog" aria-labelledby="checkoutModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="checkoutModalLabel">Checkout Details</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
<!-- Form for user details -->
<form action="checkout.php?createOrder=true" method="post">
    <div class="form-group">
  <input type="hidden" id="uid" name="uid" value="<?php echo isset($_SESSION['uid']) ? $_SESSION['uid'] : ''; ?>">
    <label for="firstName">First Name</label>
    <input type="text" class="form-control" id="firstName" name="firstName" required>
  </div>
  <div class="form-group">
    <label for="lastName">Last Name</label>
    <input type="text" class="form-control" id="lastName" name="lastName" required>
  </div>
  <div class="form-group">
    <label for="email">Email</label>
    <input type="text" class="form-control" id="email" name="email" required>
  </div>
  <div class="form-group">
    <label for="address">Shipping Address</label>
    <textarea class="form-control" id="address" name="address" required></textarea>
  </div>
  <div class="form-group">
    <label for="country">Country</label>
    <textarea class="form-control" id="country" name="country" required></textarea>
  </div>
  <div class="form-group">
    <label for="postCode">Post Code</label>
    <textarea class="form-control" id="postCode" name="postCode" required></textarea>
  </div>
  <div class="form-group">
    <label for="phoneNumber">Phone Number</label>
    <input type="tel" class="form-control" id="phoneNumber" name="phoneNumber" required>
  </div>
  <div class="form-group">
    <label>Payment Method</label><br>
    <div class="form-check form-check-inline">
      <input class="form-check-input" type="radio" name="paymentMethod" id="creditCard" value="credit_card" required>
      <label class="form-check-label" for="creditCard">Credit Card</label>
    </div>
    <div class="form-check form-check-inline">
      <input class="form-check-input" type="radio" name="paymentMethod" id="bankTransfer" value="bankTransfer" required>
      <label class="form-check-label" for="bankTransfer">Bank Transfer</label>
    </div>
  </div>
  <div class="form-group" id="creditCardDetails" style="display: none;">
    <div class="form-group">
        <label for="cardHolder">Card Holder</label>
        <input type="text" class="form-control" id="cardHolder" name="cardHolder" >
    </div>
    <div class="form-group">
        <label for="cardNumber">Card Number</label>
        <input type="text" class="form-control" id="cardNumber" name="cardNumber" >
    </div>
    <div class="form-group">
        <label for="expiry">Expiry</label>
        <input type="text" class="form-control" id="expiry" name="expiry" placeholder="MM/YY" >
    </div>
    <div class="form-group">
        <label for="cvv">CVV</label>
        <input type="text" class="form-control" id="cvv" name="cvv" >
    </div>
</div>

<div class="form-group" id="bankTransferInput" style="display: none;">
    <p>
        <?php
        $uid = isset($_SESSION['uid']) ? $_SESSION['uid'] : null;
        
        if ($uid) {
            $generateReference = randomreference($uid);
            echo "Referee: Infiltrate Pro<br>";
            echo "Reference: $generateReference<br>";
            echo "12-1234-1234567-000";
        } else {
            echo "Referee: Infiltrate Pro<br>";
            echo "Reference: 404<br>";
            echo "12-1234-1234567-000";
        }?>
  </div>
  <button type="submit" class="btn btn-primary">Submit</button>
</form>
<?php


if ($_SERVER["REQUEST_METHOD"] === "POST") {
 
      if (!empty($_POST['firstName']) && !empty($_POST['lastName']) && !empty($_POST['email']) && !empty($_POST['address']) && !empty($_POST['country']) && !empty($_POST['postCode']) && !empty($_POST['phoneNumber']) && isset($_POST['paymentMethod'])) {

      // Retrieve user information from the form
      $uid = isset($_SESSION['uid']) ? $_SESSION['uid'] : null;
      $firstName = $_POST['firstName'];
      $lastName = $_POST['lastName'];
      $email = $_POST['email'];
      $address = $_POST['address'];
      $country = $_POST['country'];
      $postCode = $_POST['postCode'];
      $phoneNumber = $_POST['phoneNumber'];
      $paymentMethod = $_POST['paymentMethod'];

      // Check payment method 
      if ($paymentMethod === 'credit_card') {
        $cardHolder = $_POST['cardHolder'];
        $cardNumber  = $_POST['cardNumber'];
        $expiry  = $_POST['expiry'];
        $cvv  = $_POST['cvv'];
    } else if ($paymentMethod === 'bankTransfer') {
        //Use these details in the db if the user clicks banktransfer
        $cardHolder = "Customer no: " . $uid;
        $cardNumber = $uid;
        $expiry = "00/00";
        $cvv = "000";
    }

      // Fetch cart items for the user
      $cartUserID = isset($_SESSION['uid']) ? $_SESSION['uid'] : null;
      $cartInfo = getCartByUID($cartUserID);

      // Calculate total amount from cart items
      $totalAmount = 0.00;

      // Prepare variables to store order details
      $orderNumber = generateOrderNumber();
      $orderDetails = '';

      foreach ($cartInfo as $item) {
          // Update total amount
          $totalAmount += $item['totalPrice'];

          // Append product details to the order string (you may customize this format as per your requirement)
          $orderDetails .= "Product: " . $item['productName'] . ", Quantity: " . $item['quantity'] . "\n";
      }

      // Insert order details into the Orders table
      $conn = connectdb();

      $sql = "INSERT INTO orders (uid, orderNumber, firstName, lastName, email, address, country, postCode, phoneNumber, paymentMethod, totalAmount, cardHolder, cardNumber, expiry, cvv, orderDetails) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
      $stmt = $conn->prepare($sql);
  
      if ($stmt) {
        $stmt->bind_param("isssssssdsssssss", $uid, $orderNumber, $firstName, $lastName, $email, $address, $country, $postCode, $phoneNumber, $paymentMethod, $totalAmount, $cardHolder, $cardNumber, $expiry, $cvv, $orderDetails);
        $stmt->execute();
  
        // Clear the cart after creating the order
        clearCart($uid);
  
        $stmt->close();
        $conn->close();
  
        // Redirect using JavaScript after a delay - for some reason this works I tried to use redirect but kept getting errors
        echo '<script>
                setTimeout(function() {
                  window.location.href = "success.php";
                }, 2000); // this is so they are redirected to the success page
              </script>';
      } else {
        echo "Error preparing statement: " . $conn->error;
      }
    } else {
      echo "Please fill out all required fields before submitting.";
    }
  }
  ?>

<script>
        document.addEventListener('DOMContentLoaded', function() {
            const creditCardInput = document.getElementById('creditCardDetails');
            const bankTransferInput = document.getElementById('bankTransferInput');
            const creditCardRadio = document.getElementById('creditCard');
            const bankTransferRadio = document.getElementById('bankTransfer');

            // Initial state check
            if (creditCardRadio.checked) {
                creditCardInput.style.display = 'block';
                bankTransferInput.style.display = 'none';
            } else if (bankTransferRadio.checked) {
                bankTransferInput.style.display = 'block';
                creditCardInput.style.display = 'none';
            }

            creditCardRadio.addEventListener('change', function() {
                if (this.checked) {
                    creditCardInput.style.display = 'block';
                    bankTransferInput.style.display = 'none';
                }
            });

            bankTransferRadio.addEventListener('change', function() {
                if (this.checked) {
                    bankTransferInput.style.display = 'block';
                    creditCardInput.style.display = 'none';
                }
            });
        });
    </script>

      </div>
    </div>
  </div>
</div>


</body>

<?php include_once("../Components/footer.php"); ?>
</html>
