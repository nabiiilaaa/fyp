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
    <div id="book-grid">
        
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
                        <input type='button' value='Open Book' class='btnAction' onclick="location.href='book_open.php?Id=<?php echo $book_array[$key]['Id']; ?>';"/>
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
    <?php include($_SERVER['DOCUMENT_ROOT'].'/ReadersZone/include/includeJS.php');?>
</body>
</html>