<?php require_once($_SERVER['DOCUMENT_ROOT'].'/ReadersZone/dal/dbController.php'); $db_handle = new DBController(); ?>
<?php include($_SERVER['DOCUMENT_ROOT'].'/ReadersZone/include/sessionCheckLogin.php');?>
<?php
if(!empty($_GET["action"])) {
    switch($_GET["action"]) {
		case "removeFromShelf":
			if($db_handle->numRows("SELECT * FROM `shelf` WHERE `userId` = '" . $_SESSION['UserId'] . "' AND `bookId` = '" . $_GET["Id"] . "'") > 0) {
				if($db_handle->runQueryNoReturn("DELETE FROM `shelf` WHERE `userId` = '" . $_SESSION['UserId'] . "' AND `bookId` = '" . $_GET["Id"] . "'")) {
					echo "<script>alert('Book removed from shelf succesfully'); location.href='shelf.php';</script>";
				}
				else {
					echo "<script>alert('Error occured while removing book from shelf'); location.href='shelf.php';</script>";
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
    <div id="book-Shelf">
    <div class="txt-heading">Book Shelf</div>
        <table class="tbl-cart" cellpadding="10" cellspacing="1">
            <thead>
                <tr>
                    <th style="text-align:left;" width="30%">Name</th>
                    <th style="text-align:left;" width="5%">Code</th>
                    <th style="text-align:left;" width="10%">ISBN</th>
                    <th style="text-align:left;" width="15%">Author</th>
                    <th style="text-align:left;" width="15%">Category</th>
                    <th style="text-align:left;" width="15%">Publisher</th>
                    <th style="text-align:center;" width="5%">Remove</th>
                </tr>
            </thead>
            <tbody>
                <?php $book_array = $db_handle->runQuery("SELECT `books`.Id AS `Id`, `books`.`Name` AS `Name`, `books`.Code AS `Code`, `books`.ISBN AS `ISBN`, `books`.ImageLoc AS `ImageLoc`, 
                `authors`.`Name` AS `Author`, `publishers`.`Name` AS `Publisher`, `categories`.`Name` AS `Category` 
                FROM `books` JOIN `shelf` ON `books`.Id = `shelf`.bookId JOIN `users` ON `shelf`.userId = `users`.Id 
                JOIN `authors` ON `books`.AuthorId = `authors`.Id JOIN `publishers` ON `books`.PublisherId = `publishers`.Id JOIN `categories` ON `books`.CategoryId = `categories`.Id
                WHERE `users`.Id = '" . $_SESSION['UserId'] . "'");
                if (!empty($book_array)) { 
                    foreach($book_array as $key=>$value){?>
                        <tr>
                            <td><img src="/ReadersZone/wwwroot/book/images/<?php echo $book_array[$key]['ImageLoc']; ?>" class="cart-item-image" /><?php echo $book_array[$key]['Name']; ?></td>
                            <td><?php echo $book_array[$key]['Code']; ?></td>
                            <td><?php echo $book_array[$key]['ISBN']; ?></td>
                            <td><?php echo $book_array[$key]['Author']; ?></td>
                            <td><?php echo $book_array[$key]['Category']; ?></td>
                            <td><?php echo $book_array[$key]['Publisher']; ?></td>
                            <td style="text-align:center;"><a href="shelf.php?action=removeFromShelf&Id=<?php echo $book_array[$key]['Id']; ?>"><img src="/ReadersZone/wwwroot/images/delete.png" alt="Remove Item" /></a></td>
                        </tr>
                    <?php } ?>
                <?php } ?>
            </tbody>
        </table>
    </div>
    <?php include($_SERVER['DOCUMENT_ROOT'].'/ReadersZone/include/includeJS.php');?>
</body>
</html>