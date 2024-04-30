<?php
require_once("dbController.php");
$db_handle = new DBController();
$userId = $_POST["userId"];
$bookId = $_POST["bookId"];
$review = $_POST["review"];
$db_handle->updateUserReview($userId, $bookId, $review);
?>