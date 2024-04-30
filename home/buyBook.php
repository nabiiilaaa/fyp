<?php require_once($_SERVER['DOCUMENT_ROOT'].'/ReadersZone/dal/dbController.php'); $db_handle = new DBController(); ?>
<?php include($_SERVER['DOCUMENT_ROOT'].'/ReadersZone/include/sessionCheckLogin.php');?>
<?php 
require_once('./../admin/scripts/MarketManager.php');
$marketManager= new MarketManager($db_handle->conn);
?>
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
            $book_array = $db_handle->runQuery("SELECT market.*, books.*, users.*, categories.Name as Category, authors.Name as Author, publishers.Name as Publisher, publishers.Country as Country 
                                                FROM market join books on market.bookId = books.Id join users on market.userId = users.Id join categories on books.CategoryId = categories.Id join authors on books.AuthorId = authors.Id join publishers on books.PublisherId = publishers.Id
                                                WHERE market.Id = " . $_GET["Id"]);
            $data = $db_handle->getData("SELECT * FROM market WHERE `userId`='".$_SESSION['UserId']."' AND `bookId`='".$_GET["Id"]."'");
            if (!empty($book_array)) { 
                foreach($book_array as $key=>$value){?>

                    <div class="txt-heading"><h2><strong><?php echo $book_array[$key]["Code"]. " - " .$book_array[$key]["Name"]; ?></h2></div>
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
                                <input type='button' value='Back' class='btnAction' onclick="location.href='marketPlace.php';"/>
                                
                                <div class="book-tile-footer">
                                    
                                    <div class="shelf-action">
                                        
                                    </div>
                                </div>
                            </div>
                            <h2><strong>Seller Information</h2>
                            <div class="book-item-detail" style="width: -webkit-fill-available; text-align: left; margin-bottom: 10px;">
                            <div class="profileForm" method="post" enctype="multipart/form-data">
                                <div class="active-pink-4">
                                    <input hidden type="text" class="form-control" name="userId" value="<?= $book_array[$key]['userId'] ?? ''; ?>">

                                    <label>username</label>
                                    <input readonly type="text" class="form-control" name="UserName" value="<?= $book_array[$key]['UserName'] ?? ''; ?>">

                                    <label>Bio</label>
                                    <input readonly type="text" class="form-control" name="Bio" value="<?= $book_array[$key]['Bio'] ?? 'No-Bio'; ?>">

                                    <label>Favourite Quote</label>
                                    <input readonly type="text" class="form-control" name="FavouriteQuote" value="<?= $book_array[$key]['FavouriteQuote'] ?? 'No-Quote'; ?>">

                                    <label>Contact No</label>
                                    <input readonly type="text" class="form-control" name="Contact" value="<?= $book_array[$key]['Contact'] ?? 'No-Contact'; ?>">

                                    <label>Address</label>
                                    <input readonly type="text" class="form-control" name="Address" value="<?= $book_array[$key]['Address'] ?? 'No-Address'; ?>">

                                    <label>Price (£)</label>
                                    <input readonly type="number" class="form-control" name="Price" value="<?= $book_array[$key]['Price'] ?? 'Nill'; ?>">

                                    <label>Remarks</label>
                                    <input readonly type="text" class="form-control" name="Remarks" value="<?= $book_array[$key]['Remarks'] ?? 'Nill'; ?>">

                                </div>
                                <button class="btn btn-success" onclick="sendMessage(<?= $book_array[$key]['userId'] ?>, '<?= $book_array[$key]['Name'] ?>');">Message him/her</button>
                                <p class="text-danger"><?= $errMsg ?? ''; ?></p>
                                <p class="text-success"><?= $msg ?? ''; ?></p>
                            </div>
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