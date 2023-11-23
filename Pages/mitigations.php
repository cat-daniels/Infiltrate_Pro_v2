<html lang="en">
<?php 
include_once("../public/header.php");
include_once("../Utils/database.php");
include_once("../Utils/sessionconfig.php");
include_once("../Components/helpnav.php");
include_once("../Components/items.php");
?> 
<head>  <style>
    .custom-card {
      height: 245px;
    }

    .custom-card1 {
      height: 245px;
      background-color: #28a745;
      color: white;
    }
  </style></head>
<body>
<div class="container mt-5">
    <div class="row">
      <!-- First column with content -->
      <div class="col-md-6 d-flex flex-column">
        <!-- Card 1 -->
        <div class="card mb-3 flex-fill custom-card">
          <div class="card-body">
            <h5 class="card-title">SQL Injection (SQLi)</h5>
            <p class="card-text">SQL Injection is a security problem where attackers sneak in harmful codes into a website's database. They do this by tricking the website into using their sneaky codes along with normal user input. This can lead to stealing data or accessing sensitive information.</p>
          </div>
        </div>
        
        <!-- Card 2 -->
        <div class="card mb-3 flex-fill custom-card">
          <div class="card-body">
            <h5 class="card-title">Cross-Site Scripting (XSS)</h5>
            <p class="card-text">Cross-Site Scripting is when bad guys inject harmful scripts into web pages, and innocent users end up running those scripts without knowing. These scripts can do nasty things like stealing data or taking over accounts.</p>
          </div>
        </div>

        <div class="card mb-3 flex-fill custom-card">
    <div class="card-body">
      <h5 class="card-title">Cross-Site Request Forgery (CSRF)</h5>
      <p class="card-text">CSRF is a sneaky attack where bad guys make you unknowingly do things on a website while you are logged in. They use your logged-in session to make you perform actions you didn't intend to.</p>
    </div>
  </div>

  <div class="card mb-3 flex-fill custom-card">
    <div class="card-body">
      <h5 class="card-title">Unvalidated Input and Broken Access Controls</h5>
      <p class="card-text">This is when websites don't properly check user input or control access to certain parts of the website. Attackers can use this to access sensitive areas or data they shouldn't have.</p>
    </div>
  </div>

  <div class="card mb-3 flex-fill custom-card">
    <div class="card-body">
      <h5 class="card-title">Sensitive Data Exposure</h5>
      <p class="card-text">Sensitive Data Exposure is when private information like passwords or credit card numbers is exposed due to weak security measures. This could happen during storage or when data is being sent between computers.</p>
    </div>
  </div>

  
  <!----------------------------------------------------------Second column cards-->

</div>

<div class="col-md-6 d-flex flex-column">
        <!-- Card 1 -->
        <div class="card mb-3 flex-fill custom-card1">
          <div class="card-body">
            <h5 class="card-title">SQL Injection (SQLi)</h5>
            <p class="card-text"><strong>Prevention:</strong> Developers can stop SQL Injection by using special methods that separate user input from the database commands. They should also check and clean the input before using it.
          </div>
        </div>
        
        <!-- Card 2 -->
        <div class="card mb-3 flex-fill custom-card1">
          <div class="card-body">
            <h5 class="card-title">Cross-Site Scripting (XSS)</h5>
            <p class="card-text"><strong>Prevention:</strong> Websites should be careful with user input and make sure to clean and check it before showing it on web pages. There are also special security measures they can use to help stop XSS attacks.
</p>
          </div>
        </div>

        <div class="card mb-3 flex-fill custom-card1">
    <div class="card-body">
      <h5 class="card-title">Cross-Site Request Forgery (CSRF)</h5>
        <p class="card-text"><strong>Prevention:</strong> Developers can use special tokens to verify if the actions are from trusted sources, stopping these kinds of attacks.
    </div>
  </div>

  <div class="card mb-3 flex-fill custom-card1">
    <div class="card-body">
      <h5 class="card-title">Unvalidated Input and Broken Access Controls</h5>
      <p class="card-text"><strong>Prevention:</strong> Websites should be strict about checking user input and controlling who can access what parts of the site based on user roles.
    </div>
  </div>

  <div class="card mb-3 flex-fill custom-card1">
    <div class="card-body">
      <h5 class="card-title">Sensitive Data Exposure</h5>
      <p class="card-text"><strong>Prevention:</strong> To protect sensitive data, websites should use strong security methods like strong encryption, secure storage, and secure communication protocols.
    </div>
  </div>
</body>

<?php 
gap();
include_once("../Components/footer.php"); ?>
</html>