<html lang="en">
<?php 
include_once("../public/header.php");
include_once("../Utils/database.php");
include_once("../Utils/sessionconfig.php");
include_once("../Components/helpnav.php");
include_once("../Components/items.php");
?> 
<head>
    <?php
    if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET['number'])) {
        $number = $_GET['number'];
        //grab the number from the url
        
        switch ($number) {
            case 1:
                $title = "SQL Injection";
                $text = "When a user is injecting sql think about where they plan to inject it. <br> It could be the url or user input";
                $imageSrc = "../images/sqlsrc1.png";
                $imageSrc2= "../images/sqlsrc2.png";
                break;
            case 2:
                $title = "Xss";
                $text = "XSS (Cross-Site Scripting) is a security vulnerability where attackers inject malicious scripts into web applications, allowing them to execute scripts in the victim's browser, potentially stealing sensitive information or taking control of the user's session.";
                $imageSrc = "../images/xsssrc1.png";
                $imageSrc2= "../images/xsssrc2.png";
                break;
            case 3:
                $title = "Social Engineering";
                $text = "Social engineering involves manipulating individuals to divulge sensitive information or perform actions compromising security through psychological manipulation or exploiting trust.";
                $imageSrc = "../images/sesrc1.png";
                $imageSrc2= "../images/sesrc2.png";

                break;
            case 4:
                $title = "Image Uploading";
                $text = "Image upload vulnerability refers to a security weakness allowing attackers to upload malicious files, bypassing restrictions, potentially leading to unauthorized access or execution of code on a system.";
                $imageSrc = "../images/iusrc1.png";
                $imageSrc2= "../images/iusrc2.png";

                break;
            case 5:
                $title = "Brute Force";
                $text = "Brute force is a trial-and-error method used by attackers to gain unauthorized access to user accounts or systems by systematically trying all possible combinations of usernames, passwords, or encryption keys until the correct one is found.";
                $imageSrc = "../images/bfsrc1.png";
                $imageSrc2= "../images/bfsrc2.png";

                break;
            case 6:
                $title = "Basket Manipulation";
                $text = "Basket manipulation is a tactic involving altering or manipulating the contents of an online shopping cart, typically to exploit discounts, manipulate prices, or affect the final purchase amount in favor of the user.";
                $imageSrc = "../images/Defaultfeature.png";
                $imageSrc2= "../images/Defaultfeature.png";

                break;
            default:
                $title = "Coming Soon";
                $text = "Check back in later to see this vulnerability or hack help";
                $imageSrc = "../images/Defaultfeature.png";
                $imageSrc2= "../images/Defaultfeature.png";
                break;
        }
    }
    ?>
     <!--This is for the zoomy box when you click on a picture might put in header idk-->
     <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fancybox/3.5.7/jquery.fancybox.min.css" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/fancybox/3.5.7/jquery.fancybox.min.js"></script>

    <script>
        $(document).ready(function() {
            $('.fancybox').fancybox();
        });
    </script>
</head>
<body>
<?php topgap(); ?>
<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title"><?php echo $title; ?></h5>
                    <p class="card-text"><?php echo $text; ?></p>
                </div>

                <div class="row justify-content-center mt-3">
                    <div class="col-md-6">
                        <div class="d-flex justify-content-center">
                            <div class="p-2">
                                <a data-fancybox="gallery" href="<?php echo $imageSrc; ?>" class="fancybox">
                                    <img src="<?php echo $imageSrc; ?>" class="card-img-top" alt="Image 1">
                                </a>
                            </div>
                            <div class="p-2">
                                <a data-fancybox="gallery" href="<?php echo $imageSrc2; ?>" class="fancybox">
                                    <img src="<?php echo $imageSrc2; ?>" class="card-img-top" alt="Image 2">
                                </a>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="card-body">
                    <?php divider(); ?>
                    <a href="hints_hacks.php" class="btn btn-primary">Go Back</a>
                </div>
            </div>
        </div>
    </div>
</div>

</div>
</body>

<?php gap(); include_once("../Components/footer.php"); ?>
</html>
