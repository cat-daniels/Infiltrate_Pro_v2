<?php

//Banner:
function displayBanner() {
    echo '<div class="card text-center" id="banner" style="background-image: url(\'../images/banner.png\'); background-repeat: no-repeat; background-position: center center;">
            <div class="card-header">
                <!-- The text inside a container -->
                <div class="text-container">
                    <h5 class="card-title">Discover Your Style</h5>
                    <p class="card-text">Men\'s & Women\'s Tees: <br> Where Fashion Meets Comfort</p>
                    <a href="../Pages/homepage.php" class="btn btn-success">Browse now</a>
                </div>
            </div>
        </div>';
}

//Searchbar:
function displaySearchBar() {
    echo '<div class="searchbox" style = "background-color: tan; padding: 2px;">';
    echo '<div class="d-flex flex-column align-items-center mt-4">';
    echo '<div style = "color: white;"><h6>Search latest products and sales!</h6></div>';
    echo '<form action="" method="POST">'; // Opening form tag
    echo '<div class="input-group rounded-pill shadow-sm" style="max-width: 400px;">';
    echo '<input class="form-control rounded-pill border-0" type="search" placeholder="Search" aria-label="Search" name="query">';
    echo '<div class="input-group-append">';
    echo '<button class="btn btn-success rounded-pill" type="submit">Search</button>';
    echo '</div>';
    echo '</div>';
    echo '</form>'; // Closing form tag
    echo '</div>';
    echo '</div>';
} 

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Check if the 'query' parameter is present in the POST data
    if (isset($_POST['query'])) {
        
        $userInput = $_POST['query'];
        
        echo '<div class="d-flex flex-column align-items-center mt-4"> <h5>';
        echo $userInput;
        echo '</h5></div>';
        // Display the user input
        echo '<script>';
        echo 'setTimeout(function() {';
        echo 'window.location.href = window.location.pathname;';
        echo '}, 2000);';
        echo '</script>';
       
    }
}

//These functions are so I don't have to keep writing that I would like to have a gap in place lol
function topgap(){
    echo '<div class=topgap></div>';
}
function gap(){
    echo '<div class=gap></div>';
}
function divider(){
    echo '<div class=divider></div>';
}
?>