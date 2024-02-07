<?php
require_once("dbController.php");
$db_handle = new DBController();
$userId = $_POST["userId"];
$bookId = $_POST["bookId"];
$rating = $_POST["rating"];
$db_handle->addUserRating($userId, $bookId, $rating);
?>