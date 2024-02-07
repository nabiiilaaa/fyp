<?php require_once($_SERVER['DOCUMENT_ROOT'].'/ReadersZone/dal/dbController.php'); $db_handle = new DBController(); ?>
<?php include($_SERVER['DOCUMENT_ROOT'].'/ReadersZone/include/sessionCheckLogin.php');?>
<?php
if(!empty($_GET["action"])) {
    switch($_GET["action"]) {
        case "addToShelf":
			if($db_handle->numRows("SELECT * FROM `shelf` WHERE `userId` = '" . $_SESSION['UserId'] . "' AND `bookId` = '" . $_GET["Id"] . "'") == 0) {
				if($db_handle->runQueryNoReturn("INSERT INTO `shelf` (`userId`, `bookId`) VALUES ('" . $_SESSION['UserId'] . "', '" . $_GET["Id"] . "')")) {
					echo "<script>alert('Book added to shelf succesfully'); location.href='explore.php';</script>";
				}
				else {
					echo "<script>alert('Error occured while adding book to shelf'); location.href='explore.php';</script>";
				}
			}
			break;
		case "removeFromShelf":
			if($db_handle->numRows("SELECT * FROM `shelf` WHERE `userId` = '" . $_SESSION['UserId'] . "' AND `bookId` = '" . $_GET["Id"] . "'") > 0) {
				if($db_handle->runQueryNoReturn("DELETE FROM `shelf` WHERE `userId` = '" . $_SESSION['UserId'] . "' AND `bookId` = '" . $_GET["Id"] . "'")) {
					echo "<script>alert('Book removed from shelf succesfully'); location.href='explore.php';</script>";
				}
				else {
					echo "<script>alert('Error occured while removing book from shelf'); location.href='explore.php';</script>";
				}
			}
			break;
	}
}
?>
<html>
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Readers Zone</title>
    <?php include($_SERVER['DOCUMENT_ROOT'].'/ReadersZone/include/includeCSS.php');?>
</head>
<body>
    <?php include($_SERVER['DOCUMENT_ROOT'].'/ReadersZone/include/header.php');?>
    
    <div id="book-grid">
        <div class="txt-heading">Explore Books</div>
        <?php
            $book_array = $db_handle->runQuery("SELECT * FROM books ORDER BY Id ASC");
            if (!empty($book_array)) { 
                foreach($book_array as $key=>$value){?>
                    <div class="book-item">
						<img class="book-image" src="/ReadersZone/wwwroot/book/images/<?php echo $book_array[$key]["ImageLoc"]; ?>">
						<div class="book-tile-footer">
							<div class="book-title"><?php echo $book_array[$key]["Name"]; ?></div>
							<?php 
								$rating = $db_handle->avgRating($book_array[$key]["Id"], 0);
								$totalRating = $db_handle->totalRating($book_array[$key]["Id"]);
								echo '<ul class="list-rating list-inline"  onMouseLeave="mouseOutRating(' . $book_array[$key]["Id"] . ',' . $rating . ');"> ';
								for ($count = 1; $count <= 5; $count ++) {
									$starRatingId = $book_array[$key]["Id"] . '_' . $count;
									if ($count <= $rating) {
										echo '<li value="' . $count . '" id="' . $starRatingId . '" class="star selected">&#9733;</li>';
									} else {
										echo '<li value="' . $count . '"  id="' . $starRatingId . '" class="star">&#9733;</li>';
									}
								}	
								echo '</ul>';
								echo '<p class="review-note">Total Reviews: ' . $totalRating . '</p>';
							?>
							<div class="shelf-action">
								<?php
								if($db_handle->numRows("SELECT * FROM `shelf` WHERE `userId` = '" . $_SESSION['UserId'] . "' AND `bookId` = '" . $book_array[$key]["Id"] . "'") == 0) {
									echo "<form method='post' action='explore.php?action=addToShelf&Id=" . $book_array[$key]['Id'] . "'>";
									echo "<input type='submit' value='Add to Shelf' class='btnAction' />";
									echo "</form>";
								}
								else {
									echo "<form method='post' action='explore.php?action=removeFromShelf&Id=" . $book_array[$key]['Id'] . "'>";
									echo "<input type='submit' value='Remove from Shelf' class='btnAction' />";
									echo "</form>";	
								}
								?>
							</div>
						</div>
                    </div>
                <?php
                }
            }?>
    </div>
    <?php include($_SERVER['DOCUMENT_ROOT'].'/ReadersZone/include/includeJS.php');?>
</body>
</html>