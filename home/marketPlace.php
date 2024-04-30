<?php require_once($_SERVER['DOCUMENT_ROOT'].'/ReadersZone/dal/dbController.php'); $db_handle = new DBController(); ?>
<?php include($_SERVER['DOCUMENT_ROOT'].'/ReadersZone/include/sessionCheckLogin.php');?>
<?php
if(!empty($_GET["q"])) {
	$filter = $_GET["q"];
} else {
	$filter = '';
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
        <h1 class="txt-heading">Explore Market</h1>
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
				<input class="form-control" type="text" placeholder="Search by Book name" aria-label="Search" name="q" value="<?= $filter ?>" onkeydown="checkEnter(event)">
			</div>
		</form>
        <?php
            $book_array = $db_handle->runQuery("SELECT market.*, books.Id as BookId, books.Name as bookName, books.ImageLoc FROM market JOIN books ON market.bookId = books.Id JOIN users ON market.userId = users.Id WHERE books.Name LIKE '%$filter%' AND users.Id != '".$_SESSION['UserId']."'");
            if (!empty($book_array)) { 
                foreach($book_array as $key=>$value){?>
                    <div class="book-item" onclick="location.href='buyBook.php?Id=<?php echo $book_array[$key]['Id']; ?>';">
						<img class="book-image" src="/ReadersZone/wwwroot/book/images/<?php echo $book_array[$key]["ImageLoc"]; ?>">
						<div class="book-tile-footer">
							<div class="book-title"><?php echo $book_array[$key]["bookName"]; ?></div>
							<?php 
								$rating = $db_handle->avgRating($book_array[$key]["BookId"], 0);
								$totalRating = $db_handle->totalRating($book_array[$key]["BookId"]);
								echo '<ul class="list-rating list-inline"> ';
								for ($count = 1; $count <= 5; $count ++) {
									$starRatingId = $book_array[$key]["BookId"] . '_' . $count;
									if ($count <= $rating) {
										echo '<li value="' . $count . '" id="' . $starRatingId . '" class="star selected">&#9733;</li>';
									} else {
										echo '<li value="' . $count . '"  id="' . $starRatingId . '" class="star">&#9733;</li>';
									}
								}	
								echo '</ul>';
								echo '<p class="review-note">Total Reviews: ' . $totalRating . '</p>';
							?>
						</div>
                    </div>
                <?php
                }
            }?>
    </div>
    <?php include($_SERVER['DOCUMENT_ROOT'].'/ReadersZone/include/includeJS.php');?>
</body>
</html>