<html lang="en">
<?php
include_once("../public/header.php");
include_once("../Utils/database.php");
include_once("../Utils/sessionconfig.php");
//functions
include_once("../Functions/authfunctions.php");

displayNavbar();

include_once("../Functions/productfunctions.php");
include_once("../Functions/checkoutfunctions.php");
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
<form action="process_checkout.php" method="post">
  <div class="form-group">
    <label for="firstName">First Name</label>
    <input type="text" class="form-control" id="firstName" name="firstName" required>
  </div>
  <div class="form-group">
    <label for="lastName">Last Name</label>
    <input type="text" class="form-control" id="lastName" name="lastName" required>
  </div>
  <div class="form-group">
    <label for="shippingAddress">Shipping Address</label>
    <textarea class="form-control" id="shippingAddress" name="shippingAddress" required></textarea>
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
      <input class="form-check-input" type="radio" name="paymentMethod" id="bankTransfer" value="bank_transfer" required>
      <label class="form-check-label" for="bankTransfer">Bank Transfer</label>
    </div>
  </div>
  <div class="form-group" id="creditCardDetails" style="display: none;">
    <div class="form-group">
        <label for="cardHolder">Card Holder</label>
        <input type="text" class="form-control" id="cardHolder" name="cardHolder" required>
    </div>
    <div class="form-group">
        <label for="cardNumber">Card Number</label>
        <input type="text" class="form-control" id="cardNumber" name="cardNumber" required>
    </div>
    <div class="form-group">
        <label for="expiry">Expiry</label>
        <input type="text" class="form-control" id="expiry" name="expiry" placeholder="MM/YY" required>
    </div>
    <div class="form-group">
        <label for="cvv">CVV</label>
        <input type="text" class="form-control" id="cvv" name="cvv" required>
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
        }
        ?>
    </p>
  </div>
  <button type="submit" class="btn btn-primary">Submit</button>
</form>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const creditCardInput = document.getElementById('creditCardDetails');
        const bankTransferInput = document.getElementById('bankTransferInput');

        document.querySelectorAll('input[type=radio][name=paymentMethod]').forEach((radio) => {
            radio.addEventListener('change', function () {
                if (this.value === 'credit_card') {
                    creditCardInput.style.display = 'block';
                    bankTransferInput.style.display = 'none';
                } else if (this.value === 'bank_transfer') {
                    bankTransferInput.style.display = 'block';
                    creditCardInput.style.display = 'none';
                }
            });
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
