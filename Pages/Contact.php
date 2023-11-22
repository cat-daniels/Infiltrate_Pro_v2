<html lang="en">
<?php 
include_once("../public/header.php");
include_once("../Utils/database.php");
include_once("../Utils/sessionconfig.php");
//functions

displayNavbar();
?> 
<?php 
// for the profile pictures

$John = "../images/people/download (2).jpg";
$Alice = "../images/people/download.jpg";
$Michael = "../images/people/download (1).jpg";
?>

<div class="block" style="height: 300px; margin-top: 20px;">
  <div class="row1">
    <div class="col-xl">
    </div>
  </div>
  <div class="row" style="height: 250px">
    <div class="col-6">
    <div class="circular-image">
        <img src="<?php echo $John; ?>" alt="John Smith's Picture">
      </div>
    </div>
    <div class="col">
    <h5 class="card-title">John Smith</h5>
      <p class="card-text">As the Owner of Infiltrate Pro founded in 2022, John is dedicated to driving the company's growth and ensuring exceptional customer satisfaction. He leads the team with a clear vision and a passion for innovation.  He is currently 31 years old and enjoys hanging out with his dog Finley</p><br>
      <small class="text">Position&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Owner</small><br>
      <small class="text">Email&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;owner@email.com</small><br>
      <small class="text">Phone&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;09 812 0001</small>
      <button type="button" class="btn btn-info my-2 my-sm-0" id="NavButton" data-toggle="modal" data-target="#hintModal">
    	Hint
    </button>
    </div>
    </div>
  </div>
</div>
<!-- -------------------------------------------------------------Block End------------------>
<div class="block2" id="contactstyle" style="height: 300px; margin-top: 20px;">
  <div class="row1">
    <div class="col-xl">
    </div>
  </div>
  <div class="row">
    <div class="col">
    <div class="circular-image">
        <img src="<?php echo $Alice; ?>" alt="Alice Johnson's Picture">
      </div>
    </div>
    <div class="col">
    <h5 class="card-title">Alice Johnson</h5>
      <p class="card-text">As an Executive Officer at Infiltrate Pro, Alice plays a crucial role in overseeing day-to-day operations and providing strategic guidance to the team. She is passionate about creating a positive work environment and empowering the team to achieve their full potential.</p><br>
        <small class="text">Position&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Executive Officer</small><br>
      <small class="text">Email&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;executiveofficer@email.com</small><br>
      <small class="text">Phone&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;09 812 0000</small>
    </div>
    </div>
    </div>
  </div>
</div>
<!-- -------------------------------------------------------------Block End------------------>
<div class="block3" style="height: 300px; margin-top: 20px;">
  <div class="row1">
    <div class="col-xl">
    </div>
  </div>
  <div class="row" style="height: 250px">
    <div class="col-6">
    <div class="circular-image">
        <img src="<?php echo $Michael; ?>" alt="Michael Brown's Picture">
      </div>
    </div>
    <div class="col">
    <h5 class="card-title">Michael Brown</h5>
            <p class="card-text">As a Sales Technician at Infiltrate Pro, Michael is responsible for building strong relationships with clients and providing them with innovative solutions. His attention to detail and product knowledge make him a valuable asset to the team.</p><br>
            <small class="text">Position&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Sales Technician</small><br>
            <small class="text">Email&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;sales@email.com</small><br>
            <small class="text">Phone&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;09 812 0002</small>
        </div>
    </div>
    <div class="col">
      Blurb
    </div>
  </div>
</div>
<div class="gap"></div>

<?php include_once("../Components/footer.php"); ?>
</html>

<div class="modal fade" id="hintModal" tabindex="-1" role="dialog" aria-labelledby="hintModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="hintModalLabel">Hint</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
            <h6>It's important not to share too much personal information or direct email addresses in public view, as they could be used in phishing attacks or other malicious activities. Protect your privacy and stay safe online</h6><br><br>
            <p>As you can see the owner has a dog named Finley and is 37 years old what are the chances his password would have something to do with that?</p><br>
            <p>We can also see the other staff information that we could try</p><br>
            <h6>A websites first defence should have a generic contact form I know it is less personal but the aim of the game is safety first!</h6>
            </div>
            <div class="modal-footer">
     <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
    </div>
  </div>
</div>

