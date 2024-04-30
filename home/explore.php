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
if(!empty($_GET["q"])) {
	$filter = $_GET["q"];
	$filterQry = "q=".$_GET["q"]."&";
} else {
	$filter = '';
	$filterQry = "";
}
?>
<html>
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Readers Zone</title>
    <?php include($_SERVER['DOCUMENT_ROOT'].'/ReadersZone/include/includeCSS.php');?>
	<style>
		.btn-success{
			width: 30px;
			height: 20px;
			padding: 0px;
		}
	</style>
</head>
<body>
    <?php include($_SERVER['DOCUMENT_ROOT'].'/ReadersZone/include/header.php');?>
    
    <div id="book-grid">
        <h1 class="txt-heading">Explore Books</h1>
		<form id="searchform" method="GET">
			<div class="active-pink-4 mb-4">
				<script>
					function checkEnter(event) {
						if (event.keyCode === 13) { // 13 is the keycode for the Enter key
							event.preventDefault(); // Prevent the default form submission
							document.getElementById("searchform").submit(); // Submit the form
						}
					}
				</script>
				<input class="form-control" type="text" placeholder="Search by Name" aria-label="Search" name="q" value="<?= $filter ?>" onkeydown="checkEnter(event)">
			</div>
		</form>
        <?php
			$total_records = $db_handle->count("SELECT COUNT(*) AS total FROM books WHERE books.Name LIKE '%$filter%'");
			$records_per_page = 8;
			$total_pages = ceil($total_records / $records_per_page);

			if (!isset($_GET['page'])) {
				$page = 1;
			} else {
				$page = $_GET['page'];
			}
			
			$start_from = ($page - 1) * $records_per_page;

            $book_array = $db_handle->runQuery("SELECT * FROM books WHERE books.Name LIKE '%$filter%' ORDER BY Id ASC LIMIT $start_from, $records_per_page");
            if (!empty($book_array)) { 
                foreach($book_array as $key=>$value){?>
                    <div class="book-item" onclick="location.href='book.php?Id=<?php echo $book_array[$key]['Id']; ?>';">
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
            }
			echo "<div>";
			if ($page > 1) {
				echo "<a class='btn btn-success' href='?".$filterQry."page=1'>&lt;&lt;</a> "; // First page link
				echo "<a class='btn btn-success' href='?".$filterQry."page=".($page - 1)."'>&lt;</a> "; // Previous page link
			}

			// Display direct links to nearby pages
			$start_range = max(1, $page - 2);
			$end_range = min($total_pages, $page + 2);

			for ($i = $start_range; $i <= $end_range; $i++) {
				if ($i == $page) {
					echo "<span>$i</span> "; // Current page link
				} else {
					echo "<a class='btn btn-success' href='?".$filterQry."page=$i'>$i</a> "; // Other page links
				}
			}

			if ($page < $total_pages) {
				echo "<a class='btn btn-success' href='?".$filterQry."page=".($page + 1)."'>&gt;</a> "; // Next page link
				echo "<a class='btn btn-success' href='?".$filterQry."page=$total_pages'>&gt;&gt;</a>"; // Last page link
			}
			echo "</div>";
			?>
    </div>
    <?php include($_SERVER['DOCUMENT_ROOT'].'/ReadersZone/include/includeJS.php');?>
</body>
</html>