<?php
require_once("dbController.php");
$db_handle = new DBController();
$userId = $_POST["userId"];
$bookId = $_POST["bookId"];
$db_handle->removeUserRating($userId, $bookId);
?>