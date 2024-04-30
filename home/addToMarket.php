<?php require_once($_SERVER['DOCUMENT_ROOT'].'/ReadersZone/dal/dbController.php'); $db_handle = new DBController(); ?>
<?php include($_SERVER['DOCUMENT_ROOT'].'/ReadersZone/include/sessionCheckLogin.php');?>
<?php 
require_once('./../admin/scripts/MarketManager.php');
$marketManager= new MarketManager($db_handle->conn);

/* create category  */
if(isset($_POST['create'])) {
  
    $bookId = $_POST['bookId'];
    $userId = $_SESSION['UserId'];
    $Contact = $_POST['Contact'];
    $Address = $_POST['Address'];
    $Price = $_POST['Price'];
    $Remarks = $_POST['Remarks'];

    $create = $marketManager->create($bookId, $userId, $Contact, $Address, $Price, $Remarks);
  
    if($create['success']) {
      $msg = "Book is added to market successfully";
    }
  
    if($create['errMsg']) {
      $errMsg = $create['errMsg'];
    }
    
  }
  
  /* update category */
  if(isset($_POST['update'])) {
    $bookId = $_POST['bookId'];
    $userId = $_SESSION['UserId'];
    $Contact = $_POST['Contact'];
    $Address = $_POST['Address'];
    $Price = $_POST['Price'];
    $Remarks = $_POST['Remarks'];
  
    $update = $marketManager->update($bookId, $userId, $Contact, $Address, $Price, $Remarks);
  
    if($update['success']) {
      $msg = "Book is updated in market successfully";
    }
  
    if($update['errMsg']) {
      $errMsg = $update['errMsg'];
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
    <div id="book-grid" style="margin-bottom: 0px;">
        
        <?php
            $book_array = $db_handle->runQuery("SELECT books.*, categories.Name as Category, authors.Name as Author, publishers.Name as Publisher, publishers.Country as Country 
                                                FROM books join categories on books.CategoryId = categories.Id join authors on books.AuthorId = authors.Id join publishers on books.PublisherId = publishers.Id 
                                                WHERE books.Id = " . $_GET["Id"]);
            $data = $db_handle->getData("SELECT * FROM market WHERE `userId`='".$_SESSION['UserId']."' AND `bookId`='".$_GET["Id"]."'");
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
                            <h2>Post for Sell</h2>
                            <div class="book-item-detail" style="width: -webkit-fill-available; text-align: left; margin-bottom: 10px;">
                            <form class="profileForm" method="post" enctype="multipart/form-data">
                                <div class="active-pink-4">
                                    <input hidden type="text" class="form-control" name="bookId" value="<?= $data['bookId'] ?? $_GET["Id"]; ?>">

                                    <label>Contact No</label>
                                    <input type="text" class="form-control" name="Contact" value="<?= $data['Contact'] ?? ''; ?>">

                                    <label>Address</label>
                                    <input type="text" class="form-control" name="Address" value="<?= $data['Address'] ?? ''; ?>">

                                    <label>Price (£)</label>
                                    <input type="number" class="form-control" name="Price" value="<?= $data['Price'] ?? ''; ?>">

                                    <label>Remarks</label>
                                    <input type="text" class="form-control" name="Remarks" value="<?= $data['Remarks'] ?? ''; ?>">

                                </div>
                                <button type="submit" class="btn btn-success" name="<?=  $data ? 'update' : 'create'; ?>">Save</button>
                                <p class="text-danger"><?= $errMsg ?? ''; ?></p>
                                <p class="text-success"><?= $msg ?? ''; ?></p>
                            </form>
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