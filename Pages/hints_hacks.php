<html lang="en">
<?php 
include_once("../public/header.php");
include_once("../Utils/database.php");
include_once("../Utils/sessionconfig.php");
include_once("../Components/helpnav.php");
include_once("../Components/items.php");
?> 
<head>
<head>  <style>
   
   .customcard {
    display: flex;
    flex-direction: column;
    justify-content: space-between;
}

.card-body {
    flex-grow: 1;
}

.card-body a {
    width: 100%;
    text-align: center;
}
   
  </style></head>
</head>
<body>
<div class="container mt-5">
  <div class="row">
    <!-- First card column -->
    <div class="col-md-3">
    <div class="card mb-3 customcard" style="height: 430px;">
        <img class="card-img-top" src="../images/sql.png" alt="Card image cap">
        <div class="card-body">
          <h5 class="card-title">SQL Injection</h5>
          <p class="card-text">Injecting Malicious code</p><br><br>
          <?php divider();?>
          <a href="showhint.php?number=1" class="btn btn-primary">View More Info</a>      
        </div>
      </div>
    </div>

    <!-- Second card column -->
    <div class="col-md-3">
    <div class="card mb-3 customcard" style="height: 430px;">
        <img class="card-img-top" src="../images/xss.png" alt="Card image cap">
        <div class="card-body">
          <h5 class="card-title">Cross Site Scripting XSS</h5>
          <p class="card-text">Inserting script into input fields.</p>
          <?php divider();?>
          <a href="showhint.php?number=2" class="btn btn-primary">View More Info</a>
                </div>
      </div>
    </div>

     <!-- 3 card column -->
     <div class="col-md-3">
     <div class="card mb-3 customcard" style="height: 430px;">
        <img class="card-img-top" src="../images/social.png" alt="Card image cap">
        <div class="card-body">
          <h5 class="card-title">Social Engineering</h5>
          <p class="card-text">Stalking a subject how to keep information safe</p><br>
          <?php divider();?>
          <a href="showhint.php?number=3" class="btn btn-primary">View More Info</a>        </div>
      </div>
    </div>

     <!-- 4 card column -->
     <div class="col-md-3">
     <div class="card mb-3 customcard" style="height: 430px;">
        <img class="card-img-top" src="../images/imageupload.png" alt="Card image cap">
        <div class="card-body">
          <h5 class="card-title">Image Upload vulnerability</h5>
          <p class="card-text">Hiding data in images</p><br>
          <?php divider();?>
          <a href="showhint.php?number=4" class="btn btn-primary">View More Info</a>        </div>
      </div>
    </div>

    <?php divider();?>
     <!-- Second card column -->
     <div class="col-md-3">
     <div class="card mb-3 customcard" style="height: 430px;">
        <img class="card-img-top" src="../images/bruteforce.png" alt="Card image cap">
        <div class="card-body">
          <h5 class="card-title">Brute Force</h5>
          <p class="card-text">Forcing your way into the system</p><br>
          <?php divider();?>
          <a href="showhint.php?number=5" class="btn btn-primary">View More Info</a>        </div>
      </div>
    </div>
     <!-- Second card column -->
     <div class="col-md-3">
     <div class="card mb-3 customcard" style="height: 430px;">
        <img class="card-img-top" src="../images/bm.png" alt="Card image cap">
        <div class="card-body">
          <h5 class="card-title">Basket Manipulation</h5>
          <p class="card-text">Where a hacker can manipulate the cart/Basket</p><br>
          <?php divider();?>
          <a href="showhint.php?number=6" class="btn btn-primary">View More Info</a>        </div>
      </div>
    </div>
         <!-- Second card column -->
         <div class="col-md-3">
         <div class="card mb-3 customcard" style="height: 430px;">
        <img class="card-img-top" src="../images/Defaultfeature.png" alt="Card image cap">
        <div class="card-body">
          <h5 class="card-title">Coming Soon</h5>
          <p class="card-text">New Feature coming soon!</p><br><br>
          <?php divider();?>
          <a href="showhint.php?number=7" class="btn btn-primary">View More Info</a>        </div>
      </div>
    </div>
         <!-- Second card column -->
         <div class="col-md-3">
         <div class="card mb-3 customcard" style="height: 430px;">
        <img class="card-img-top" src="../images/Defaultfeature.png" alt="Card image cap">
        <div class="card-body">
        <h5 class="card-title">Coming Soon</h5>
          <p class="card-text">New Feature coming soon!</p><br><br>
          <?php divider();?>
          <a href="showhint.php?number=8" class="btn btn-primary">View More Info</a>        </div>
      </div>
    </div>
     
  </div>
</div>


</body>
<?php gap();
include_once("../Components/footer.php"); ?>
</html>