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
    <div id="book-grid" style="margin-bottom: 0px;">
        
        <?php
            $book_array = $db_handle->runQuery("SELECT books.*, categories.Name as Category, authors.Name as Author, publishers.Name as Publisher, publishers.Country as Country 
                                                FROM books join categories on books.CategoryId = categories.Id join authors on books.AuthorId = authors.Id join publishers on books.PublisherId = publishers.Id 
                                                WHERE books.Id = " . $_GET["Id"]);
            if (!empty($book_array)) { 
                foreach($book_array as $key=>$value){?>

                    <div class="txt-heading"><h2><?php echo $book_array[$key]["Code"]. " - " .$book_array[$key]["Name"]; ?></h2></div>
                    <div style="display: table;">
                        <img class="book-image-large" src="/ReadersZone/wwwroot/book/images/<?php echo $book_array[$key]["ImageLoc"]; ?>">
                        <div style="display: grid;">
                            <div class="book-item-detail" style="width: -webkit-fill-available; ">
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
                                    </tbody>
                                </table>
                                <input type='button' value='Back' class='btnAction' onclick="location.href='book.php?Id=<?php echo $book_array[$key]['Id']; ?>';"/>
                                
                                <div class="book-tile-footer">
                                    
                                    <div class="shelf-action">
                                        
                                    </div>
                                </div>
                            </div>
                            <h2>Reviews</h2>
                            <div class="book-item-detail" style="width: -webkit-fill-available; ">
                                <table class="book-detail-table">
                                    <tbody>
                                        <?php $reviews = $db_handle->getMultiData("SELECT users.UserName, reviews.rating, reviews.review FROM reviews JOIN books ON reviews.bookId = books.Id JOIN users ON reviews.userId = users.Id WHERE bookId = '".$_GET["Id"]."'"); 
                                        foreach($reviews as $review) { $rating = $review['rating']; ?>
                                        <tr class="book-detail-table-row">
                                            <td class="book-detail-heads"><?= $review['UserName'];?></td>
                                            <td class="book-detail-heads">
                                            <?php 
                                                echo '<ul class="list-rating list-inline"> ';
                                                for ($count = 1; $count <= 5; $count ++) {
                                                    if ($count <= $rating) {
                                                        echo '<li class="star selected">&#9733;</li>';
                                                    } else {
                                                        echo '<li class="star">&#9733;</li>';
                                                    }
                                                }	
                                                echo '</ul>';
                                            ?>
                                            </td>
                                            <td class="book-detail-values"><?= $review['review'];?></td>
                                        </tr>
                                        <?php } ?>
                                        
                                    </tbody>
                                </table>
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