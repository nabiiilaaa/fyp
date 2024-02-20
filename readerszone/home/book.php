<?php require_once($_SERVER['DOCUMENT_ROOT'].'/ReadersZone/dal/dbController.php'); $db_handle = new DBController(); ?>
<?php include($_SERVER['DOCUMENT_ROOT'].'/ReadersZone/include/sessionCheckLogin.php');?>
<html>
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Readers Zone</title>
    <?php include($_SERVER['DOCUMENT_ROOT'].'/ReadersZone/include/includeCSS.php');?>
</head>
<body>
    <?php include($_SERVER['DOCUMENT_ROOT'].'/ReadersZone/include/header.php');?>
    <div id="book-grid" style="height: 50%; margin-bottom: 0px;">
        
        <?php
            $book_array = $db_handle->runQuery("SELECT books.*, categories.Name as Category, authors.Name as Author, publishers.Name as Publisher, publishers.Country as Country 
                                                FROM books join categories on books.CategoryId = categories.Id join authors on books.AuthorId = authors.Id join publishers on books.PublisherId = publishers.Id 
                                                WHERE books.Id = " . $_GET["Id"]);
            if (!empty($book_array)) { 
                foreach($book_array as $key=>$value){?>

                    <div class="txt-heading"><h2><?php echo $book_array[$key]["Code"]. " - " .$book_array[$key]["Name"]; ?></h2></div>
                    <img class="book-image-large" src="/ReadersZone/wwwroot/book/images/<?php echo $book_array[$key]["ImageLoc"]; ?>">
                    <div class="book-item-detail">
                        <table class="book-detail-table">
                            <tbody>
                                <tr class="book-detail-table-row">
                                    <td class="book-detail-heads">Code</td>
                                    <td class="book-detail-values"><?php echo $book_array[$key]["Code"]; ?></td>
                                </tr>
                                <tr class="book-detail-table-row">
                                    <td class="book-detail-heads">Name</td>
                                    <td class="book-detail-values"><?php echo $book_array[$key]["Name"]; ?></td>
                                </tr>
                                <tr class="book-detail-table-row">
                                    <td class="book-detail-heads">Author</td>
                                    <td class="book-detail-values"><?php echo $book_array[$key]["Author"]; ?></td>
                                </tr>
                                <tr class="book-detail-table-row">
                                    <td class="book-detail-heads">Publisher</td>
                                    <td class="book-detail-values"><?php echo $book_array[$key]["Publisher"]; ?></td>
                                </tr>
                                <tr class="book-detail-table-row">
                                    <td class="book-detail-heads">ISBN</td>
                                    <td class="book-detail-values"><?php echo $book_array[$key]["ISBN"]; ?></td>
                                </tr>
                                <tr class="book-detail-table-row">
                                    <td class="book-detail-heads">Description</td>
                                    <td class="book-detail-values"><?php echo $book_array[$key]["Description"]; ?></td>
                                </tr>
                                <tr class="book-detail-table-row">
                                    <td class="book-detail-heads">
                                    <?php 
                                        $rating = $db_handle->userRating($_SESSION['UserId'], $book_array[$key]["Id"], 0);
                                        echo '<ul class="list-rating list-inline"  onMouseLeave="mouseOutRating(' . $book_array[$key]["Id"] . ',' . $rating . ');"> ';
                                        for ($count = 1; $count <= 5; $count ++) {
                                            $starRatingId = $book_array[$key]["Id"] . '_' . $count;
                                            if($rating == 0) {
                                                echo '<li value="' . $count . '"  id="' . $starRatingId . '" class="star" onclick="addRating(' . $_SESSION['UserId'] . ',' . $book_array[$key]["Id"] . ',' . $count . ');" onMouseOver="mouseOverRating(' . $book_array[$key]["Id"] . ',' . $count . ');">&#9733;</li>';
                                            } else if ($count <= $rating) {
                                                echo '<li value="' . $count . '" id="' . $starRatingId . '" class="star selected">&#9733;</li>';
                                            } else {
                                                echo '<li value="' . $count . '"  id="' . $starRatingId . '" class="star">&#9733;</li>';
                                            }
                                        }	
                                        echo '</ul>';
                                    ?>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                        <input type='button' value='Read' class='btnAction' onclick="location.href='book_read.php?Id=<?php echo $book_array[$key]['Id']; ?>';"/>
						<?php if($rating > 0) {
                            echo "<input type='button' value='Remove Rating' class='btnAction' onclick='removeRating(".$_SESSION['UserId'].",".$book_array[$key]['Id'].")'/>";
                        }?>
                        
                        <div class="book-tile-footer">
							
							<div class="shelf-action">
								
							</div>
						</div>
                    </div>
                <?php
                }
            }?>
    </div>

    <div id="book-grid" style="margin: auto;">
        <div class="txt-heading">Recommendations</div>
        <?php
        $book_array = $db_handle->runQuery("SELECT books.* FROM books JOIN favcategories ON books.CategoryId = favcategories.categoryId 
        LEFT JOIN (SELECT bookId, AVG(rating) AS rating FROM `reviews` GROUP BY bookId) AS rating ON rating.bookId = books.Id
        WHERE favcategories.userId = '".$_SESSION['UserId']."' AND books.Id != '".$_GET["Id"]."' ORDER BY rating.rating DESC LIMIT 3");
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
        }?>
    </div>

    <?php include($_SERVER['DOCUMENT_ROOT'].'/ReadersZone/include/includeJS.php');?>
</body>
</html>