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
    echo '<div class="d-flex flex-column align-items-center mt-4">';
    echo '<div class="bg-info text-light p-2 rounded mb-3">';
    echo '<h5>Search up items</h5>';
    echo '</div>';
    echo '<div class="input-group rounded-pill shadow-sm" style="max-width: 400px;">';
    echo '<input class="form-control rounded-pill border-1" type="search" placeholder="Search" aria-label="Search" name="query">';
    echo '<div class="input-group-append">';
    echo '<button class="btn btn-outline-success rounded-pill" type="submit">Search</button>';
    echo '</div>';
    echo '</div>';
    echo '</div>';
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