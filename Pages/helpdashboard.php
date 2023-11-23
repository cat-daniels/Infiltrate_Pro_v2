<html lang="en">
<?php 
include_once("../public/header.php");
include_once("../Utils/database.php");
include_once("../Utils/sessionconfig.php");
include_once("../Components/helpnav.php");
include_once("../Components/items.php");
?> 

<body>
    <?php topgap(); ?>
<div id="accordion">
  <div class="card">
    <div class="card-header" id="headingOne">
      <h5 class="mb-0">
        <button class="btn btn-link" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
          What is infiltrate Pro?
        </button>
      </h5>
    </div>

    <div id="collapseOne" class="collapse show" aria-labelledby="headingOne" data-parent="#accordion">
      <div class="card-body">
      Infiltrate Pro is an educational tool that is used in the eco-system of learning cybersecurity.
        It facilitates a gap between theoretical learning and hands-on experience.
        It does this by being modelled after an e-commerce store and is purposely vulnerable to 
        attack. 
    Infiltrate pro allows users to test their hacking skills in a safe environment. Infiltrate pro in 
    short is meant to be hacked to teach students the intricacies of cybersecurity by giving them 
    a base level of practice and understanding but also guiding them along the way with helpful 
    tips and tricks. 
    We also aim to become a part of the learning process by providing users with a tool that they 
    can learn from and is modelled after something they use in their weekly lives.
      </div>
    </div>
  </div>

  <?php divider(); ?>

  <div class="card">
    <div class="card-header" id="headingTwo">
      <h5 class="mb-0">
        <button class="btn btn-link collapsed" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
          How do we do that?
        </button>
      </h5>
    </div>
    <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordion">
      <div class="card-body">
      We allow users to hack the e-commerce store...<br>
      By allowing users to perform penetration testing on this application we put real-world 
        scenarios in a safe environment for them to test their knowledge and comprehension.
      </div>
    </div>
  </div>

  <?php divider(); ?>

  <div class="card">
    <div class="card-header" id="headingThree">
      <h5 class="mb-0">
        <button class="btn btn-link collapsed" data-toggle="collapse" data-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
          What else is there
        </button>
      </h5>
    </div>
    <div id="collapseThree" class="collapse" aria-labelledby="headingThree" data-parent="#accordion">
      <div class="card-body">
        You can find hints around the website if there is a button with the following:
            <button class= "btn btn-info">Hint</button><br>
        Click on it to see a bit more information whether it is to do with vulnerabilities or actual hints to hacking the system.
      </div>
    </div>
  </div>

  <?php divider(); ?>

  <div class="card">
    <div class="card-header" id="heading Four">
      <h5 class="mb-0">
        <button class="btn btn-link collapsed" data-toggle="collapse" data-target="#collapse Four" aria-expanded="false" aria-controls="collapse Four">
         <strong> Lastly!</strong>
        </button>
      </h5>
    </div>
    <div id="collapse Four" class="collapse" aria-labelledby="heading Four" data-parent="#accordion">
      <div class="card-body">
        Please remeber to always use this in a safe environment.
        you never know the threats that could be in this website use in a virtual machine.
        -- Happy hunting!
      </div>
    </div>
  </div>
  <?php gap(); ?>
</div>
</body>

<?php include_once("../Components/footer.php"); ?>
</html>
