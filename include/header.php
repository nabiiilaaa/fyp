<header>
    <nav class="navbar navbar-expand-sm navbar-toggleable-sm navbar-light bg-white border-bottom box-shadow mb-3">
        <div class="container-fluid">
            <div class="w3-bar w3-border w3-card-4 w3-light-grey">
                <a class="w3-bar-item w3-button" href="home.php" style="padding: 0px; margin: 0px; margin-right: 10px;"><img src="/ReadersZone/wwwroot/images/logo.png" height="100%"/></a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target=".navbar-collapse" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation" style="float: right;">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="navbar-collapse collapse d-sm-inline-flex ">
                    <a class="w3-bar-item w3-button w3-mobile" href="<?php if($isChating) echo "./../home/"; ?>explore.php">Explore</a>
                    <a class="w3-bar-item w3-button w3-mobile" href="<?php if($isChating) echo "./../home/"; ?>shelf.php">Book Shelf</a>
                    <a class="w3-bar-item w3-button w3-mobile" href="<?php if($isChating) echo "./../home/"; ?>marketPlace.php">Marketplace</a>
                    <a class="w3-bar-item w3-button w3-mobile" href="<?php if($isChating) echo "./../home/"; ?>postedBooks.php">Posted Books</a>
                    <a class="w3-bar-item w3-button w3-mobile" href="/ReadersZone/chat/">Messages</a>
                    <a class="w3-bar-item w3-button w3-mobile" href="<?php if($isChating) echo "./../home/"; ?>aboutus.php">About Us</a>
                    <a class="w3-bar-item w3-button w3-mobile" href="<?php if($isChating) echo "./../home/"; ?>profile.php">Profile</a>
                    <a class="w3-bar-item w3-button w3-mobile" href="/ReadersZone/dal/logout.php">Log out</a>
                </div>
            </div>
            
        </div>
    </nav>
</header>